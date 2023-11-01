<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');    
    require_once "config_session.php";
    if(isset($_GET["login"])&&$_GET["login"]==="successful")
    {
        echo $_SESSION["domain"].$_SESSION["user_id"].$_SESSION["name"];
    }
?>
