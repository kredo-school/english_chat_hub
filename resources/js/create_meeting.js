const times = (date) => {
    let options = '<option value="" disabled selected>Select Time</option>';
    $.each(availableRooms[date], (index, val) => {
        options += `<option value='${index}'>${index}</option>`;
    });
    return options;
};

const rooms = (date, time) => {
    let options = '<option value="" disabled selected>Select Room</option>';
    if (availableRooms[date] && availableRooms[date][time]) {
        $.each(availableRooms[date][time], (index, val) => {
            options += `<option value='${val}'>Room_${val}</option>`;
        });
    } else {
        options += `<option value=''>No available rooms</option>`;
    }
    return options;
};

$('document').ready(function () {
    $('#date').change(() => {
        $('#start_at').removeAttr('disabled');
        $('#start_at').html(times($('#date').val()));
    });
    $('#start_at').change(() => {
        $('#room').removeAttr('disabled');
        const date = $('#date').val();
        const time = $('#start_at').val();
        $('#room').html(rooms(date, time));
    });
});