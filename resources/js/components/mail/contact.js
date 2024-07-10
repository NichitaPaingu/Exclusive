$(document).ready(function() {
    $('#contact-form').on('submit', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: '/api/contact/send',
            method: $(this).attr('method'),
            data: formData,
            success: function(response) {
                if (response.message) {
                    $('#message-container').html('<div class="alert alert-success">' + response.message + '</div>');
                } else {
                    $('#message-container').html('<div class="alert alert-danger">Something went wrong. Please try again.</div>');
                }
                $('#contact-form')[0].reset();
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessages = '<div class="alert alert-danger"><ul>';
                $.each(errors, function(key, value) {
                    errorMessages += '<li>' + value[0] + '</li>';
                });
                errorMessages += '</ul></div>';
                $('#message-container').html(errorMessages);
            }
        });
    });
});
