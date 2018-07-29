<?php

 function add_acf_columns ($columns) {
   unset($columns['date']);
   return array_merge ($columns, array ( 
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
 		default:
 			echo get_post_meta($post_id, $column, true);
 		break;	
 	}
   
 }
 add_action ('manage_booking_posts_custom_column', 'exhibition_custom_column', 10, 2);