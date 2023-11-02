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

<html>
    <head>
        <title>lol</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="get_timeslots.php" method="get">
        <label for="doctor"><sup>*</sup>Dentist:</label>
        <select id="doctor" name="doctor" required>
            <!-- <option >Dr Lee</option>
            <option >Dr Shawn</option>
            <option >Dr Shanice</option> -->
            <?php
                $retrieve_doc = "SELECT username from doctors";
                $result = $db->query($retrieve_doc);
                
                if($result)
                {
                    if($result->num_rows>0)
                    {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option>Dr ".$row['username']."</option>";
                        }
                        $result->free();                                
                    }
                }
                else
                {
                    echo "Error: " . $mysqli->error;
                }
            ?>
            <!-- <option value="doctor">Doctor</option> -->
        </select>
        <label for="date"><sup>*</sup>Date: </label>
        <input type="date" id="date" name="date" required>
        <input type="submit">
        </form>
    </body>
</html>
