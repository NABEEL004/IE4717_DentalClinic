<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
include "db_connection.php";
?>
<?php
    if(isset($_POST["name"])&&isset($_POST["password"])&&isset($_POST["email"])&&isset($_POST["number"]))
    {
        $name = $_POST["name"];
        $name = trim($name);
        $pwd = password_hash($_POST["password"],PASSWORD_DEFAULT);
        $email = $_POST["email"];
        $email = strtolower(trim($email));
        $number = $_POST["number"];
        $query = "INSERT INTO doctors(username,password,email,phone_number) VALUES(?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssss',$name,$pwd,$email,$number);
        if(!$stmt->execute())
        {
            echo "<script>alert('Registration failed!');</script>";
        }
        else
        {
            echo "<script>alert('Registration is successful!');</script>";
        }
        $stmt->close();
        $db->close();
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tan & Sons Dental Clinic</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/createaccount.css">
    <link rel="stylesheet" href="./styles/mediaqueries.css">
    <script src="./js/doctor_creation.js"></script>
    <style>
        .validation_guide {
            padding-top: 5px;
            padding-left: 98px;
            /* font-weight: bold; */
            font-style: italic;
            color: #FF0000;
        }
        table {
            margin-left: 150px;
            /* padding-right: 150px; */
            width: 88%;
        }
        td:nth-child(2) {
            text-align: left; /* Align the content in the second column to the left */
            width: 100px;
        }
    </style>
</head>

<body>
    <nav id="desktop-nav">
        <div class="logo">Tan & Sons<br><span class="logo-bottomrow">Dental Clinic</span></div>
        <div class="menu-container">
            <ul>
                <li><a href="./admin.php">Doctor Account Overview</a></li>
                <li><a href="./doctor_creation.php">Doctor Account Creation</a></li>
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
                </ul>
            </div>
        </div>
    </nav>
    <div class="content-container">
        <div class="signin-container">
            <h2>Create New Account</h2>
            <br>
            <form action="doctor_creation.php" method="post" id="info">
                <!-- Replace "submit_page.php" with your actual form processing script -->
                <div>
                    <label for="domain"><sup>*</sup>Domain:</label>
                    <select id="domain" name="domain">
                        <option value="doctor">Doctor</option>
                    </select>
                </div>
                <br>
                <div>
                    <label for="name"><sup>*</sup>Name: </label>
                    <input type="text" id="name" name="name" required maxlength="50">
                    <p id="name_alert" class="validation_guide"></p>
                </div>
                <br>
                <div class="password-wrapper">
                    <label for="password"><sup>*</sup>Password: </label>
                    <input type="password" id="password" name="password" required maxlength="100" onkeyup="checkPasswordStrength(this.value)">
                    <!--google's convetion is to have a password between 8-100 but the actual pwd storedd
                    in the db WILL be hashed using bycrt or whatever which is about 60 chars?-->
                    <img src="./assets/hidden.png" id="hidden-1" alt="hidden">
                    <img src="./assets/visible.png" id="visible-1" alt="visible">
                </div>
                <table>
                    <tr>
                        <td><b>-</b> 8-100 characters</td>
                        <td text-align="left"><input type="checkbox" id="rule1" class="checkbox" disabled><label for="rule1" id="rule1-label"></label></td>
                    </tr>
                    <tr>
                        <td><b>-</b> A mix of upper-case and lower-case characters</td>
                        <td text-align="left"><input type="checkbox" id="rule2" class="checkbox" disabled><label for="rule2" id="rule2-label"></label></td>
                    </tr>
                    <tr>
                        <td><b>-</b> At least one number</td>
                        <td text-align="left"><input type="checkbox" id="rule3" class="checkbox" disabled><label for="rule3" id="rule3-label"></label></td>
                    </tr>
                    <tr>
                        <td><b>-</b> At least one special character e.g. -!&+?/</td>
                        <td text-align="left"><input type="checkbox" id="rule4" class="checkbox" disabled><label for="rule4" id="rule4-label"></label></td>
                    </tr>
                    <tr>
                        <td><b>-</b> Spaces are not allowed!</td>
                        <td text-align="left"><input type="checkbox" id="rule5" class="checkbox" disabled><label for="rule5" id="rule5-label"></label></td>
                    </tr>

                </table>    
                <br>
                <div class="password-wrapper">
                    <label for="re-password"><sup>*</sup>Re-type Password: </label>
                    <input type="password" id="re-password" name="re-password" onkeyup="checkRePassword(this.value)" required>
                    <img src="./assets/hidden.png" id="hidden-2" alt="hidden">
                    <img src="./assets/visible.png" id="visible-2" alt="visible">
                </div>
                <table>
                    <tr>
                        <td>-consistent passwords</td>
                        <td text-align="left"><input type="checkbox" id="consistent" class="checkbox" disabled><label for="consistent"></label></td>
                    </tr>
                </table>
                <br>

                <div>
                    <label for="email"><sup>*</sup>Email: </label>
                    <input type="email" id="email" name="email" required maxlength="127">
                    <p id="email_alert" class="validation_guide"></p>
                </div>
                <br>
                <div>
                    <label for="number"><sup>*</sup>Mobile Phone Number: </label>
                    <input type="tel" id="number" name="number" required maxlength="8">
                    <p id="phone_alert" class="validation_guide"></p>
                </div>
                <br>
                <input type="submit" value="Create Account" class="submit">
            </form>
        </div>
    </div>
    <footer margin-top="100px">Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    <script src="./js/script.js"></script>
</body>

</html>