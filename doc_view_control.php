<?php
function get_patient_id($db, $email)
{
    $query = "SELECT patient_id FROM patients where email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        return $result->fetch_assoc()["patient_id"];
    } else {
        header("Location: appointment.php");
        die();
    }
}
?>