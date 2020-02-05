$(document).ready(function () {
	// Check the selected task when user is selecting the checkbox
	$('.check-list').on('click', function () {
		if ($(this).is(':checked')) {
			$(this).closest('.item').addClass('checked');
		} else {
			$(this).closest('.item').removeClass('checked');
		}
	});

	// Confirmation window when user deleting the data
	$('.btn-delete').on('click', function (event) {

		event.preventDefault();

		const href = $(this).attr('href');

		Swal.fire({
			title: 'Are you sure?',
			text: "The tasks will be permanently deleted!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: "No, I don't think i will!",
			confirmButtonText: "Yes, I'm sure!"
		}).then((result) => {
			if (result.value) {
				document.location.href = href;
			}
		})
	});
});
