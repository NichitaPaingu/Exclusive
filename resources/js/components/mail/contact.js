$(document).ready(function() {
    $('#contact-form').on('submit', function(event) {
        event.preventDefault(); // предотвратить перезагрузку страницы
        var formData = $(this).serialize(); // сериализация данных формы

        $.ajax({
            url: '/api/contact/send', // обновленный URL
            method: $(this).attr('method'),
            data: formData,
            success: function(response) {
                if (response.message) {
                    $('#form-messages').html('<div class="alert alert-success">' + response.message + '</div>');
                } else {
                    $('#form-messages').html('<div class="alert alert-danger">Something went wrong. Please try again.</div>');
                }
                $('#contact-form')[0].reset(); // сброс формы
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessages = '<div class="alert alert-danger"><ul>';
                $.each(errors, function(key, value) {
                    errorMessages += '<li>' + value[0] + '</li>';
                });
                errorMessages += '</ul></div>';
                $('#form-messages').html(errorMessages);
            }
        });
    });
});
