<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<?php
require_once "db_connection.php";

$doctor = $_GET['doctor'];
$date = $_GET['date'];

// Query to retrieve all booked appointments for the selected doctor and date
$query = "SELECT LOWER(DATE_FORMAT(app_time, '%l:%i %p')) AS formatted_time FROM appointments WHERE doctor_name = ? AND DATE(app_date) = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('ss', $doctor, $date);
$stmt->execute();
$result = $stmt->get_result();

$allTimeSlots = array('9:00 am', '10:00 am', '11:00 am', '12:00 pm', '2:00 pm', '3:00 pm', '4:00 pm');

$bookedTimeSlots = array();

// Iterate through the booked appointments and add the formatted time to the booked time slots array
$availableTimeSlots = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookedTimeSlots[] = $row['formatted_time'];
    }
}
// Use array_diff to find the available time slots (complementary set)
$availableTimeSlots = array_diff($allTimeSlots, $bookedTimeSlots);


// Format the result as JSON
if(date('w', strtotime($date)) == 0)
{
    $response = array(
        'timeSlots' => array() // Convert the associative array to a plain array
        // 'timeSlots' => $allTimeSlots
    );
}   
else
{
    $response = array(
        'timeSlots' => array_values($availableTimeSlots) // Convert the associative array to a plain array
        // 'timeSlots' => $allTimeSlots
    );

}

header('Content-Type: application/json');
echo json_encode($response);
?>
