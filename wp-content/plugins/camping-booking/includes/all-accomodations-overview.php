<?php

 function add_accomodation_acf_columns ($columns) {
   unset($columns['date']);
   return array_merge ($columns, array ( 
     'accommodation_type' => __('Type verblijf'),
     'number' => __('Pleknummer')
   ) );
 }
 add_filter ('manage_accommodation_posts_columns', 'add_accomodation_acf_columns');


 function accomodation_custom_column ($column, $post_id){
 	switch ($column) {
 		case 'accommodation_type':
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
 add_action ('manage_accommodation_posts_custom_column', 'accomodation_custom_column', 10, 2);