<?php
require_once "db_connection.php";
require_once "config_session.php";

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["domain"]) || !isset($_SESSION["name"])) {
    header("Location: signin.php");
    exit(); // Redirect and exit if session data is not set
}


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["date"])) {
        $selectedDate = $_GET["date"];
        $_SESSION["selected_date"] = $selectedDate;
        $doc = $_SESSION["name"];

        // Query the database to retrieve appointment data for the selected date and doctor
        $query = "SELECT app_time, patient_name,patientID FROM appointments WHERE app_date = ? AND doctor_name = ? ORDER BY app_time";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ss', $selectedDate, $doc);
        $stmt->execute();
        $result = $stmt->get_result();

        $appointments = array();

        // Fetch the data into an array
        while ($row = $result->fetch_assoc()) {

            $appointment = $row;
            $patientID = $row["patientID"];
            $contactEmailData = getContactAndEmail($db, $patientID);
            if ($contactEmailData !== null) {
                $appointment["phone_number"] = $contactEmailData["phone_number"];
                $appointment["email"] = $contactEmailData["email"];
            }

            $appointments[]=$appointment;
        }

        // Return the data as JSON
        $response = array("appointments" => $appointments);
        header('Content-Type: application/json');
        echo json_encode($response);

    } else {
        echo "Date parameter is missing";
    }
}


function getContactAndEmail($db, $patientID) {

    $query = "SELECT phone_number, email FROM patients WHERE patient_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $patientID);
    $stmt->execute();
    $contactEmailResult = $stmt->get_result();

    if ($contactEmailRow = $contactEmailResult->fetch_assoc()) {
        return $contactEmailRow;
    }

    return null; // Return null if no data found
}
