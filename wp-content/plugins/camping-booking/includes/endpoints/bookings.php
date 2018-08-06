<?php
/**
 * Grab latest post title by an author!
 *
 * @param array $data Options for the function.
 * @return string|null Post title for the latest,  * or null if none.
 */
function unavailable_accomodations($request) {
	$date_from = strtotime($request['date_from']);
	$date_to = strtotime($request['date_to']);
	$type = $request['type'];
	$subType = $request['subType'];
	
	$accomodations = getUnavailableAccomodations($date_from, $date_to, $type, $subtype);
	return array_values(array_unique($accomodations));
}

add_action('rest_api_init', function () {
  register_rest_route('camping-booking', '/unavailable_accomodations', array(
    'methods' => 'GET',
    'callback' => 'unavailable_accomodations',
  ) );
});