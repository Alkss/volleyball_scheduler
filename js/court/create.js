
$("#scheduleTrigger").on("change", function () {
    let schedule = $("#scheduleTrigger").is(":checked");
    $("#scheduleInput").prop("disabled", !schedule);
})

$("#create").on('click', function () {
    let day_week = $("#day_week").val();
    let max_players = $("#max_players").val();
    let dateInput = $("#dateInput").val();
    let scheduleInput = $("#scheduleInput").val();
    let isOpen = $("#isOpen").is(":checked");
    let schedule = $("#scheduleTrigger").is(":checked");


    //validates if the fields are being filled
    if (day_week === null || max_players === '' || dateInput === '' || (scheduleInput === '' && schedule === true )) {
        alert('Please, fill every field before proceeding!');
        return false;
    }
    $.ajax({
        type: "POST",
        url: "/jquery/create-court-jquery.php",
        data: {
            day_week: day_week,
            schedule: schedule,
            max_players: max_players,
            dateInput: dateInput,
            scheduleInput: scheduleInput,
            isOpen: isOpen,
        }
    }).done(function () {
        window.location.replace("/view/manage/courts/index.php");
    })
})