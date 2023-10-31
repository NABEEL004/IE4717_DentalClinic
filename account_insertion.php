<?php
// db connection
error_reporting(E_ALL);
ini_set('display_errors', 'on');
?>

<?php
include "db_connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data sent in the request
    $data = json_decode(file_get_contents("php://input"));

    $name = $data->name;
    $pwd = password_hash($data->password,PASSWORD_DEFAULT);
    $email = $data->email;
    $phoneNumber = $data->phone;

    $query = "INSERT INTO patients(username,password,email,phone_number) VALUES(?,?,?,?)";

    $stmt = $db->prepare($query);
    $stmt->bind_param('ssss',$name,$pwd,$email,$phoneNumber);
    if($stmt->execute())
    {
        echo 0;
    }
    else
    {
        echo 1;
    }
    $stmt->close();
    $db->close();
}

?>

