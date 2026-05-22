function validateform() {
    var alertBox = '';
    if ($('#name').val() == "") {
        $('#name').focus();
        alertBox = '<div  class="bg-danger" style="text-align:center;color:white">Please Enter Name</div>';
        $('#contact-form').find('#alert-msg').html(alertBox);


        return false;
    }
    if ($('#phone').val() == "") {
        //alertinfo("Please Enter Phone");
        $('#phone').focus();
        alertBox = '<div  class="bg-danger" style="text-align:center;color:white">Please Enter Phone</div>';
        $('#contact-form').find('#alert-msg').html(alertBox);
        return false;
    }
    if ($('#email').val() == "") {
        //alertinfo("Please Enter Email");
        $('#email').focus();
        alertBox = '<div  class="bg-danger" style="text-align:center;color:white">Please Enter Email</div>';
        $('#contact-form').find('#alert-msg').html(alertBox);

        return false;
    }

    return true;
}

function SendMessage() {
   
    if (validateform() == true) {
        load_overlay();
        //var data = new FormData($("#captcha_form")[0]);

        $.ajax({
            type: "POST",
            url: "mailapi/contactmail.php",
            data: $("#contact-form").serialize(),
            success: function (data) {
                close_overlay();
                // data = JSON object that contact.php returns
                // we recieve the type of the message: success x danger and apply it to the

                 var messageText = data.message;
                // let's compose Bootstrap alert box HTML
                var alertBox = '<div  class="bg-success" style="text-align:center;color:black">' + messageText + '</div>';
                // If we have messageAlert and messageText
               

                    // empty the form
                
                $('#contact-form').find('#alert-msg').html(alertBox);

                var whatsapptext = "Hi My name is " + $('#name').val() + ". I want to chat with you. ";
                $('#contact-form')[0].reset();
                window.open("https://wa.me/+971505989752?text="+whatsapptext.toString(), '_blank');
            },
            error: function (xhr, status) {
                close_overlay();
                
                var alertBox = '<div  class="bg-danger" style="text-align:center;color:white">' + xhr.responseText + '</div>';
                //var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissible fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' + xhr.responseText + '</div>';
                var whatsapptext = "Hi My name is " + $('#name').val() + ". I want to chat with you." ;
                window.open("https://wa.me/+971505989752?text=" + whatsapptext.toString(), '_blank');
            }

        });
    }
}