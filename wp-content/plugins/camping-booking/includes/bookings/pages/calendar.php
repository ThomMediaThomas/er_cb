<?php
	$years = [2017, 2018, 2019, 2020];
	$months = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];
	$days = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'];
	$days_short = ['MA', 'DI', 'WO', 'DO', 'VR', 'ZA', 'ZO'];

	//get parameters
	$selected_month = isset($_GET['select_month']) ? $_GET['select_month'] : date('m');
	$selected_year = isset($_GET['select_year']) ? $_GET['select_year'] : date("Y");
	$today = date("d");

	//get all days in month	
	$daysOfMonth = [];
	$start_date = '01-' . $selected_month . '-' . $selected_year;
	$start_time = strtotime($start_date);
	$end_time = strtotime("+1 month", $start_time);

	for ($i=$start_time; $i<$end_time; $i+=86400)
	{
		$date = date('d', $i);
	   $daysOfMonth[] = [
	   	'fulldate' => date('d-m-Y', $i),
	   	'date' => $date,
	   	'day_short' => $days_short[date('w', $i-1)],
	   	'today' => $date == $today
	   ];
	}

	//get all accomodations
	$accomodations = get_posts([
	  'post_type' => 'accommodation',
	  'numberposts' => -1
	]);

	//create a flattened version of above accomodations
	$flattenedAccomodations = [];

	foreach ($accomodations as $accomodation) {
		//set accomodation-name as first key in flattened-array
		$flattenedAccomodations[$accomodation->ID] = [
			'name' => getAccomodationNameHtml($accomodation)
		];

		//get all bookings for this accomocation
		$bookings = getBookingsForAccomodationPerPeriod($accomodation->ID, $start_time, $end_time);	

		//loop throug bookings and than through booked-days to create calendar-overview
		foreach ($bookings as $booking) {
			$bookingDateFrom = new DateTime(get_field('date_from', $booking->ID));
			$bookingDateTo = new DateTime(get_field('date_to', $booking->ID));
			$status = get_field('status', $booking->ID);
			$status = isset($status) ? $status : 'available';

			//create period from start-date till enddate
			$period = new DatePeriod(
			     $bookingDateFrom,
			     new DateInterval('P1D'),
			     $bookingDateTo->add(new DateInterval('P1D'))
			);
			$periodLength = iterator_count($period);

			$counter = 0;

			//loop throug periods
			foreach ($period as $key => $value) {
				$bookingDate = $value->format('d-m-Y');
				//first time: add statuses-array and booking
				if (!array_key_exists($bookingDate, $flattenedAccomodations[$accomodation->ID])) {
					$flattenedAccomodations[$accomodation->ID][$bookingDate]['statuses'] = [];
					$flattenedAccomodations[$accomodation->ID][$bookingDate]['booking'] = $booking;
				}

				//add day-status + enrich with first or last-state
				$enrichedStatus = $status;
				if ($counter == 0) {	
					$enrichedStatus .= ' first';
				}
				if ($counter == $periodLength-1) {
					$enrichedStatus .= ' last';	
				}

				$flattenedAccomodations[$accomodation->ID][$bookingDate]['statuses'][] = $enrichedStatus;

				$counter++;
			}
		}
	}
?>
<div class="wrap">
	<h1 class="wp-heading-inline">Kalender</h1>
	<div class="tablenav top">
		<div class="alignleft actions">
			<form>
				<input type="hidden" name="post_type" value="booking" />
				<input type="hidden" name="page" value="bookings_calendar" />
				<?php include('calendar/fields/select-month.php'); ?>
				<?php include('calendar/fields/select-year.php'); ?>
				<input type="submit" id="refresh" class="button action" value="Verversen">
				<br class="clear">
			</form>
		</div>
	</div>
	<div id="calendar_overview_holder">
		<table id="calendar_overview" class="wp-list-table widefat fixed striped posts">
			<thead>
				<th></th>
				<?php foreach($daysOfMonth as $day): ?>
					<th class="day day-<?php echo strtolower($day['day_short']); ?> <?php echo $day['today'] ? 'today' : ''; ?>">
						<span class="day-label"><?php echo $day['day_short']; ?></span>
						<span class="date-label"><?php echo $day['date']; ?></span>
					</th>
				<?php endforeach; ?>
			</thead>
			<tbody>
				<?php foreach($flattenedAccomodations as $accomodation):  ?>
					<tr>			
						<td><?php echo $accomodation['name']; ?></td>	
						<?php foreach($daysOfMonth as $day): 
							$accomodationDateInfo = $accomodation[$day['fulldate']];
							$dayStatuses = $accomodationDateInfo['statuses']; ?>
							<td class="day-status-holder day-<?php echo strtolower($day['day_short']); ?> count-<?php echo count($dayStatuses); ?> <?php echo $day['today'] ? 'today' : ''; ?>">
								<?php if($accomodationDateInfo && $dayStatuses): ?>
									<?php foreach($dayStatuses as $dayStatus): ?>
										<?php 
											$booking = $accomodationDateInfo['booking']; 
											$first = $accomodationDateInfo['first']; 
											$last = $accomodationDateInfo['last']; 
											$title = $booking->post_title . ': ' . get_field('first_name', $booking->ID) . ' ' . get_field('name', $booking->ID);
										?>
										<a title="<?php echo $title; ?>" 
											class="day-status day-status-<?php echo $dayStatus; ?>"
											href="<?php echo get_edit_post_link($booking->ID); ?>"
										></a>
									<?php endforeach; ?>
								<?php endif; ?>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>