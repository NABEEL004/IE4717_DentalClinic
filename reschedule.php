<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tan & Sons Dental Clinic</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/reschedule.css">
    <link rel="stylesheet" href="./styles/mediaqueries.css">
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
            <h2>Rescheduling Appointment</h2>
            <p>Rescheduling appointment for Alex</p>
            <form action="" method=""> <!-- Replace "submit_page.php" with your actual form processing script -->
                <div>
                    <label for="dentist"><sup>*</sup>Dentist:</label>
                    <select id="dentist" name="dentist" required>
                        <option>Dr Lee</option>
                        <option>Dr Shawn</option>
                        <option>Dr Shanice</option>
                        <!-- <option value="doctor">Doctor</option> -->
                    </select>
                    <br><br>
                </div>
                <div>
                    <label for="date"><sup>*</sup>Date: </label>
                    <input type="date" id="date" name="date" required>
                    <!-- <input type="text" id="name" name="name" required> -->
                    <br><br>
                </div>
                <div>
                    <label for="time"><sup>*</sup>Time: </label>
                    <select id="time" name="time" required>
                        <option> 9.00 am </option>
                        <option> 10.00 am </option>
                        <option> 11.00 am </option>
                        <option> 12.00 pm </option>
                        <option> 2.00 pm </option>
                        <option> 3.00 pm </option>
                        <option> 4.00 pm </option>
                    </select>
                    <br><br>
                </div>
                <div>
                    <label for="note">Note to Clinic: </label>
                    <input type="text" id="note" name="note">
                    <br><br>
                </div>
                <input type="submit" value="Reschedule" class="submit">
            </form>
        </div>
    </div>
    <footer>Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    <script src="script.js"></script>
</body>

</html>