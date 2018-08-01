<?php

//ADD BOOKING COLUMNS
function add_booking_columns ($columns) {
 unset($columns['date']);
 return array_merge ($columns, array ( 
   'booking_type' => __('Type verblijf'),
   'fullname' => __('Name'),
   'date_from' => __('Van'),
   'date_to' => __('Tot'),
   'status' => __('Status'),
   'payment_status' => __('Betaal-status'),
   'assigned' => __('Toegewezen plek')
 ) );
}

function booking_custom_column ($column, $post_id){
  $content = "";

  switch ($column) {
   case 'fullname':
    $name = get_post_meta($post_id, 'first_name', true) . ' ' . get_post_meta($post_id, 'name', true);
    $content = $name;
   break;
   case 'booking_type':
     $type = get_post_meta($post_id, 'type', true);
     $friendlyType = '';

     if ($type == 'chalet') {
       $friendlyType = getFieldSelectLabel('type', $post_id) . ': ' . getFieldSelectLabel('chalet_type', $post_id);
     } else {
       $friendlyType = getFieldSelectLabel('type', $post_id) . ': ' . getFieldSelectLabel('camping_type', $post_id);
     }

     $content = $friendlyType;
   break;
   case 'assigned':
     $placeId = get_post_meta($post_id, 'assigned')[0];
     if (placeId) {
       $content =  '<strong>' . get_post_meta($placeId, 'number', true) . '</strong><br />(' . get_the_title($placeId) . ')';
     }
   break;
   case 'status':
   case 'payment_status':
    $content = getFieldSelectLabel($column, $post_id);
   break;
   default:
    $content = get_post_meta($post_id, $column, true);
   break;	
 }

 echoColumnValue($column, $content);
}

add_filter ('manage_booking_posts_columns', 'add_booking_columns');
add_action ('manage_booking_posts_custom_column', 'booking_custom_column', 10, 2);

//REMOVE UNNEEDED BOOKING FILTERS
function remove_booking_filters(){
  $screen = get_current_screen();
  if ($screen->post_type == 'booking'){
    add_filter('months_dropdown_results', '__return_empty_array');
    add_filter('bulk_actions-edit-booking', '__return_empty_array');
  }
}

add_action('admin_head', 'remove_booking_filters');