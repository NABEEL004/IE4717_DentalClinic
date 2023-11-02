<?php
require_once "config_session.php";
require_once "login_control.php";
require_once "db_connection.php";

if (isset($_SESSION["user_id"]) && isset($_SESSION["domain"]) && isset($_SESSION["name"])) {
    $user_id = $_SESSION["user_id"];
    $domain = $_SESSION["domain"];
    $user_name = $_SESSION["name"];

    if ($domain === 'patient') {
        if (!have_appointment($db, $user_id)) {
            header("Location: appointment.php");
        }
    }
    else
    {
        header("Location: appointments-overview");
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
    <link rel="stylesheet" href="./styles/appointment-details.css">
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
        <div class="details-container">
            <h2>Appointment Details</h2>
            <p>for Alex</p>
            <table>
                <tr>
                    <th>Dentist:</th>
                    <td>Dr Shawn</td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td>10th October 2023</td>
                </tr>
                <tr>
                    <th>Time:</th>
                    <td>10.00 - 10.45 am</td>
                </tr>
                <tr>
                    <th>Note to Clinic:</th>
                    <td>NIL</td>
                </tr>
            </table>
            <a href="./reschedule.php">
                <button class="submit">Reschedule</button>
            </a>
            <form action="logout.php"  method="post">
                <button>Logout</button>
            </form>
        </div>
    </div>
    <footer>Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    <script src="script.js"></script>
</body>

</html>