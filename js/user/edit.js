$("#edit").on('click', function () {


    let user_id = $("#user_id").val()
    let user_name = $("#user_name").val()
    let user_email = $("#user_email").val()
    let user_password = $("#user_password").val()
    let user_password_confirm = $("#user_password_confirm").val()
    let isAdmin = $("#isAdmin").is(":checked")


    $.ajax({
        type: "POST",
        url: "/jquery/edit-user-jquery.php",
        data: {
            user_id: user_id,
            user_name: user_name,
            user_email: user_email,
            user_password: user_password,
            user_password_confirm: user_password_confirm,
            isAdmin: isAdmin
        }
    }).done(function (returnedData) {
        console.dir(returnedData)
        let parsedData = JSON.parse(returnedData);
        if (parsedData.includes("success")){
            $("#success-message").show();
            $("#email-message").hide();
            $("#password-message").hide();

            $("#user_password").val('');
            $("#user_password_confirm").val('');
            return true;
        }

        if (parsedData.includes("email")) {
            $("#email-message").show();
        }
        if (parsedData.includes("password")) {
            $("#password-message").show();
        }
        /*else {
            window.location.replace("../view/manage/index.php");
        }*/
    })

})