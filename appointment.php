<?php
require_once "config_session.php";
require_once "login_control.php";
require_once "db_connection.php";
if (isset($_SESSION["user_id"]) && isset($_SESSION["domain"]) && isset($_SESSION["name"])) {
    $user_id = $_SESSION["user_id"];
    $domain = $_SESSION["domain"];
    $user_name = $_SESSION["name"];

    if ($domain == 'patient') {
        if (have_appointment($db, $user_id)) {
            header("Location: appointment-details.php");
        }
    }
} else {
    header("Location: signin.php");
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tan & Sons Dental Clinic</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/appointment.css">
    <link rel="stylesheet" href="./styles/mediaqueries.css">
    <script src="./js/set_date.js"></script>
</head>

<body>
    <nav id="desktop-nav">
        <div class="logo">Tan & Sons<br><span class="logo-bottomrow">Dental Clinic</span></div>
        <div class="menu-container">
            <ul>
                <li><a href="./">Home</a></li>
                <li><a href="./dentists.html">Our Dentists</a></li>
                <li><a href="./services.html">Services & Fees</a></li>
                <li><a href="./contact.html">Contact Us</a></li>
                <li>
                    <a href="./signin.php" id="appointment_link">
                        <div id="appointment">Make an<br>Appointment</div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <nav id="hamburger-nav">
        <div class="logo">Tan & Sons<br><span class="logo-bottomrow">Dental Clinic</span></div>
        <div class="hamburger-menu">
            <div class="hamburger-icon" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="menu-links">
                <ul>
                    <li><a href="./" onclick="toggleMenu()">Home</a></li>
                    <li><a href="./dentists.html" onclick="toggleMenu()">Our Dentists</a></li>
                    <li><a href="./services.html" onclick="toggleMenu()">Services & Fees</a></li>
                    <li><a href="./contact.html" onclick="toggleMenu()">Contact Us</a></li>
                    <li><a href="./appointment.php" onclick="toggleMenu()">Book Appointment</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content-container">
        <div class="signin-container">
            <h2>Make an Appointment</h2>
            <br>
            <p><i>Welcome to Tan&Sons Dental Clinic, <?php echo $_SESSION["name"]; ?>. How can we help you today?</i></p>
            <br>
            <form action="booking.php" method="post" onsubmit="app_validation(event)"> <!-- Replace "submit_page.php" with your actual form processing script -->
                <div>
                    <label for="dentist"><sup>*</sup>Dentist:</label>
                    <select id="dentist" name="dentist" required onchange="get_timeslots()">
                        <?php
                        $retrieve_doc = "SELECT username from doctors";
                        $result = $db->query($retrieve_doc);
                        if ($result) {
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option>Dr " . $row['username'] . "</option>";
                                }
                                $result->free();
                            }
                        } else {
                            echo "Error: " . $mysqli->error;
                        }
                        ?>
                    </select>
                </div>
                <br>
                <div>
                    <label for="date"><sup>*</sup>Date: </label>
                    <input type="date" id="date" name="date" required onchange="get_timeslots()">
                </div>
                <br>
                <div>
                    <label for="time"><sup>*</sup>Time: </label>
                    <select id="time" name="time">
                    </select>
                </div>
                <p id="no_slots"></p>
                <br>
                <div>
                    <label for="note">Note to Clinic: </label>
                    <textarea maxlength="250" rows='5' cols='50' id="note" name="note" placeholder="Max 255 characters"></textarea>
                </div>
                <br>
                <input type="submit" value="Book Appointment" class="submit">
                <br>
            </form>
            <form action="logout.php" method="post">
                <button>Logout</button>
            </form>

        </div>
    </div>
    <footer>Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<script>alert(' . $_SESSION['message'] . ');</script>';
        unset($_SESSION['message']);
    }
    ?>
    <script src="./js/script.js"></script>
    <script>
        function get_timeslots() {
            document.getElementById("no_slots").innerHTML = '';
            var app_date = document.getElementById("date");
            var dentist = document.getElementById("dentist");
            var app_time = document.getElementById("time");
            var temp_dentist_name = dentist.value;
            temp_dentist_name = temp_dentist_name.replace(/^Dr\s+/, '');

            if (dentist.value !== '' && app_date.value !== '') {
                // Make an AJAX request to get available time slots
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'get_timeslots.php?doctor=' + temp_dentist_name + '&date=' + app_date.value, true);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        var timeSlots = response.timeSlots;

                        app_time.innerHTML = '';

                        const timeZone = "Asia/Singapore";
                        const today = new Date().toLocaleString("en-US", {
                            timeZone
                        });
                        const now = new Date(today);
                        const hr_duration_millisec = 1 * 60 * 60 * 1000;

                        // Set the time on the current date
                        // today.setHours(parseInt(hour), parseInt(minute), 0);

                        var hour;
                        var minute;
                        for (var i = 0; i < timeSlots.length; i++) {

                            var timeString = timeSlots[i];
                            [hour, minute] = timeString.match(/\d+/g);
                            var isPm = timeString.includes('pm');
                            if (isPm && hour !== '12') {
                                hour = parseInt(hour) + 12;
                            }
                            var time_slot_date = new Date(app_date.value);
                            var time_slot = time_slot_date.setHours(parseInt(hour), parseInt(minute), 0);

                            if (time_slot - now > hr_duration_millisec) {
                                var option = document.createElement('option');
                                option.value = timeSlots[i];
                                option.text = timeSlots[i];
                                app_time.appendChild(option);

                            }
                        }



                        if (app_time.innerHTML == '') {
                            document.getElementById("no_slots").innerHTML = "<i>Sorry, all time slots of " + dentist.value + " on " + app_date.value + " are not available.</i>";
                        }
                    }
                };

                xhr.send();

            }

        }

        function app_validation(event) {
            var dentist = document.getElementById("dentist");
            var app_date = document.getElementById("date");
            var app_time = document.getElementById("time");
            // Set the time zone to Singapore
            const timeZone = "Asia/Singapore";

            if (app_date.value === '') {
                alert("Please fill in the date!");
                event.preventDefault();
            } else {
                const selectedDate = new Date(app_date.value);
                const today = new Date().toLocaleString("en-US", {
                    timeZone
                });
                const todayDate = new Date(today);
                selectedDate.setHours(0, 0, 0, 0);
                todayDate.setHours(0, 0, 0, 0);

                // Check if the selected date is before today
                if (selectedDate < todayDate) {
                    // Selected date is before today, show an alert
                    alert("Sorry, selected date must be today or later!");
                    // alert(selectedDate);
                    // alert(new Date(today));
                    // Prevent the default form submission
                    event.preventDefault();
                }
            }

            if (app_time.innerHTML == '') {
                alert("Please select an available timeslot.");
                event.preventDefault();
            }

        }
    </script>
</body>

</html>