<?php

namespace Stripe\HttpClient;

use Stripe\Stripe;
use Stripe\Exception;
use Stripe\Util;



if (!defined('CURL_SSLVERSION_TLSv1_2')) {
    define('CURL_SSLVERSION_TLSv1_2', 6);
}

if (!defined('CURL_HTTP_VERSION_2TLS')) {
    define('CURL_HTTP_VERSION_2TLS', 4);
}


class CurlClient implements ClientInterface
{
    private static $instance;

    public static 
function instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected $defaultOptions;

    
    protected $randomGenerator;

    protected $userAgentInfo;

    protected $enablePersistentConnections = true;

    protected $enableHttp2 = null;

    protected $curlHandle = null;

    protected $requestStatusCallback = null;

    
    public 
function __construct($defaultOptions = null, $randomGenerator = null)
    {
        $this->defaultOptions = $defaultOptions;
        $this->randomGenerator = $randomGenerator ?: new Util\RandomGenerator();
        $this->initUserAgentInfo();

        $this->enableHttp2 = $this->canSafelyUseHttp2();
    }

    public 
function __destruct()
    {
        $this->closeCurlHandle();
    }

    public 
function initUserAgentInfo()
    {
        $curlVersion = curl_version();
        $this->userAgentInfo = [
            'httplib' =>  'curl ' . $curlVersion['version'],
            'ssllib' => $curlVersion['ssl_version'],
        ];
    }

    public 
function getDefaultOptions()
    {
        return $this->defaultOptions;
    }

    public 
function getUserAgentInfo()
    {
        return $this->userAgentInfo;
    }

    
    public 
function getEnablePersistentConnections()
    {
        return $this->enablePersistentConnections;
    }

    
    public 
function setEnablePersistentConnections($enable)
    {
        $this->enablePersistentConnections = $enable;
    }

    
    public 
function getEnableHttp2()
    {
        return $this->enableHttp2;
    }

    
    public 
function setEnableHttp2($enable)
    {
        $this->enableHttp2 = $enable;
    }

    
    public 
function getRequestStatusCallback()
    {
        return $this->requestStatusCallback;
    }

    
    public 
function setRequestStatusCallback($requestStatusCallback)
    {
        $this->requestStatusCallback = $requestStatusCallback;
    }

    
    const DEFAULT_TIMEOUT = 80;
    const DEFAULT_CONNECT_TIMEOUT = 30;

    private $timeout = self::DEFAULT_TIMEOUT;
    private $connectTimeout = self::DEFAULT_CONNECT_TIMEOUT;

    public 
function setTimeout($seconds)
    {
        $this->timeout = (int) max($seconds, 0);
        return $this;
    }

    public 
function setConnectTimeout($seconds)
    {
        $this->connectTimeout = (int) max($seconds, 0);
        return $this;
    }

    public 
function getTimeout()
    {
        return $this->timeout;
    }

