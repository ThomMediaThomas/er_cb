<?php
//This function is used to get the friendly label of a ACF-select-field
 function getFieldSelectLabel($field, $post_id)
 {
	$field = get_field_object($field, $post_id);
	$value = $field['value'];
	$label = $field['choices'][ $value ];
	return $label;
 }

//This function is used to create a attributable-version of a column-value
 function echoColumnValue($column, $content)
 {	
 	$formattedContent = strip_tags($content, true);
 	$formattedContent = str_replace(':', '', $formattedContent);
 	$formattedContent = str_replace('(', '', $formattedContent);
 	$formattedContent = str_replace(')', '', $formattedContent);
 	$className = strtolower(str_replace(' ', '_', $formattedContent));
	echo '<span class="booking-' . $column .' booking-' . $className .'">';
 		echo $content;
 	echo '</span>';
 }

//This function retrieves all bookings for an accomodation per period
 function getBookingsForAccomodationPerPeriod($accomodationId, $dateFrom, $dateTo)
 {
 	return get_posts([
	  	'post_type' => 'booking',
		'orderby' => 'meta_value_num',
		'meta_key' => 'date_from',
		'order'	=> 'ASC',
	  	'numberposts' => -1,
		'meta_query'	=> array(
			'relation' => 'AND',
			array(
				'relation'		=> 'OR',
				array(
					'key' => 'date_from',
					'compare' => '>=',
					'value'=> date('Ymd', $dateFrom)
				),			
				array(
					'key' => 'date_from',
					'compare' => '<=',
					'value'=> date('Ymd', $dateTo)
				),
				array(
					'key' => 'date_to',
					'compare' => '>=',
					'value'=> date('Ymd', $dateFrom)
				),			
				array(
					'key' => 'date_to',
					'compare' => '<=',
					'value'=> date('Ymd', $dateTo)
				)
			),	
			array(
				'key' => 'assigned',
				'compare' => '=',
				'value'=> $accomodationId
			)
		)
	]);;
 }

 function getAccomodationNameHtml($accomodation)
 {
	return '<strong>' . get_post_meta($accomodation->ID, 'number', true) . '</strong><br />(' . get_the_title($accomodation->ID) . ')';
 }