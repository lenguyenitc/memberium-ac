<?php
/**
 * The Template for displaying the [memb_list_children] shortcode contact row
 *
 * This template can be overridden by copying it to yourtheme/memberium/memb_list_children_row.php
 *
 * Copyright (c) 2021 David J Bullock
 * Web Power and Light
 *
 * @param bool  $can_disconnect  Show the Disconnect Button
 * @param array $contact         Contains contact data
 * @param array $fields          Contains Field Keys
 *
*/



echo "<tr>";

if( ! empty($contact) ){

    foreach ($fields as $field_key) {
        $field_value = array_key_exists($field_key, $contact) ? $contact[$field_key] : '';
        $field_value = apply_filters('m4ac/groupaccounts/list/field/value', $field_value, $field_key, $contact['user_id']);
        echo "<td>{$field_value}</td>";
    }

        if( $can_disconnect ){
        echo "<td>";
        echo "<button data-memb_list_children-action=\"disconnect\" value=\"{$contact['user_id']}\">";
        echo __('Disconnect', 'memberium');
        echo "</button>";
        echo "</td>";
    }

}
else {
    $colspan = count( $fields );
    $colspan = $can_disconnect ? $colspan + 1 : $colspan;

    echo "<td colspan=\"{$colspan}\">";
        printf(_x('No %s Found', 'memb_list_children', 'memberium'), $attrs['name_plural']);
    echo "</td>";
}

echo "</tr>";
