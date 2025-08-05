<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
    <script src="fullcalendar/lib/jquery.min.js"></script>
    <script src="fullcalendar/lib/moment.min.js"></script>
    <script src="fullcalendar/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function () {
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: "fetch-event.php",
                displayEventTime: false,
                eventRender: function (event, element, view) {
                    event.allDay = event.allDay === 'true';
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');

                    if (title) {
                        var startFormatted = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var endFormatted = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                        $.ajax({
                            url: 'add-event.php',
                            type: "POST",
                            data: {
                                title: title,
                                start: startFormatted,
                                end: endFormatted
                            },
                            success: function (data) {
                                displayMessage("Added Successfully");
                                calendar.fullCalendar('renderEvent', {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                }, true);
                            },
                            error: function () {
                                displayMessage("Failed to add event. Please try again.");
                            }
                        });
                    }
                    calendar.fullCalendar('unselect');
                },
                eventDrop: function (event, delta) {
                    var startFormatted = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var endFormatted = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                    $.ajax({
                        url: 'edit-event.php',
                        type: "POST",
                        data: {
                            title: event.title,
                            start: startFormatted,
                            end: endFormatted,
                            id: event.id
                        },
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        },
                        error: function () {
                            displayMessage("Failed to update event. Please try again.");
                        }
                    });
                },
                eventClick: function (event) {
                    var deleteMsg = confirm("Do you really want to delete this event?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: "delete-event.php",
                            data: { id: event.id },
                            success: function (response) {
                                if (parseInt(response) > 0) {
                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                    displayMessage("Deleted Successfully");
                                }
                            },
                            error: function () {
                                displayMessage("Failed to delete event. Please try again.");
                            }
                        });
                    }
                }
            });
        });

        function displayMessage(message) {
            $(".response").html("<div class='success'>" + message + "</div>");
            setTimeout(function () { $(".success").fadeOut(); }, 3000); // Increased fade-out time
        }
    </script>

    <style>
        body {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
        }

        #calendar {
            width: 700px;
            margin: 0 auto;
        }

        .response {
            height: 60px;
        }

        .success {
            background: #cdf3cd;
            padding: 10px 60px;
            border: #c3e6c3 1px solid;
            display: inline-block;
        }
    </style>
</head>

<body>
    <h2><b><U>GYM SCHEDULE<br><a class="btn btn-link" href="dashboard.php">Go back</a></U></b></h2>
    <div class="response container"></div>
    <div id='calendar'></div>
</body>

</html>