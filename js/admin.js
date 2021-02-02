$(document).ready(function () {
    $('.btn-success').click(function () {
        var editedCar = $(this).val();
        var carName = $(".car_name" + editedCar).val();
        $.ajax({
            type: "POST",
            url: "../../ajax/ajax.php",
            data: {
                action: 'edit',
                car_id: editedCar,
                car_name: carName
            },
            success: function (result) {
                location.reload();
            }
        });
    });
});

$(document).ready(function () {
$('.btn-danger').click(function () {
    var editedCar = $(this).val();
    $.ajax({
        type: "POST",
        url: "../../ajax/ajax.php",
        data: {
            action: 'delete',
            car_id: editedCar
        },
        success: function (result) {
            location.reload();
        }
    });
});
});