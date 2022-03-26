<?php

$html .= "<div class=\"{$className}wpal-ecomm wpal-ecomm-order-form\" ";
    $html .= "data-order-form-id=\"{$unique_id}\" ";
    $html .= "data-order-form-instance=\"{$_count}\">";

        $html .= "<div class=\"wpal-ecomm-order-form-inner\">";

                $html .= "<div class=\"wpal-ecomm-column left\">";

                        $html .= "<div class=\"wpal-ecomm-login-wrap\"></div>";

                        $html .= "<div class=\"wpal-ecomm-contact-fields-wrap\"></div>";

                        $html .= "<div class=\"wpal-ecomm-billing-fields-wrap\"></div>";

                        $html .= "<div class=\"wpal-ecomm-payment-methods-wrap\"></div>";

                        $html .= "<div class=\"wpal-ecomm-consent-fields-wrap\"></div>";

                        $html .= "<div class=\"wpal-ecomm-button-wrap\"></div>";

                $html .= "</div>";

                $html .= "<div class=\"wpal-ecomm-column right\">";
            $html .= "<div class=\"wpal-ecomm-column-right-inner sticky-container\">";
                                $html .= "<div class=\"wpal-ecomm-products-wrap\"></div>";
                                $html .= "<div class=\"wpal-ecomm-subscriptions-wrap\"></div>";
                                $html .= "<div class=\"wpal-ecomm-cart-wrap\"></div>";
                            $html .= "</div>";
                $html .= "</div>";

        $html .= "</div>";

$html .= "</div>";
