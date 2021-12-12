$("#button-addon2").on("click", function () {
    f();
});

$('#player_name').keydown(function (event) {
    const keyCode = (event.keyCode ? event.keyCode : event.which);
    if (keyCode === 13) {
        $('#button-addon2').trigger('click');
    }
});

$( document ).ready(function() {
    $("#player_name").focus();
});
function f() {
    let player_name = $("#player_name").val();
    let court_id = $("#court_id").val();

    if(player_name === ""){
        return false;
    }
    $.ajax({
        type: "POST",
        url: "/jquery/insert-player-jquery.php",
        data: {
            player_name: player_name,
            court_id: court_id
        }
    }).done(function (returnedData) {
        // console.dir(returnedData)
        location.reload();
    })
}