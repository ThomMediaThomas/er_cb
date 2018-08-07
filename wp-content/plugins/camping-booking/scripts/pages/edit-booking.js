jQuery(document).ready(function ($) {
	var isBookingPage = $('#post_type').val() === 'booking';
	
	//disable page-title
	if(isBookingPage){
		$('#title').attr('disabled','disabled');
	}

	//add logic for assign-box
	var $assignedSelect = $('#acf-field-assigned');

	if (isBookingPage) {
		$assignedSelect.after('<a href="#" class="button" id="reload-assign-select">Beschikbare plaatsen herladen</a>');

		$('#reload-assign-select').on("click", function () {
			updateSelect($assignedSelect);
			return false;
		});

		$assignedSelect.attr('disabled', 'disabled');

		setTimeout(function () {
			updateSelect($assignedSelect);
		}, 1000);
	}
});

function updateSelect($assignedSelect)
{
	$assignedSelect.attr('disabled', 'disabled');

	var dateFrom = $('#acf-date_from').find('input.hasDatepicker').val(),
		dateTo = $('#acf-date_to').find('input.hasDatepicker').val(),
		type = $('select#acf-field-type').val(),
		subType = type == 'chalet' ? $('#acf-field-chalet_type').val() : $('#acf-field-camping_type').val();

	$.get(createUrl(dateFrom, dateTo, type, subType), {}, function (accomodations) {
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

}

function createUrl (dateFrom, dateTo, type, subType)
{
	return '/wp-json/camping-booking/unavailable_accomodations?date_from=' + dateFrom + '&date_to=' + dateTo + '&type=' + type + '&subtype=' + subType;
}