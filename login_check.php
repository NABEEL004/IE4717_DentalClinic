<?php
    function check_login_errors()
    {
        if(isset($_SESSION["error_login"])){
            $errors = $_SESSION["error_login"];

            echo "<br>";
            foreach($errors as $error)
            {
                echo "<p class='login_alert'>".$error."</p>";
            }
            unset($_SESSION["error_login"]);
         } else if(isset($_GET["login"])&&$_GET["login"]==="successful")
        {
            date_default_timezone_set('Asia/Singapore');
            // Get the current time in Singapore Time
            $current_time = date('Y-m-d H:i:s');
            echo '<script>alert("Login Successful! ' . $current_time . '");</script>';        
        }
    }

?>