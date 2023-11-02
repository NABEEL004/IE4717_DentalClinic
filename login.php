<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');    
?>

<?php
    if($_SERVER["REQUEST_METHOD"]==="POST")
    {
        $domain = $_POST["domain"];
        $email =  $_POST["email"];
        $pwd =  $_POST["password"];
        $fetched_data = null;
        require_once 'db_connection.php';
        require_once 'login_control.php';



        //error handlers
        $errors = [];

        if(is_input_empty($email,$pwd))
        {
            $errors["empty_input"] = "Fill in all fields!";
        }
        else
        {
            $result = get_result($db,$email,$domain);
            $fetched_data = $result->fetch_assoc();
            if(is_email_wrong($result))
            {   // duplicate records with same emails which is actually not allowed, frontend has forbidden this behaviour
                $errors["login_incorrect"] = "Incorrect login info!";
            }
    
            if(!is_email_wrong($result) && is_pwd_wrong($pwd,$fetched_data["password"]))
            {
                $errors["login_incorrect"] = "Incorrect login info!";
            }
        }

        // Start the session
        require_once "config_session.php";

        if($errors)
        {
            $_SESSION["error_login"] = $errors;
            header("Location: signin.php");
            die();
        }

        $new_sessionID = session_create_id();
        if($domain=='patient')
        {
            $sessionID = $new_sessionID."_".$fetched_data["patient_id"];
        }
        else
        {
            $sessionID = $new_sessionID."_".$fetched_data["doctor_id"];
        }
        session_id($sessionID);

        $_SESSION["last_regeneration"] = time(); 

        $_SESSION["domain"]=$domain;
        $_SESSION["user_id"] = $domain=='patient'?$fetched_data["patient_id"]:$fetched_data["doctor_id"];
        $_SESSION["name"] = $fetched_data["username"];

        // if($_SESSION["domain"]==='patient')
        // {
        //     if(have_appointment($db,$_SESSION["user_id"]))
        //     {   
        //         header("Location: appointment-details.php");
        //     }
        //     else
        //     {
        //         header("Location: appointment.php");
        //     }
        // }

        header("Location: signin.php");
        // header("Location: test.php?login=successful");


        // if($domain=='patient')
        // {
        //     if(have_appointment($db,$_SESSION["user_id"]))
        //     {

        //     }
        //     else
        //     {

        //     }
        // }
        // else
        // {

        // }

    }
    else
    {
        header("Location: signin.php");
        die();
    }
?>