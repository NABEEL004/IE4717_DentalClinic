<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
require_once 'db_connection.php';
require_once "config_session.php";
require_once "booking_control.php";

?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION["user_id"]) && isset($_SESSION["domain"]) && isset($_SESSION["name"])) {
        $dentist = $_POST["dentist"];
        $dentist = preg_replace('/^Dr\s+/', '', trim($dentist));

        $date =  $_POST["date"];
        $time_slot =  $_POST["time"];

        $note = $_POST["note"];
        $note = trim($note);

        insert_app($db, $date, $time_slot, $dentist, $_SESSION["user_id"], $note);
        header("Location: appointment-details.php");
    } else {
        header("Location: signin.php");
    }
} else {
    header("Location: signin.php");
    die();
}
?>