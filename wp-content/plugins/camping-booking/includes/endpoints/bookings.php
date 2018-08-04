<?php
/**
 * Grab latest post title by an author!
 *
 * @param array $data Options for the function.
 * @return string|null Post title for the latest,  * or null if none.
 */
function get_assigned_accomodations($request) {
	$date_from = strtotime($request['date_from']);
	$date_to = strtotime($request['date_to']);
	$bookings = getBookingsPerPeriod($date_from, $date_to);
	return array_values(array_unique(array_map(function ($booking) {
		$assigned = get_field('assigned', $booking->ID);
		return $assigned->ID;
	}, $bookings)));
}

add_action('rest_api_init', function () {
  register_rest_route('camping-booking', '/assigned_accomodations', array(
    'methods' => 'GET',
    'callback' => 'get_assigned_accomodations',
  ) );
});