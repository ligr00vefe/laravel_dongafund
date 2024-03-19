
var from_date_picker = document.getElementById('from_date');
var to_date_picker = document.getElementById('to_date');

if (from_date_picker) {
    new Pikaday({
        field: document.getElementById('from_date'),
        toString(date, format) {
            const day = ("0" + (date.getDate())).slice(-2);
            const month = ("0" + (date.getMonth() + 1)).slice(-2);
            const year = date.getFullYear();
            const ymd = year + "-" + month + "-" + day;

            return ymd
        },
        theme: "pikaday-dark",
        i18n: {
            previousMonth : 'Previous Month',
            nextMonth     : 'Next Month',
            months        : ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            weekdays      : ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'],
            weekdaysShort : ['일','월','화','수','목','금','토']
        }
    });
}


if (to_date_picker) {
    new Pikaday({
        field: to_date_picker,
        toString(date, format) {
            const day = ("0" + (date.getDate())).slice(-2);
            const month = ("0" + (date.getMonth() + 1)).slice(-2);
            const year = date.getFullYear();
            const ymd = year + "-" + month + "-" + day;

            const from_date = document.getElementById("from_date").value;

            const date1 = new Date(from_date);
            const date2 = new Date(ymd);
            if (date1 > date2) {
                alert(from_date + "보다 많게 설정해야 합니다");
                return "";
            }

            return ymd
        },
        theme: "pikaday-dark",
        i18n: {
            previousMonth : 'Previous Month',
            nextMonth     : 'Next Month',
            months        : ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            weekdays      : ['일요일','월요일','화요일','수요일','목요일','금요일','토요일'],
            weekdaysShort : ['일','월','화','수','목','금','토']
        }
    });

}


var adminUrlPrefix = "b1BjW55p";
