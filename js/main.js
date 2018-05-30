$(document).ready(function() {
    // On click on close sign at messages (login page if error)
	$('.close').click(function() {
   		$('.alert').hide();
	});

	// If is there date fields - run a plugin for them
	if($('#start-date').length) {
        $('#start-date').dateRangePicker({
            singleDate: true,
            showDropdowns: true
        });
        $('#end-date').dateRangePicker({
            singleDate: true,
            showDropdowns: true
        });
    }
});
