$(document).ready(function() {

    $('#telegramBtn').click(function() {
        $.ajax({
            url: '/ajax/telegram.testMessage/' + $(this).data('token'),
            success: function(data) {
                if(!data['success']) {
                    alert('Произошла ошибка при отправке сообщения!');
                }
                alert('Сообщение отправлено!');
            }
        });
    });

    $('#unbindTelegram').click(function() {
        $.ajax({
            url: '/ajax/telegram.unbind/' + $(this).data('token'),
            success: function(data) {
                if(!data['success']) {
                    alert('Произошла ошибка при отвязке!');
                }
                alert('Успешно отвязано!');
                location.reload();
            }
        });
    });
    
    $('.confirmDelete').click(function() {
        return confirm("Вы точно хотите удалить?");
    });

});