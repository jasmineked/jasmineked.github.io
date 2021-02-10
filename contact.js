$(function () {

// init the validator

$('#contact-form').validator();

// when the form is submitted
$('#contact-form').on('submit', function (e) {

    // if the validator does not prevent form submit
    if (!e.isDefaultPrevented()) {
        var url = "contact.php";

        // post values in the bg the script URL
        $.ajax({
            type: "POST",
            url: url,
            data: $(this).serialize(),
            success: function (data)
            {
                // data = JSON object that contact.php returns

                //we receive the type of the message: success x danger 
                var messageAlert = 'alert-' + data.type;
                var messageText = data.message;
                 // lets compose bootstrap alert box HTML 
                 var alertBox = '<div class="alert ' + messageAlert + 'alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';

                 // if we have messagealert and messagetext
                 if (messageAlert && messageText) {
                     // inject the alert to messages div in our form
                     $('#contact-form').find('.messages').html(alertBox);
                     //empty the form
                     $('#contact-form')[0].reset();
                 }
            }
        });
        return false;
    }
})

});