    public 
function getConnectTimeout()
    {
        return $this->connectTimeout;
    }

    
    public 
function request($method, $absUrl, $headers, $params, $hasFile)
    {
        $method = strtolower($method);

        $opts = [];
        if (is_callable($this->defaultOptions)) {             $opts = call_user_func_array($this->defaultOptions, func_get_args());
            if (!is_array($opts)) {
                throw new Exception\UnexpectedValueException("Non-array value returned by defaultOptions CurlClient callback");
            }
        } elseif (is_array($this->defaultOptions)) {             $opts = $this->defaultOptions;
        }

        $params = Util\Util::objectsToIds($params);

        if ($method == 'get') {
            if ($hasFile) {
                throw new Exception\UnexpectedValueException(
                    "Issuing a GET request with a file parameter"
                );
            }
            $opts[CURLOPT_HTTPGET] = 1;
            if (count($params) > 0) {
                $encoded = Util\Util::encodeParameters($params);
                $absUrl = "$absUrl?$encoded";
            }
        } elseif ($method == 'post') {
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $hasFile ? $params : Util\Util::encodeParameters($params);
        } elseif ($method == 'delete') {
            $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
            if (count($params) > 0) {
                $encoded = Util\Util::encodeParameters($params);
                $absUrl = "$absUrl?$encoded";
            }
        } else {
            throw new Exception\UnexpectedValueException("Unrecognized method $method");
        }

                        if (($method == 'post') && (Stripe::$maxNetworkRetries > 0)) {
            if (!$this->hasHeader($headers, "Idempotency-Key")) {
                array_push($headers, 'Idempotency-Key: ' . $this->randomGenerator->uuid());
            }
        }

                                                                                                        array_push($headers, 'Expect: ');

        $absUrl = Util\Util::utf8($absUrl);
        $opts[CURLOPT_URL] = $absUrl;
        $opts[CURLOPT_RETURNTRANSFER] = true;
        $opts[CURLOPT_CONNECTTIMEOUT] = $this->connectTimeout;
        $opts[CURLOPT_TIMEOUT] = $this->timeout;
        $opts[CURLOPT_HTTPHEADER] = $headers;
        $opts[CURLOPT_CAINFO] = Stripe::getCABundlePath();
        if (!Stripe::getVerifySslCerts()) {
            $opts[CURLOPT_SSL_VERIFYPEER] = false;
        }

        if (!isset($opts[CURLOPT_HTTP_VERSION]) && $this->getEnableHttp2()) {
                        $opts[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_2TLS;
        }

        list($rbody, $rcode, $rheaders) = $this->executeRequestWithRetries($opts, $absUrl);

        return [$rbody, $rcode, $rheaders];
    }

    
    private 
function executeRequestWithRetries($opts, $absUrl)
    {
        $numRetries = 0;
        $isPost = array_key_exists(CURLOPT_POST, $opts) && $opts[CURLOPT_POST] == 1;

        while (true) {
            $rcode = 0;
            $errno = 0;
            $message = null;

                        $rheaders = new Util\CaseInsensitiveArray();
            $headerCallback = function ($curl, $header_line) use (&$rheaders) {
                                if (strpos($header_line, ":") === false) {
                    return strlen($header_line);
                }
                list($key, $value) = explode(":", trim($header_line), 2);
                $rheaders[trim($key)] = trim($value);
                return strlen($header_line);
            };
            $opts[CURLOPT_HEADERFUNCTION] = $headerCallback;

            $this->resetCurlHandle();
            curl_setopt_array($this->curlHandle, $opts);
            $rbody = curl_exec($this->curlHandle);

            if ($rbody === false) {
                $errno = curl_errno($this->curlHandle);
                $message = curl_error($this->curlHandle);
            } else {
                $rcode = curl_getinfo($this->curlHandle, CURLINFO_HTTP_CODE);
            }
            if (!$this->getEnablePersistentConnections()) {
                $this->closeCurlHandle();
            }

            $shouldRetry = $this->shouldRetry($errno, $rcode, $rheaders, $numRetries);

            if (is_callable($this->getRequestStatusCallback())) {
                call_user_func_array(
                    $this->getRequestStatusCallback(),
                    [$rbody, $rcode, $rheaders, $errno, $message, $shouldRetry, $numRetries]
                );
            }

            if ($shouldRetry) {
                $numRetries += 1;
                $sleepSeconds = $this->sleepTime($numRetries, $rheaders);
                usleep(intval($sleepSeconds * 1000000));
            } else {
                break;
            }
        }

        if ($rbody === false) {
            $this->handleCurlError($absUrl, $errno, $message, $numRetries);
        }

        return [$rbody, $rcode, $rheaders];
    }

    
    private 
function handleCurlError($url, $errno, $message, $numRetries)
    {
        switch ($errno) {
            case CURLE_COULDNT_CONNECT:
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_OPERATION_TIMEOUTED:
                $msg = "Could not connect to Stripe ($url).  Please check your "
                 . "internet connection and try again.  If this problem persists, "
                 . "you should check Stripe's service status at "
                 . "https://twitter.com/stripestatus, or";
                break;
            case CURLE_SSL_CACERT:
            case CURLE_SSL_PEER_CERTIFICATE:
                $msg = "Could not verify Stripe's SSL certificate.  Please make sure "
                 . "that your network is not intercepting certificates.  "
                 . "(Try going to $url in your browser.)  "
                 . "If this problem persists,";
                break;
            default:
                $msg = "Unexpected error communicating with Stripe.  "
                 . "If this problem persists,";
        }
        $msg .= " let us know at support@stripe.com.";

        $msg .= "\n\n(Network error [errno $errno]: $message)";

        if ($numRetries > 0) {
            $msg .= "\n\nRequest was retried $numRetries times.";
        }

        throw new Exception\ApiConnectionException($msg);
    }

    
    private 
function shouldRetry($errno, $rcode, $rheaders, $numRetries)
    {
        if ($numRetries >= Stripe::getMaxNetworkRetries()) {
            return false;
        }

                if ($errno === CURLE_OPERATION_TIMEOUTED) {
            return true;
        }

                                if ($errno === CURLE_COULDNT_CONNECT) {
            return true;
        }

                        if (isset($rheaders['stripe-should-retry'])) {
            if ($rheaders['stripe-should-retry'] === 'false') {
                return false;
            }
            if ($rheaders['stripe-should-retry'] === 'true') {
                return true;
            }
        }

                if ($rcode === 409) {
            return true;
        }

                                                if ($rcode >= 500) {
            return true;
        }

        return false;
    }

    
    private 
function sleepTime($numRetries, $rheaders)
    {
                                $sleepSeconds = min(
            Stripe::getInitialNetworkRetryDelay() * 1.0 * pow(2, $numRetries - 1),
            Stripe::getMaxNetworkRetryDelay()
        );

                        $sleepSeconds *= 0.5 * (1 + $this->randomGenerator->randFloat());

                $sleepSeconds = max(Stripe::getInitialNetworkRetryDelay(), $sleepSeconds);

                $retryAfter = isset($rheaders['retry-after']) ? floatval($rheaders['retry-after']) : 0.0;
        if (floor($retryAfter) == $retryAfter && $retryAfter <= Stripe::getMaxRetryAfter()) {
            $sleepSeconds = max($sleepSeconds, $retryAfter);
        }

        return $sleepSeconds;
    }

    
    private 
function initCurlHandle()
    {
        $this->closeCurlHandle();
        $this->curlHandle = curl_init();
    }

    
    private 
function closeCurlHandle()
    {
        if (!is_null($this->curlHandle)) {
            curl_close($this->curlHandle);
            $this->curlHandle = null;
        }
    }

    
    private 
function resetCurlHandle()
    {
        if (!is_null($this->curlHandle) && $this->getEnablePersistentConnections()) {
            curl_reset($this->curlHandle);
        } else {
            $this->initCurlHandle();
        }
    }

    
    private 
function canSafelyUseHttp2()
    {
                        $curlVersion = curl_version()['version'];
        return (version_compare($curlVersion, '7.60.0') >= 0);
    }

    
    private 
function hasHeader($headers, $name)
    {
        foreach ($headers as $header) {
            if (strncasecmp($header, "{$name}: ", strlen($name) + 2) === 0) {
                return true;
            }
        }

        return false;
    }
}
