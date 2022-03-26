<?php
/**
 * The Template for displaying the [memb_list_children] shortcode wrapper and query loop
 *
 * This template can be overridden by copying it to yourtheme/memberium/memb_list_children_container.php.
 *
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 *
 * @param array $atts Contains shortcode attributes
 * @param array $data Contains all shortcode and query data
 *
*/



$wrap_class     = !empty($atts['css_class']) ? "{$atts['css_class']}"     : "";
$id_attr        = !empty($atts['css_id'])    ? " id=\"{$atts['css_id']}\"" : "";
$can_disconnect = $atts['can_disconnect'];
$fields         = $atts['fields'];
$message        = !empty($data['message']) ? "<p>{$data['message']}</p>" : "";

echo "<div data-memb_list_children_number=\"{$atts['list_number']}\" class=\"memb_list_children {$wrap_class}\"{$id_attr}>";

do_action('m4ac/groupaccounts/list/children/before/table', $atts, $data );

if( empty($atts['no_search']) ){
    echo "<div class=\"memb_list_children-search-wrap\">";
        echo "<input type=\"search\" value=\"\" placeholder=\"".__("Search By Email", 'memberium') . "\">";
        echo "<button data-memb_list_children-action=\"search\">";
            echo $atts['search_text'];
        echo "</button>";
    echo "</div>";
}

echo "<div class=\"memb_list_children-results-message\">{$message}</div>";

echo "<table>";
echo "<thead>";
echo "<tr>";
foreach ($atts['columns'] as $label) {
    echo "<th>{$label}</th>";
}
echo $can_disconnect ? "<th></th>" : "";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
if( ! empty($data['contacts']) ){
    foreach ($data['contacts'] as $contact) {
        include $data['row_template'];
    }
}
else{
    $contact = false;
    include $data['row_template'];
}

echo "</tbody>";

echo "</table>";

if( (int) $atts['pages'] > 1 ){
    $page        = (int)$atts['page'];
    $pages       = (int)$atts['pages'];
    $url_sprintf = $atts['url_sprintf'];
    include $data['nav_template'];
}

do_action('m4ac/groupaccounts/list/children/after/table', $atts, $data );

echo "</div>";
