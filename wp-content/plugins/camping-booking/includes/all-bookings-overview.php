<?php

 function add_booking_acf_columns ($columns) {
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
 add_filter ('manage_booking_posts_columns', 'add_booking_acf_columns');


 function booking_custom_column ($column, $post_id){
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
 		case 'assigned':
 			$placeId = get_post_meta($post_id, 'assigned')[0];
 			if (placeId) {
 				echo get_post_meta($placeId, 'number', true);
 			}
 		break;
 		case 'status':
 		case 'payment_status':
 			echo getFieldSelectLabel($column, $post_id);
 		break;
 		default:
 			echo get_post_meta($post_id, $column, true);
 		break;	
 	}
   
 }
 add_action ('manage_booking_posts_custom_column', 'booking_custom_column', 10, 2);
