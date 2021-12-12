$("#create").on('click', function () {

    let dayWeek = $("#day_week").val();
    let owner = $("#owner").val();

    if (dayWeek == null || owner == null){
        alert("Please select both fields before adding a new Day.");
        return true;
    }

    $.ajax({
        type: "POST",
        url: "/jquery/create-day-jquery.php",
        data: {
            dayWeek: dayWeek,
            owner: owner,
        }
    }).done(function () {
        window.location.replace("/view/manage/day/index.php");
    })
})