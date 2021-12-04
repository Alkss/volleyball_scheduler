$( document ).ready(function() {
    $("#logoutBtn").on("click", function () {
        let user_id = $("#user_id").val();
        console.log('hit');
        $.ajax({
            type: "POST",
            url: "../../jquery/logout-jquery.php",
            data: user_id
        }).done(function () {
            window.location.replace("../index.php");
        })
    })
});
