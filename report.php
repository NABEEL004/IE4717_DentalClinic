<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once "db_connection.php";

?>

<?php
date_default_timezone_set('Asia/Singapore');
if (isset($_GET["date_range"])&&isset($_GET["choice"]))
{
    $date_range = $_GET["date_range"];
    $choice = $_GET["choice"];
}


$query = "SELECT username FROM doctors";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

function app_doc_timeslot_count($db,$doc,$slot,$currentday,$daysago)
{
    $query = "SELECT doctor_name,COUNT(*) as appointment_count
    FROM appointments
    WHERE doctor_name = '$doc' 
    AND app_date BETWEEN '$daysago' AND '$currentday'
    AND TIME_FORMAT(app_time,'%H:%i') = '$slot'
    GROUP BY doctor_name";

    $result = $db->query($query);

    if ($result === false) {
        die('Error executing the query: ' . $db->error);
    }

    // while ($row = $result->fetch_assoc()) {
    //     $appointmentCount = $row['appointment_count'];
    //     // Do something with the result
    // }

    return $result->num_rows==0?$result->num_rows:$result->fetch_assoc()["appointment_count"];
}

function app_doc_count($db,$doc,$currentday,$daysago)
{
    $query = "SELECT doctor_name,COUNT(*) as appointment_count
    FROM appointments
    WHERE doctor_name = '$doc' 
    AND app_date BETWEEN '$daysago' AND '$currentday'
    GROUP BY doctor_name";

    $result = $db->query($query);

    if ($result === false) {
        die('Error executing the query: ' . $db->error);
    }
    return $result->num_rows==0?$result->num_rows:$result->fetch_assoc()["appointment_count"];

}
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
        </div>
    </nav>
    <div class="content-container">
        <div class="details-container">
                <h2>Appointment Report</h2>
                <table>
                    <?php
                        $timeslots = ["09:00","10:00", "11:00", "12:00", "14:00", "15:00","16:00"];
                        $currentDate = date("Y-m-d");

                        // Calculate the date X days ago $date_range
                        $XDaysAgo = date("Y-m-d", strtotime("-".$date_range." days", strtotime($currentDate)));
                    
                        if($choice=="t")
                        {
                            echo "<tr><th>Dentists</th><th>9:00</th><th>10:00</th><th>11:00</th><th>12:00</th><th>14:00</th><th>15:00</th><th>16:00</th><tr>";
                            foreach ($result as $row) {
                                echo "<tr><td>{$row['username']}</td>";
                                foreach ($timeslots as $timeslot) {
                                    echo "<td>".app_doc_timeslot_count($db,$row["username"],$timeslot,$currentDate,$XDaysAgo)."</td>";
                                }
                                echo "</tr>";
                            }
                        }
                        else
                        {
                            echo "<tr><th>Dentists</th><th>Count</th>";
                            foreach ($result as $row) {
                                echo "<tr><td>{$row['username']}</td>";
                                echo "<td>".app_doc_count($db,$row["username"],$currentDate,$XDaysAgo)."</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </table>




            <div>
            <form method="post" action="direct.php">
                <button>Go back</button>
            </form>
            </div>
        </div>

    </div>



    <footer>Copyright Tan & Sons Dental Clinic Pte Ltd 2023</footer>
    <script src="./js/script.js"></script>
</body>