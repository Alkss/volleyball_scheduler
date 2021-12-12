$(".rmv-btn").on('click',function () {
    let id = $(this).attr("data-id");
    $.ajax({
        type: "POST",
        url: "/jquery/add-remove-player-jquery.php",
        data: {
            id: id,
            action: "remove",
        }
    }).done(function () {
        location.reload();
    })})

$(".add-btn").on('click',function () {
    let id = $(this).attr("data-id");
    $.ajax({
        type: "POST",
        url: "/jquery/add-remove-player-jquery.php",
        data: {
            id: id,
            action: "add",
        }
    }).done(function () {
        location.reload();
    })
})

$("#scheduleTrigger").on("change", function () {
    let schedule = $("#scheduleTrigger").is(":checked");
    $("#scheduleInput").prop("disabled", !schedule);
})

$("#edit").on('click', function () {
    let day_week = $("#day_week").val();
    let max_players = $("#max_players").val();
    let dateInput = $("#dateInput").val();
    let scheduleInput = $("#scheduleInput").val();
    let court_id = $("#court_id").val();
    let owner = $("#owner").val();
    let isOpen = $("#isOpen").is(":checked");
    let schedule = $("#scheduleTrigger").is(":checked");


    //validates if the fields are being filled
    if (day_week === null || max_players === '' || dateInput === '' || (scheduleInput === '' && schedule === true)) {
        alert('Please, fill every field before proceeding!');
        return false;
    }
    $.ajax({
        type: "POST",
        url: "/jquery/edit-court-jquery.php",
        data: {
            owner: owner,
            court_id: court_id,
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

