<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once "db_connection.php";
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Check if the 'id' parameter is set in the URL
    if (isset($_GET['id'])) {
        $doctorId = $_GET['id'];

        // Your database connection code here
        // Replace with your actual database connection code

        // Perform the deletion
        $query = "DELETE FROM doctors WHERE doctor_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i',$doctorId);
        if ($stmt->execute()) {
                echo "success";
        } else {
            // Error during deletion
            echo 'error';
        }
    } else {
        // 'id' parameter is missing
        echo 'missing id';
    }
} else {
    // Invalid request method
    header("Location: admin.php");
}

function get_doc_name($db,$id)
{
    $query = 'SELECT username FROM doctors where doctor_id = ?';
    $stmt=$db->prepare($query);
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows==1)
    {
        return $result->fetch_assoc()["username"];
    }
    else
    {
        return '?????';
    }
}
?>
