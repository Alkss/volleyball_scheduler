$(".court-btn").on("click", function () {
    let id = $(this).attr("data-id");
    let dayWeekId = $(`#day_week-${id}`).val();
    let owner = $(`#owner-${id}`).val();

    $.ajax({
        type: "POST",
        url: "/jquery/edit-day-jquery.php",
        data: {
            id: id,
            dayWeekId: dayWeekId,
            owner: owner,
        }
    }).done(function () {
        alert("Updated successfully!");
    })
})