$("#submitBtn").on('click', function () {
    let email = $("#email").val()
    let password = $("#password").val()
    if (email === "" || password === ""){
        alert("Email and Password are both necessary to login!");
        return false;
    }
    $.ajax({
        type: "POST",
        url: "../jquery/login-jquery.php",
        data: {
            email: email,
            password: password
        }
    }).done(function (returnedData) {
        if (JSON.parse(returnedData) === false){
            $("#error-message").show();
        }else{
            window.location.replace("../view/manage/index.php");
        }
    })
})