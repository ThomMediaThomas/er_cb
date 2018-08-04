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
	global $wpdb;

	$dateFromFormatted = date('Ymd', $dateFrom);
	$dateToFormatted = date('Ymd', $dateTo);

	$sqlQuery = "
		SELECT DISTINCT $wpdb->posts.* 
		FROM $wpdb->posts, $wpdb->postmeta AS post_meta_1, $wpdb->postmeta AS post_meta_2
		WHERE $wpdb->posts.ID = post_meta_1.post_id 
		AND $wpdb->posts.ID = post_meta_2.post_id 
		AND $wpdb->posts.post_type = 'booking'
		AND 
		(
			(
				post_meta_1.meta_key = 'date_from' 
				AND post_meta_1.meta_value >= '$dateFromFormatted'
				AND post_meta_1.meta_value <= '$dateToFormatted'
			) OR (
				post_meta_1.meta_key = 'date_to' 
				AND post_meta_1.meta_value >= '$dateFromFormatted'
				AND post_meta_1.meta_value <= '$dateToFormatted'
				
			)
		)
		AND post_meta_2.meta_key = 'assigned' 
		AND post_meta_2.meta_value = $accomodationId
		AND $wpdb->posts.post_status = 'publish' 
		ORDER BY $wpdb->posts.post_date DESC
	";

	$results = $wpdb->get_results($sqlQuery, OBJECT);

	return $results;
 }

//This function retrieves all bookings per period
 function getBookingsPerPeriod($dateFrom, $dateTo)
 { 	
	global $wpdb;  

	$dateFromFormatted = date('Ymd', $dateFrom);
	$dateToFormatted = date('Ymd', $dateTo);

	$sqlQuery = "
		SELECT DISTINCT $wpdb->posts.* 
		FROM $wpdb->posts, $wpdb->postmeta AS post_meta_1
		WHERE $wpdb->posts.ID = post_meta_1.post_id 
		AND $wpdb->posts.post_type = 'booking'
		AND 
		(
			(
				post_meta_1.meta_key = 'date_from' 
				AND post_meta_1.meta_value >= '$dateFromFormatted'
				AND post_meta_1.meta_value <= '$dateToFormatted'
			) OR (
				post_meta_1.meta_key = 'date_to' 
				AND post_meta_1.meta_value >= '$dateFromFormatted'
				AND post_meta_1.meta_value <= '$dateToFormatted'
				
			)
		)
		AND $wpdb->posts.post_status = 'publish' 
		ORDER BY $wpdb->posts.post_date DESC
	";

	$results = $wpdb->get_results($sqlQuery, OBJECT);

	return $results;
 }

 function getAccomodationNameHtml($accomodation)
 {
	return '<strong>' . get_post_meta($accomodation->ID, 'number', true) . '</strong><br />(' . get_the_title($accomodation->ID) . ')';
 }