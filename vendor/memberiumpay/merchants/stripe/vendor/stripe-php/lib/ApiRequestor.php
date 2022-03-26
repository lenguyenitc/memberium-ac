<?php

namespace Stripe;



class ApiRequestor
{
    
    private $_apiKey;

    
    private $_apiBase;

    
    private static $_httpClient;

    
    private static $requestTelemetry;

    
    public 
function __construct($apiKey = null, $apiBase = null)
    {
        $this->_apiKey = $apiKey;
        if (!$apiBase) {
            $apiBase = Stripe::$apiBase;
        }
        $this->_apiBase = $apiBase;
    }

    
    private static 
function _telemetryJson($requestTelemetry)
    {
        $payload = array(
            'last_request_metrics' => array(
                'request_id' => $requestTelemetry->requestId,
                'request_duration_ms' => $requestTelemetry->requestDuration,
        ));

        $result = json_encode($payload);
        if ($result != false) {
            return $result;
        } else {
            Stripe::getLogger()->error("Serializing telemetry payload failed!");
            return "{}";
        }
    }

    
    private static 
function _encodeObjects($d)
    {
        if ($d instanceof ApiResource) {
            return Util\Util::utf8($d->id);
        } elseif ($d === true) {
            return 'true';
        } elseif ($d === false) {
            return 'false';
        } elseif (is_array($d)) {
            $res = [];
            foreach ($d as $k => $v) {
                $res[$k] = self::_encodeObjects($v);
            }
            return $res;
        } else {
            return Util\Util::utf8($d);
        }
    }

    
    public 
function request($method, $url, $params = null, $headers = null)
    {
        $params = $params ?: [];
        $headers = $headers ?: [];
        list($rbody, $rcode, $rheaders, $myApiKey) =
        $this->_requestRaw($method, $url, $params, $headers);
        $json = $this->_interpretResponse($rbody, $rcode, $rheaders);
        $resp = new ApiResponse($rbody, $rcode, $rheaders, $json);
        return [$resp, $myApiKey];
    }

    
    public 
function handleErrorResponse($rbody, $rcode, $rheaders, $resp)
    {
        if (!is_array($resp) || !isset($resp['error'])) {
            $msg = "Invalid response object from API: $rbody "
              . "(HTTP response code was $rcode)";
            throw new Exception\UnexpectedValueException($msg);
        }

        $errorData = $resp['error'];

        $error = null;
        if (is_string($errorData)) {
            $error = self::_specificOAuthError($rbody, $rcode, $rheaders, $resp, $errorData);
        }
        if (!$error) {
            $error = self::_specificAPIError($rbody, $rcode, $rheaders, $resp, $errorData);
        }

        throw $error;
    }

    
    private static 
function _specificAPIError($rbody, $rcode, $rheaders, $resp, $errorData)
    {
        $msg = isset($errorData['message']) ? $errorData['message'] : null;
        $param = isset($errorData['param']) ? $errorData['param'] : null;
        $code = isset($errorData['code']) ? $errorData['code'] : null;
        $type = isset($errorData['type']) ? $errorData['type'] : null;
        $declineCode = isset($errorData['decline_code']) ? $errorData['decline_code'] : null;

        switch ($rcode) {
            case 400:
                                                if ($code == 'rate_limit') {
                    return Exception\RateLimitException::factory($msg, $rcode, $rbody, $resp, $rheaders, $code, $param);
                }
                if ($type == 'idempotency_error') {
                    return Exception\IdempotencyException::factory($msg, $rcode, $rbody, $resp, $rheaders, $code);
                }

                            case 404:
                return Exception\InvalidRequestException::factory($msg, $rcode, $rbody, $resp, $rheaders, $code, $param);
            case 401:
                return Exception\AuthenticationException::factory($msg, $rcode, $rbody, $resp, $rheaders, $code);
            case 402:
                return Exception\CardException::factory($msg, $rcode, $rbody, $resp, $rheaders, $code, $declineCode, $param);
            case 403:
                return Exception\PermissionException::factory($msg, $rcode, $rbody, $resp, $rheaders, $code);
            case 429:
                return Exception\RateLimitException::factory($msg, $rcode, $rbody, $resp, $rheaders, $code, $param);
            default:
                return Exception\UnknownApiErrorException::factory($msg, $rcode, $rbody, $resp, $rheaders, $code);
        }
    }

    
    private static 
function _specificOAuthError($rbody, $rcode, $rheaders, $resp, $errorCode)
    {
        $description = isset($resp['error_description']) ? $resp['error_description'] : $errorCode;

        switch ($errorCode) {
            case 'invalid_client':
                return Exception\OAuth\InvalidClientException::factory($description, $rcode, $rbody, $resp, $rheaders, $errorCode);
            case 'invalid_grant':
                return Exception\OAuth\InvalidGrantException::factory($description, $rcode, $rbody, $resp, $rheaders, $errorCode);
            case 'invalid_request':
                return Exception\OAuth\InvalidRequestException::factory($description, $rcode, $rbody, $resp, $rheaders, $errorCode);
            case 'invalid_scope':
                return Exception\OAuth\InvalidScopeException::factory($description, $rcode, $rbody, $resp, $rheaders, $errorCode);
            case 'unsupported_grant_type':
                return Exception\OAuth\UnsupportedGrantTypeException::factory($description, $rcode, $rbody, $resp, $rheaders, $errorCode);
            case 'unsupported_response_type':
                return Exception\OAuth\UnsupportedResponseTypeException::factory($description, $rcode, $rbody, $resp, $rheaders, $errorCode);
            default:
                return Exception\OAuth\UnknownOAuthErrorException::factory($description, $rcode, $rbody, $resp, $rheaders, $errorCode);
        }
    }

    
    private static 
function _formatAppInfo($appInfo)
    {
        if ($appInfo !== null) {
            $string = $appInfo['name'];
            if ($appInfo['version'] !== null) {
                $string .= '/' . $appInfo['version'];
            }
            if ($appInfo['url'] !== null) {
                $string .= ' (' . $appInfo['url'] . ')';
            }
            return $string;
        } else {
            return null;
        }
    }

    
    private static 
function _defaultHeaders($apiKey, $clientInfo = null)
    {
        $uaString = 'Stripe/v1 PhpBindings/' . Stripe::VERSION;

        $langVersion = phpversion();
        $uname = php_uname();

        $appInfo = Stripe::getAppInfo();
        $ua = [
            'bindings_version' => Stripe::VERSION,
            'lang' => 'php',
            'lang_version' => $langVersion,
            'publisher' => 'stripe',
            'uname' => $uname,
        ];
        if ($clientInfo) {
            $ua = array_merge($clientInfo, $ua);
        }
        if ($appInfo !== null) {
            $uaString .= ' ' . self::_formatAppInfo($appInfo);
            $ua['application'] = $appInfo;
        }

        $defaultHeaders = [
            'X-Stripe-Client-User-Agent' => json_encode($ua),
            'User-Agent' => $uaString,
            'Authorization' => 'Bearer ' . $apiKey,
        ];
        return $defaultHeaders;
    }

    
    private 
function _requestRaw($method, $url, $params, $headers)
    {
        $myApiKey = $this->_apiKey;
        if (!$myApiKey) {
            $myApiKey = Stripe::$apiKey;
        }

        if (!$myApiKey) {
            $msg = 'No API key provided.  (HINT: set your API key using '
              . '"Stripe::setApiKey(<API-KEY>)".  You can generate API keys from '
              . 'the Stripe web interface.  See https://stripe.com/api for '
              . 'details, or email support@stripe.com if you have any questions.';
            throw new Exception\AuthenticationException($msg);
        }

                                $clientUAInfo = null;
        if (method_exists($this->httpClient(), 'getUserAgentInfo')) {
            $clientUAInfo = $this->httpClient()->getUserAgentInfo();
        }

        $absUrl = $this->_apiBase.$url;
        $params = self::_encodeObjects($params);
        $defaultHeaders = $this->_defaultHeaders($myApiKey, $clientUAInfo);
        if (Stripe::$apiVersion) {
            $defaultHeaders['Stripe-Version'] = Stripe::$apiVersion;
        }

        if (Stripe::$accountId) {
            $defaultHeaders['Stripe-Account'] = Stripe::$accountId;
        }

        if (Stripe::$enableTelemetry && self::$requestTelemetry != null) {
            $defaultHeaders["X-Stripe-Client-Telemetry"] = self::_telemetryJson(self::$requestTelemetry);
        }

        $hasFile = false;
        foreach ($params as $k => $v) {
            if (is_resource($v)) {
                $hasFile = true;
                $params[$k] = self::_processResourceParam($v);
            } elseif ($v instanceof \CURLFile) {
                $hasFile = true;
            }
        }

        if ($hasFile) {
            $defaultHeaders['Content-Type'] = 'multipart/form-data';
        } else {
            $defaultHeaders['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        $combinedHeaders = array_merge($defaultHeaders, $headers);
        $rawHeaders = [];

        foreach ($combinedHeaders as $header => $value) {
            $rawHeaders[] = $header . ': ' . $value;
        }

        $requestStartMs = Util\Util::currentTimeMillis();

        list($rbody, $rcode, $rheaders) = $this->httpClient()->request(
            $method,
            $absUrl,
            $rawHeaders,
            $params,
            $hasFile
        );

        if (isset($rheaders['request-id']) && isset($rheaders['request-id'][0])) {
            self::$requestTelemetry = new RequestTelemetry(
                $rheaders['request-id'][0],
                Util\Util::currentTimeMillis() - $requestStartMs
            );
        }

        return [$rbody, $rcode, $rheaders, $myApiKey];
    }

    
    private 
function _processResourceParam($resource)
    {
        if (get_resource_type($resource) !== 'stream') {
            throw new Exception\InvalidArgumentException(
                'Attempted to upload a resource that is not a stream'
            );
        }

        $metaData = stream_get_meta_data($resource);
        if ($metaData['wrapper_type'] !== 'plainfile') {
            throw new Exception\InvalidArgumentException(
                'Only plainfile resource streams are supported'
            );
        }

                return new \CURLFile($metaData['uri']);
    }

    
    private 
function _interpretResponse($rbody, $rcode, $rheaders)
    {
        $resp = json_decode($rbody, true);
        $jsonError = json_last_error();
        if ($resp === null && $jsonError !== JSON_ERROR_NONE) {
            $msg = "Invalid response body from API: $rbody "
              . "(HTTP response code was $rcode, json_last_error() was $jsonError)";
            throw new Exception\UnexpectedValueException($msg, $rcode, $rbody);
        }

        if ($rcode < 200 || $rcode >= 300) {
            $this->handleErrorResponse($rbody, $rcode, $rheaders, $resp);
        }
        return $resp;
    }

    
    public static 
function setHttpClient($client)
    {
        self::$_httpClient = $client;
    }

    
    public static 
function resetTelemetry()
    {
        self::$requestTelemetry = null;
    }

    
    private 
function httpClient()
    {
        if (!self::$_httpClient) {
            self::$_httpClient = HttpClient\CurlClient::instance();
        }
        return self::$_httpClient;
    }
}
