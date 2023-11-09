<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once "db_connection.php";

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tan & Sons Dental Clinic</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/mediaqueries.css">
    <link rel="stylesheet" href="./styles/signin.css">
    <link rel="stylesheet" href="./styles/appointments-overview.css">
</head>

<body>
    <nav id="desktop-nav">
        <div class="logo">Tan & Sons<br><span class="logo-bottomrow">Dental Clinic</span></div>
        <div class="menu-container">
            <ul>
                <li><a href="./admin.php">Doctor Account Overview</a></li>
                <li><a href="./doctor_creation.php">Doctor Account Creation</a></li>
                <li><a href="./app_report.php">Appointment Report</a></li>
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
                    <li><a href="./admin.php" onclick="toggleMenu()">Doctor Account Overview</a></li>
                    <li><a href="./doctor_creation.php" onclick="toggleMenu()">Doctor Account Creation</a></li>
                    <li><a href="./app_report.php" onclick="toggleMenu()">Appointment Report</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content-container">
        <div class="details-container">
            <h2>Appointment Report</h2>
            <form action="report.php" method="get" id="report_form">
                <div>
                    <label for="date_range"><sup>*</sup>Date Range: </label>
                    <select id="date_range" name="date_range">
                        <option value="7">Last 7 days</option>
                        <option value="14">Last 14 days</option>
                        <option value="30">Last 30 days</option>
                    </select>
                </div>
                <br>
                <div>
                    <label for="choice"><sup>*</sup>Category: </label>
                    <select id="choice" name="choice">
                        <option value="d">By dentists</option>
                        <option value="t">By timeslots</option>
                    </select>
                </div>
                <br>
                <div>
                    <input type="submit" value="Generate" class="submit">
                </div>

            </form>
        </div>
        <footer>Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    </div>



    <script src="./js/script.js"></script>
</body>