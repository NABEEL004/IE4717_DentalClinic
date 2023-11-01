<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');        
?>
<?php
    require_once "login_check.php";
    require_once "config_session.php";
    require_once "login_control.php";

    // if(isset($_GET["login"])&&$_GET["login"]==="successful")
    // {
    //     date_default_timezone_set('Asia/Singapore');
    //     // Get the current time in Singapore Time
    //     $current_time = date('Y-m-d H:i:s');
    //     echo '<script>alert("Login Successful! ' . $current_time . '");</script>';        
    // }

    // why this block is never executed?

    if(isset($_SESSION["user_id"])&&isset($_SESSION["domain"])&&isset($_SESSION["name"]))
    {
        $user_id = $_SESSION["user_id"];
        $domain = $_SESSION["domain"];
        $user_name = $_SESSION["name"];

        // if(isset($_GET["login"])&&$_GET["login"]==="successful")
        // {
        //     date_default_timezone_set('Asia/Singapore');
        //     // Get the current time in Singapore Time
        //     $current_time = date('Y-m-d H:i:s');
        //     echo '<script>alert("Login Successful! ' . $current_time . '");</script>';        
        // }

        if($domain=='patient')
        {
            header("Location: appointment.php");
        }
        // else
        // {
    
        // }
    
    }

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tan & Sons Dental Clinic</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/signin.css">
    <link rel="stylesheet" href="./styles/mediaqueries.css">
    <script src="password.js"></script>
    <style>
        .login_alert{
            font-style: italic;
            color: #FF0000;
        }
    </style>
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
                    <li><a href="./appointment.html" onclick="toggleMenu()">Book Appointment</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content-container">
        <div class="signin-container">
            <h2>Sign In</h2>
            <form action="login.php" method="post"> <!-- Replace "submit_page.php" with your actual form processing script -->
                <div>
                    <label for="domain"><sup>*</sup>Domain:</label>
                    <select id="domain" name="domain">
                        <option value="patient">Patient</option>
                        <option value="doctor">Doctor</option>
                    </select>
                </div>
                <br>
                <div>
                    <label for="email"><sup>*</sup>Email: </label>
                    <input type="email" id="email" name="email" required>
                </div>
                <br>
                <div id="password-wrapper">
                    <label for="password"><sup>*</sup>Password:</label>
                    <input type="password" id="password" name="password" required>
                    <img src="./assets/hidden.png" id="hidden" alt="hidden">
                    <img src="./assets/visible.png" id="visible" alt="visible">
                </div>
                <br>
                <input type="submit" value="Sign In" class="submit">
            </form>
            <?php
                check_login_errors();

            ?>
            <br>
            <div class="createaccount">
                <p>Don't have an account?</p>
                <a href="./createaccount.php">Create a new account here</a>
            </div>
        </div>
    </div>
    <footer>Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    <script src="./script.js"></script>
</body>

</html>