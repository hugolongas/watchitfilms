$(document).ready(function () {
    $('#main').on('click','#submit_contact',function (e) {
		e.preventDefault();
		if ($('#contact-form').valid()) {
			$('.spinner').addClass('spinner-active');
			$('#submit_contact').attr('disabled', 'disabled');
			var form_data = new FormData();
            var name = $('#contact_name').val();
            var enterprise = $('#contact_enterprise').val();            
			var email = $('#contact_email').val();
            var message = $('#contact_message').val();
            
            form_data.append('name', name);
            form_data.append('enterprise', enterprise);
			form_data.append('email', email);
			form_data.append('message', message);
			$.ajaxSetup({
				headers:
					{ 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
			});
			$.ajax({
				url: '/contacto',
				dataType: 'text', // what to expect back from the PHP script
				type: 'post',
				data: form_data,
				processData: false,
				contentType: false,
				success: function (response) {
					$('.spinner').removeClass('spinner-active');
					$('#contact-form')[0].reset();
					$('#response').html("<h3>S'ha enviat l'email correctament</h3>").fadeIn('slow');
					$('#submit_contact').removeAttr('disabled');
					setTimeout(function () {
						$('#response').empty();
					}, 5000);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					$('.spinner').removeClass('spinner-active');
					$('#submit_contact').removeAttr('disabled');
					$('#response').text('Error Thrown: ' + errorThrown + '<br>jqXHR: ' + jqXHR + '<br>textStatus: ' + textStatus).show();
				}
			});
		}
		else {
			$('label.error').hide().fadeIn('slow');
		}
	});
});