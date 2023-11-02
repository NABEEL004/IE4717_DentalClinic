<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<?php

function insert_app($db, $date, $time, $doc, $patientID, $note)
{
    $patient_name = get_patient_name($db, $patientID);
    $query = '';

    $dateTime = new DateTime($time);
    $timeFormatted = $dateTime->format('H:i:s');

    if ($note == '') {
        $query =
            "INSERT INTO appointments(app_date,app_time,doctor_name,patientID,patient_name)
            VALUES (?, ?, ?, ?, ?)
            ";
    } else {
        $query =
            "INSERT INTO appointments(app_date,app_time,doctor_name,patientID,patient_name,note)
            VALUES (?, ?, ?, ?, ?,?)
            ";
    }

    $stmt = $db->prepare($query);

    if ($note == '') {
        $stmt->bind_param('sssis', $date, $timeFormatted, $doc, $patientID, $patient_name);
    } else {
        $stmt->bind_param('sssiss', $date, $timeFormatted, $doc, $patientID, $patient_name, $note);
    }
    $stmt->execute();

    // if ($stmt->execute()) {
    //     header("Location: appointment-details.php");
    // } else {
    //     echo "<script>alert('FAILED!');</script>";
    //     header("Location: appointment.php");
    // }
}


function get_patient_name($db, $patientID)
{
    $query = "SELECT username FROM patients where patient_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        return $result->fetch_assoc()["username"];
    } else {
        header("Location: appointment.php");
        die();
    }
}


?>