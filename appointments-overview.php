<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tan & Sons Dental Clinic</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/appointments-overview.css">
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
                    <li><a href="./signin.php" onclick="toggleMenu()">Book Appointment</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content-container">
       <div class="details-container">
            <h2>Appointments</h2>
            <p>Appointments for Dr Lee</p>
            <form action="">
                <label for="date">Date: </label>
                <input type="date" name="date" id="date">
            </form>
            <table>
                <tr>
                    <th>Time:</th>   
                    <th>Patient:</th>   
                    <th>Contact No.:</th>   
                    <th>Email:</th>   
                    <th></th>   
                </tr>
                <tr>
                    <td>9.00 - 9.45 am</td>
                    <td>Alex</td>
                    <td>9786 5432</td>
                    <td>alex1234@google.com</td>
                    <td><a href="appointment-details.html"><button>View</button></a></td>
                </tr>
                <tr>
                    <td>10.00 - 10.45 am</td>
                    <td>John</td>
                    <td>9286 5132</td>
                    <td>john1124@yahoo.com</td>
                    <td><a href="appointment-details.html"><button>View</button></a></td>
                </tr>
            </table>

       </div>
    </div>
    <footer>Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    <script src="script.js"></script>
</body>
</html>