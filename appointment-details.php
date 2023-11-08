<?php
require_once "config_session.php";
require_once "login_control.php";
require_once "booking_control.php";
require_once "doc_view_control.php";
require_once "db_connection.php";

if (isset($_SESSION["user_id"]) && isset($_SESSION["domain"]) && isset($_SESSION["name"])) {
    $user_id = $_SESSION["user_id"];
    $domain = $_SESSION["domain"];
    $user_name = $_SESSION["name"];
    $app = '';

    if (isset($_SESSION["app"])) {
        $app = $_SESSION["app"];
    }

    if ($domain === 'patient') {
        if (!have_appointment($db, $user_id)) {
            header("Location: appointment.php");
        }
        $query = 'SELECT doctor_name,app_date,app_time,note from appointments where patientID=?';
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows != 1) {
            echo "<script>alert('APPOINTMENT ERROR!');</script>";
            header("Location: signin.php");
        } else {
            $row = $result->fetch_assoc();
            $doc = $row["doctor_name"];

            $app_date = $row["app_date"];
            $time_stamp = strtotime($app_date);
            $formatted_date = date("jS F Y", $time_stamp);


            $app_time = $row["app_time"];
            $start_time = strtotime($app_time);
            $end_time = $start_time + 45 * 60;

            $formatted_start_time = date("h:i a", $start_time);
            $formatted_end_time = date("h:i a", $end_time);


            $note = $row["note"];
            $note = ($note === null) ? 'Nil' : $note;
        }
    } 
    // else {
    //     header("Location: appointments-overview.php");
    // }

    // handling redirection from doctor's appointment overview page
    else if (isset($_GET["patient_email"])) {
        $patient_id = get_patient_id($db,$_GET["patient_email"]);
        // header("Location: appointments-overview.php");
        $query = 'SELECT doctor_name,app_date,app_time,note from appointments where patientID=?';
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows != 1) {
            echo "<script>alert('APPOINTMENT ERROR!');</script>";
            header("Location: signin.php");
        } else {
            $row = $result->fetch_assoc();
            $doc = $row["doctor_name"];

            $app_date = $row["app_date"];
            $time_stamp = strtotime($app_date);
            $formatted_date = date("jS F Y", $time_stamp);


            $app_time = $row["app_time"];
            $start_time = strtotime($app_time);
            $end_time = $start_time + 45 * 60;

            $formatted_start_time = date("h:i a", $start_time);
            $formatted_end_time = date("h:i a", $end_time);


            $note = $row["note"];
            $note = ($note === null) ? 'Nil' : $note;
        }

    }
    else
    {
        header("Location: signin.php");
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
    <link rel="stylesheet" href="./styles/mediaqueries.css">
    <link rel="stylesheet" href="./styles/appointment-details.css">
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
            <p style="font-size: 20px;">
                <i>
                    <?php
                    if($domain==='patient')
                    {
                        if ($app) {
                            echo "Thank you for choosing Tan&Sons Dental Clinic, <b>" . $_SESSION["name"] . "</b>.";
                        } else {
                            echo "Welcome back, <b>" . $_SESSION["name"] . "</b>. How can we help you today?";
                        }

                    }
                    else
                    {
                        echo "Welcome back,  <b>Dr " . $_SESSION["name"] . "</b>. How can we help you today?";
                    }
                    ?>
                </i>
            </p>
            <?php
            if ($app) {
                echo "<p style='font-size: 20px;'><i>Your appointment is ready!</i></p>";
            } else {
                echo "";
            }
            ?>
            <table>
                <tr>
                    <th>Dentist:</th>
                    <td>
                        <?php
                        echo "Dr " . $doc;
                        ?>
                    </td>
                </tr>
                <?php
                    if(isset($_GET["patient_email"]))
                    {
                        echo "<tr><th>Patient:</th><td>".get_patient_name($db,$patient_id)."</td></tr>";
                    }
                ?>
                <tr>
                    <th>Date:</th>
                    <td>
                        <?php
                        echo $formatted_date;
                        ?>

                    </td>
                </tr>
                <tr>
                    <th>Time:</th>
                    <td>
                        <?php
                        echo $formatted_start_time . " - " . $formatted_end_time;
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>Note:</th>
                    <td>
                        <?php
                        echo $note;
                        ?>
                    </td>
                </tr>
            </table>
            <div class="button-wrapper">
            <?php
                if (isset($_GET["patient_email"])){
                    echo "<a href='./reschedule.php?patient_id=$patient_id'><button class='submit'>Reschedule</button></a>";
                }
                else {
                    echo "<a href='./reschedule.php'><button class='submit'>Reschedule</button></a>";
                }

            ?>
            <form action="logout.php" method="post">
                <button>Logout</button>
            </form>
            </div>
            <!-- <a href="./reschedule.php">
                <button class="submit">Reschedule</button>
            </a> -->
        </div>
    </div>
    <footer>Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    <script src="./js/script.js"></script>
</body>

</html>