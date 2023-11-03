<?php
// db connection
error_reporting(E_ALL);
ini_set('display_errors', 'on');
include "db_connection.php";
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data sent in the request
    $data = json_decode(file_get_contents("php://input"));

    // Extract email and phone number from the JSON data
    $email = $data->email;
    $phoneNumber = $data->phone;

    $sql = "SELECT * FROM patients WHERE LOWER(email) = ? OR phone_number = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ss',$email,$phoneNumber);
    $stmt->execute();

    $result = $stmt->get_result();  
    $num_results = $result->num_rows;

    $stmt->close();
    $db->close();

    // Output the numebr of repeated emails or phone numbers
    echo $num_results;
}
else
{
    header("Location: signin.php");
}

?>

