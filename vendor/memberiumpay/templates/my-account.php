<?php

$html .= "<div class=\"{$className}wpal-ecomm wpal-ecomm-account\">";

        $html .= "<div class=\"wpal-ecomm-account-inner\">";

                $html .= "<div class=\"wpal-ecomm-column left\">";
                        $html .= "<nav class=\"wpal-ecomm-account-menu\">";
            foreach ($menu as $slug => $label) {
                $active = ( $view === $slug ) ? " {$active_class}" : '';
                $data_attr = '';
                if( $slug === 'logout' ){
                    $data_attr = " data-url=\"{$log_out_url}\"";
                }
                $html .= "<button class=\"wpal-ecomm-menu-item{$active}\" value=\"{$slug}\"{$data_attr}>";
                    $html .= $label;
                $html .= "</button>";
            }
            $html .= "</nav>";
                $html .= "</div>";

                $html .= "<div class=\"wpal-ecomm-column right wpal-ecomm-account-info\">";

                        $html .= "<div class=\"wpal-ecomm-account-info\"></div>";

                $html .= "</div>";

        $html .= "</div>";

$html .= "</div>";
