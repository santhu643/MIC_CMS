<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Calendar</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --text-color: #333;
            --background-color: #f5f5f5;
            --day-bg-color: #fff;
            --status-1-color: rgb(5, 68, 31);
            /* Green */
            --status-0-color: #3498db;
            /* Blue */
            --absent-color: rgb(201, 47, 30);
            /* Red */
            --apresent-color: rgb(156, 126, 5);
            /* Yellow */
            --dayoff-color: #34495e;
            /* Dark Blue */
            --holiday-color: rgb(76, 20, 99);
            /* Purple */
            --future-date-color: #fff;
            /* White */
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .calendar {
            width: 1600px;
            max-width: 1600px;
            margin: 40px auto;
            padding: 30px;
            background-color: var(--day-bg-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-radius: 15px;
            background-image: linear-gradient(to top, #00c6fb 0%, #005bea 100%);

        }

        .calendar-header h2 {
            font-size: 28px;
            font-weight: 500;
            margin-top: 10px;
            color: white;
        }

        .calendar-header button {
            background-color: transparent;
            padding: 20px;
            border: none;
            font-size: 24px;
            color: var(--secondary-color);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .calendar-header button:hover {
            color: var(--primary-color);
        }

        .calendar-weekdays,
        .calendar-body {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }

        .calendar-weekdays {
            margin-bottom: 15px;
        }

        .calendar-weekday {
            text-align: center;
            font-weight: 500;
            color: var(--secondary-color);
            text-transform: uppercase;
            font-size: 14px;
        }

        .calendar-day {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px;
            min-height: 100px;
            position: relative;
            transition: all 0.3s ease;
        }

        .calendar-day:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .calendar-day span {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 16px;
            font-weight: 500;
        }

        .calendar-day ul {
            list-style-type: none;
            padding: 0;
            margin: 30px 0 0 0;
            font-size: 14px;
            font-weight: bold;
        }

        .calendar-day ul li {
            margin-bottom: 5px;
        }

        .status-0 {
            background-color: var(--status-0-color);
            color: #fff;
        }

        .status-1 {
            background-color: var(--status-1-color);
            color: #fff;
        }

        .status-7 {
            background-color: var(--apresent-color);
            color: #fff;
        }

        .absent {
            background-color: var(--absent-color);
            color: #fff;
        }

        .apresent {
            background-color: var(--apresent-color);
            color: var(--text-color);
        }

        .dayoff {
            background-color: var(--dayoff-color);
            color: #fff;
        }

        .holiday {
            background-color: var(--holiday-color);
            color: #fff;
        }

        .future-date {
            background-color: var(--future-date-color);
        }

        .past-date {
            opacity: 0.7;
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            .calendar {
                padding: 20px;
                margin: 20px 10px;
            }

            .calendar-header h2 {
                font-size: 24px;
            }

            .calendar-weekdays {
                display: none;
            }

            .calendar-body {
                display: flex;
                flex-direction: column;
                gap: 15px;
            }

            .calendar-day {
                min-height: auto;
                padding: 15px;
            }

            .calendar-day span {
                position: static;
                font-size: 18px;
                font-weight: 500;
                display: block;
                margin-bottom: 10px;
            }

            .calendar-day ul {
                margin-top: 10px;
                font-size: 14px;
            }

            .calendar-day ul li {
                margin-bottom: 8px;
            }
        }

        .sptxt {
            font-weight: 600;
        }

        .ss {
            color: white;
        }
    </style>
</head>

<body>
    <div id="calendar" class="calendar"></div>

    <script>
        $(document).ready(function () {
            const monthNames = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
            const weekdayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            let currentDate = new Date();

            function renderCalendar() {
                const month = currentDate.getMonth() + 1;
                const year = currentDate.getFullYear();

                $.ajax({
                    url: 'hrleave_back.php',
                    method: 'GET',
                    data: { month: month, year: year, action: 'get_calendar' },
                    dataType: 'json',
                    success: function (data) {
                        const groupedResults = data.reduce((acc, curr) => {
                            const date = new Date(curr.tdate).toLocaleDateString();
                            acc[date] = curr;
                            return acc;
                        }, {});

                        let calendarHtml = `
                            <div class="calendar-header">
                                <button id="prevMonth"><i class="fas fa-chevron-left ss"></i></button>
                                <h2>${monthNames[currentDate.getMonth()]} ${year}</h2>
                                <button id="nextMonth"><i class="fas fa-chevron-right ss"></i></button>
                            </div>
                        `;

                        const firstDayOfMonth = new Date(year, currentDate.getMonth(), 1).getDay();
                        const daysInMonth = new Date(year, currentDate.getMonth() + 1, 0).getDate();
                        const today = new Date();

                        if (window.innerWidth > 768) {
                            calendarHtml += `
                                <div class="calendar-weekdays">
                                    ${weekdayNames.map(day => `<div class="calendar-weekday">${day}</div>`).join('')}
                                </div>
                                <div class="calendar-body">
                            `;

                            // Add empty cells for days before the first day of the month
                            for (let i = 0; i < firstDayOfMonth; i++) {
                                calendarHtml += '<div class="calendar-day"></div>';
                            }

                            // Add cells for each day of the month
                            for (let i = 1; i <= daysInMonth; i++) {
                                const date = new Date(year, currentDate.getMonth(), i);
                                const formattedDate = date.toLocaleDateString();
                                const result = groupedResults[formattedDate] || null;

                                let dayClass = 'calendar-day';
                                if (result) {
                                    dayClass += ' has-results';
                                    if (result.status === 1) dayClass += ' status-1';
                                    else if (result.lc === 1 || result.lc === 0.5) dayClass += ' status-1';
                                    else if (result.lc === 0.5 && result.lc2 === 0.5) dayClass += ' status-1';
                                    if (result.status === 2 && (result.mp === 1 || result.ep === 1 || result.tep === 1 || result.tmp === 1)) dayClass += ' status-1';
                                    else if (result.status === 2) dayClass += ' status-7';
                                    if (result.status === 0) dayClass += ' status-0';
                                    if (result.hday === 1) dayClass += ' holiday';
                                    if (result.lc >= 7) dayClass += ' absent';
                                    if (!result.in_time && !result.out_time && result.lc === 0 && result.mp === 0) dayClass += ' absent';
                                    if (result.hday === 0 && !result.in_time && !result.out_time && result.lc === 0.5 && result.lc2 != 0.5 && date < today) dayClass += ' apresent';
                                    else if (result.hday === 0 && !result.in_time && !result.out_time && result.lc === 0.5 && result.lc2 === 0.5 && date < today) dayClass += ' status-1';
                                }
                                if (date < today) dayClass += ' past-date';
                                if (date > today) dayClass += ' future-date';

                                calendarHtml += `
                                    <div class="${dayClass}">
                                        <span class='sptxt'>${i}</span>
                                        ${renderDayContent(result, date)}
                                    </div>
                                `;
                            }

                            calendarHtml += '</div>';
                        } else {
                            calendarHtml += '<div class="calendar-body">';

                            for (let i = 1; i <= daysInMonth; i++) {
                                const date = new Date(year, currentDate.getMonth(), i);
                                const formattedDate = date.toLocaleDateString();
                                const result = groupedResults[formattedDate] || null;
                                let dayClass = 'calendar-day';

                                if (result) {
                                    dayClass += ' has-results';
                                    if (result.status === 1) dayClass += ' status-1';
                                    if (result.lc === 1 || result.lc === 0.5) dayClass += ' status-1';
                                    if (result.mpu === 1) dayClass += ' status-3';
                                    if (result.lc === 0.5 && result.status === 0) dayClass += ' status-0';
                                    if (result.status === 2 || (result.status === 0 && result.in_time && result.out_time)) dayClass += ' status-0';
                                    if (result.hday === 1) dayClass += ' holiday';
                                    if (result.hday === 0 && !result.in_time && !result.out_time && result.lc === 0 && result.mpu === 0 && date < today) dayClass += ' absent';
                                    if (result.hday === 0 && !result.in_time && !result.out_time && result.lc === 0.5 && date < today) dayClass += ' apresent';
                                    if (result.hday === 0 && !result.in_time && !result.out_time && date > today) dayClass += ' dayoff';
                                }

                                if (date < today) dayClass += ' past-date';
                                if (date > today) dayClass += ' future-date';

                                calendarHtml += `<div class="${dayClass.trim()}"><span>${i} ${weekdayNames[date.getDay()]}</span>
                                                ${renderDayContent(result, date)}
                                                </div>`;
                            }

                            calendarHtml += '</div>';
                        }

                        $('#calendar').html(calendarHtml);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching calendar data:', error);
                    }
                });
            }

            function renderDayContent(result, date) {
                if (!result) return '';
                if (result.ltpye === null) {
                    result.ltype = '';
                }
                let content = '<ul>';
                if (result.in_time && result.out_time) {
                    content += `<li>In: ${result.in_time}</li><li>Out: ${result.out_time}</li>`;
                    if (result.status === 1 && result.lc === 0 && result.mp === 0 && result.ep === 0 && result.tep === 0 && result.tmp === 0) {
                        content += '<li style="color:yellow;">Present</li>';
                    }

                    // else if (result.status === 0 && (result.lc === 1 ) && result.mp === 0 && result.ep === 0 && result.tep === 0 && result.tmp === 0) {
                    //     // content += '<li style="color:yellow;">Present & ' + result.ltype + ' Approved</li>';
                    //     content += '<li style="color:yellow;">Present</li>';
                    // } 



                    else if ((result.status === 0 || result.status === 2) && result.hday === 0 && result.mp === 7 || result.ep === 7 || result.tmp === 7 || result.tep === 7) {
                        content += '<li>FN/AN Session Absent <br>' + result.ltype + ' Permission applied</li>';
                    }

                    else if ((result.status === 0 || result.status === 2) && result.hday === 0 && result.mp === 8 || result.ep === 8 || result.tmp === 8 || result.tep === 8) {
                        content += '<li>FN/AN Session Absent <br>' + result.ltype + ' Permission Forwarded to HR</li>';
                    }



                    else if (result.status === 1 && result.lc == 1) {
                        content += '<li>' + (8 - result.lc) + ' ' + result.ltype + ' Approved</li>';

                    }

                    else if ((result.status === 1 || result.status === 2) && (result.mp === 1 || result.ep === 1 || result.tep === 1 || result.tmp === 1)) {
                        content += '<li style="color:yellow;">' + result.ltype + ' Permission Approved</li>';
                    }
                    else if ((result.status === 0 || result.status === 2) && result.hday === 0 && result.lc === 7.5) {
                        content += '<li>FN/AN Session Absent <br>' + result.ltype + ' applied</li>';
                    }

                    else if ((result.status === 0 || result.status === 2) && result.hday === 0 && result.lc === 8.5) {
                        content += '<li>FN/AN Session Absent <br>' + result.ltype + ' Forwarded to HR </li>';
                    }

                    else if (result.status === 1 && result.hday === 0 && result.lc === 0.5) {
                        content += '<li style="color:yellow;">' + result.ltype + ' Approved </li>';
                    }

                    else if ((result.status === 0 || result.status === 2) && result.hday === 0) {
                        content += '<li>FN/AN Session Absent</li>';
                    }


                }
                if (result.hday === 1) {
                    content += `<li>${result.ltype} - ${result.who}</li>`;
                }
                if (result.hday === 0 && !result.in_time && !result.out_time && result.lc === 0 && result.mp === 0 && date < new Date()) {
                    content += '<li>Absent</li>';
                }

                if (result.hday === 0 && !result.in_time && !result.out_time && result.lc >= 7 && result.mp === 0 && date < new Date()) {

                    if (result.lc === 7 && result.lc2 == 0) {
                        content += '<li>Absent & 1 ' + result.ltype + ' Applied</li>';
                    }
                    else if (result.lc === 7 && result.lc2 != 0) {
                        content += '<li>Absent & 1 ' + result.ltype + ' & ' + result.ltype2 + ' Applied</li>';
                    }

                    else if (result.lc === 8 && result.lc2 == 0) {
                        content += '<li>Absent & 1 ' + result.ltype + ' Forwarded to HR</li>';
                    }

                    else if (result.lc === 8 && result.lc2 != 0) {
                        content += '<li>Absent & 1 ' + result.ltype + ' & ' + result.ltype2 + ' Forwarded to HR</li>';
                    }

                    else if (result.lc === 8.5 && result.lc2 == 0) {
                        content += '<li>Absent & 0.5 ' + result.ltype + ' Forwarded to HR</li>';
                    }

                    else if (result.lc === 8.5 && result.lc2 != 0) {
                        content += '<li>Absent & 0.5 ' + result.ltype + ' & ' + result.ltype2 + ' Forwarded to HR</li>';
                    }

                    else if (result.lc === 7.5 && result.lc2 == 0) {
                        content += '<li>Absent & 0.5 ' + result.ltype + ' Applied</li>';
                    }
                    else if (result.lc === 7.5 && result.lc2 != 0) {
                        content += '<li>Absent & 0.5 ' + result.ltype + ' & ' + result.ltype2 + ' Applied</li>';
                    }

                }

                if (result.hday === 0 && !result.in_time && !result.out_time && (result.lc === 1 || result.lc === 0.5) && result.mp === 0 && date < new Date()) {
                    content += '<li style="color:yellow;">' + (result.lc) + ' ' + result.ltype + ' & ' + result.ltype2 + ' Approved</li>';
                }

                content += '</ul>';
                return content;
            }

            renderCalendar();

            $(document).on('click', '#prevMonth', function () {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });

            $(document).on('click', '#nextMonth', function () {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });

            $(window).on('resize', function () {
                renderCalendar();
            });
        });
    </script>
</body>

</html>