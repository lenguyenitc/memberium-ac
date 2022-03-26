<?php
/**
 * The Template for displaying the [memb_list_children] shortcode navigation
 *
 * This template can be overridden by copying it to yourtheme/memberium/memb_list_children_navigation.php
 *
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 *
 * @param int    $page         Current Page Number
 * @param int    $pages        Number of Current Pages
 * @param string $url_sprintf  URL Sprintf
 *
*/



echo "<nav class=\"memb_list_children-nav\">";

if ( $page > 1 ) {
    $n    = $page - 1;
    $href = sprintf($url_sprintf, $n);
    echo "<span class=\"memb_list_children-nav-item previous\">";
    echo "<a data-memb_list_children-action=\"{$n}\" href=\"{$href}\">";
        echo __( '&laquo; Previous' );
    echo "</a></span>";
}

if( $pages > 1 ){
    for ( $n = 1; $n <= $pages; $n++ ) {
        if ( $n == $page ) {
            echo "<span aria-current=\"account-page\" class=\"memb_list_children-nav-item current\">";
                echo number_format_i18n( $n );
            echo "</span>";
        }
        else {
            $href = sprintf($url_sprintf, $n);
            echo "<span class=\"memb_list_children-nav-item page\">";
            echo "<a data-memb_list_children-action=\"{$n}\" href=\"{$href}\">";
                echo number_format_i18n( $n );
            echo "</a></span>";
        }
    }
}

if ( $page < $pages ) {
    $n    = $page + 1;
    $href = sprintf($url_sprintf, $n);
    echo "<span class=\"memb_list_children-nav-item next\">";
    echo "<a data-memb_list_children-action=\"{$n}\" href=\"{$href}\">";
        echo __( 'Next &raquo;' );
    echo "</a></span>";
}

echo "</nav>";
