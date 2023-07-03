const week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
const monthName = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
];
const today = new Date();
var showDate = new Date(today.getFullYear(), today.getMonth(), 1);

window.onload = function () {
    showProcess(today, calendar);
};
window.prev = function () {
    showDate.setMonth(showDate.getMonth() - 1);
    showProcess(showDate);
}

window.next = function () {
    showDate.setMonth(showDate.getMonth() + 1);
    showProcess(showDate);
}

function showProcess(date) {
    var year = date.getFullYear();
    var month = date.getMonth();
    document.querySelector('#header').innerHTML = year + ' ' + monthName[month];

    var calendar = createProcess(year, month);
    document.querySelector('#calendar').innerHTML = calendar;
}

function createProcess(year, month) {
    var calendar = "<table><tr class='dayOfWeek'>";
    for (var i = 0; i < week.length; i++) {
        calendar += "<th>" + week[i] + "</th>";
    }
    calendar += "</tr>";

    var count = 0;
    var startDayOfWeek = new Date(year, month, 1).getDay();
    var endDate = new Date(year, month + 1, 0).getDate();
    var lastMonthEndDate = new Date(year, month, 0).getDate();
    var row = Math.ceil((startDayOfWeek + endDate) / week.length);

    for (var i = 0; i < row; i++) {
        calendar += "<tr>";
        for (var j = 0; j < week.length; j++) {
            if (i == 0 && j < startDayOfWeek) {
                calendar += "<td class='disabled'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
            } else if (count >= endDate) {
                count++;
                calendar += "<td class='disabled'>" + (count - endDate) + "</td>";
            } else {
                count++;
                var dateValue = `${year}-${month + 1}-${count}`;
                var url = `users/meetings/search/${dateValue}/result`;
                if (year == today.getFullYear()
                    && month == (today.getMonth())
                    && count == today.getDate()) {
                    calendar += `<td class='today'><a href='${url}'>${count}</a></td>`;
                } else {
                    if (year < today.getFullYear()) {
                        calendar += `<td>${count}</td>`;
                    } else if (year == today.getFullYear()) {
                        if (month < (today.getMonth())) {
                            calendar += `<td>${count}</td>`;
                        } else if (month == (today.getMonth())) {
                            if (count < today.getDate()) {
                                calendar += `<td>${count}</td>`;
                            } else {
                                calendar += `<td><a href='${url}'>${count}</a></td>`;
                            }
                        } else {
                            calendar += `<td><a href='${url}'>${count}</a></td>`;
                        }
                    } else {
                        calendar += `<td><a href='${url}'>${count}</a></td>`;
                    }
                }
            }
        }
        calendar += "</tr>";
    }
    return calendar;
}