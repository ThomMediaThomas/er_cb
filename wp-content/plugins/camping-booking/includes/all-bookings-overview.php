<?php

 function add_acf_columns ($columns) {
   unset($columns['date']);
   return array_merge ($columns, array ( 
     'booking_type' => __('Type verblijf'),
     'fullname' => __('Name'),
     'date_from' => __('Van'),
     'date_to' => __('Tot'),
   ) );
 }
 add_filter ('manage_booking_posts_columns', 'add_acf_columns');


 function exhibition_custom_column ($column, $post_id){
 	switch ($column) {
 		case 'fullname':
 			$name = get_post_meta($post_id, 'first_name', true) . ' ' . get_post_meta($post_id, 'name', true);
 			echo $name;
 		break;
 		case 'booking_type':
 			$type = get_post_meta($post_id, 'type', true);
 			$friendlyType = '';

 			if ($type == 'chalet') {
 				$friendlyType = getFieldSelectLabel('type', $post_id) . ': ' . getFieldSelectLabel('chalet_type', $post_id);
 			} else {
 				$friendlyType = getFieldSelectLabel('type', $post_id) . ': ' . getFieldSelectLabel('camping_type', $post_id);
 			}

 			echo $friendlyType;
 		break;
 		default:
 			echo get_post_meta($post_id, $column, true);
 		break;	
 	}
   
 }
 add_action ('manage_booking_posts_custom_column', 'exhibition_custom_column', 10, 2);

 function getFieldSelectLabel($field, $post_id)
 {
	$field = get_field_object($field, $post_id);
	$value = $field['value'];
	$label = $field['choices'][ $value ];
	return $label;
 }