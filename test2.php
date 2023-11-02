<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 'on');    
    // require_once "config_session.php";
    // if(isset($_GET["login"])&&$_GET["login"]==="successful")
    // {
    //     echo $_SESSION["domain"].$_SESSION["user_id"].$_SESSION["name"];
    // }
    require_once "db_connection.php";
    require_once "config_session.php";
    require_once "login_control.php";
?>

<?php

    if (isset($_SESSION["user_id"]) && isset($_SESSION["domain"]) && isset($_SESSION["name"]))
    {
        echo $_SESSION["user_id"];
        echo "</br>";
        echo $_SESSION["domain"];
        echo "</br>";
        echo $_SESSION["name"];
        echo "</br>";

    }
    else{
        echo "NOT FOUND";
    }
?>