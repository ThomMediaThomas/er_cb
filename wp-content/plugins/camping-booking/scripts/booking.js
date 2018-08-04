jQuery(document).ready(function ($) {
	var isBookingPage = $('#post_type').val() === 'booking';
	
	//disable page-title
	if(isBookingPage){
		$('#title').attr('disabled','disabled');
	}

	//add logic for assign-box
	var $assignedSelect = $('#acf-field-assigned'),
		assignables = [];

	$assignedSelect.find('option').each(function(){
		if ($(this).val() != 'null') {
		    assignables.push(parseInt($(this).val()));
		}
	});

	if (isBookingPage && $assignedSelect.length > 0) {
		$assignedSelect.attr('disabled', 'disabled');

		setTimeout(function () {
			var dateFrom = $('#acf-date_from').find('input.hasDatepicker').val(),
				dateTo = $('#acf-date_to').find('input.hasDatepicker').val();

			console.log('/wp-json/camping-booking/assigned_accomodations?date_from=' + dateFrom + '&date_to=' + dateTo);

			$.get('/wp-json/camping-booking/assigned_accomodations?date_from=' + dateFrom + '&date_to=' + dateTo, {}, function (accomodations) {
				$assignedSelect.find('option').each(function(){
					var $this = $(this),
					parsedValue = parseInt($this.val());
					if ((accomodations.indexOf(parsedValue) > -1)) {
						$this.attr('disabled', 'disabled');
					}else{
						$this.removeAttr('disabled');
					}
				});
				$assignedSelect.removeAttr('disabled');
			});
		}, 1000);
	}
});