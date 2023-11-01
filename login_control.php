<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');    
?>

<?php
    function is_input_empty($email,$pwd)
    {
        return empty($email)||empty($pwd);
    }

    function get_result($db,$email,$domain)
    {
        $email =strtolower(trim($email));
        if ($domain =='patient')
        {
            $query = "SELECT * FROM patients WHERE LOWER(email) = ?";

        }
        else
        {
            $query = "SELECT * FROM doctors WHERE LOWER(email) = ?";

        }
        $stmt=$db->prepare($query);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        
        // $result='';
        $result = $stmt->get_result();
        // Fetch the result into the $result variable
        // $stmt->fetch();
        // Close the statement
        $stmt->close();
        return $result; 

    }
    function is_email_wrong($result)
    {
        return $result->num_rows !== 1;
    }

    function is_pwd_wrong($pwd,$hased_pwd)
    {
        return (!password_verify($pwd,$hased_pwd));
    }

    function have_appointment($db,$patientID)
    {
        $query = "SELECT * FROM appointments WHERE patientID = ?";
        $stmt=$db->prepare($query);
        $stmt->bind_param("d",$patientID);
        $stmt->execute();
        
        // $result='';
        $result = $stmt->get_result();
        // Fetch the result into the $result variable
        // $stmt->fetch();
        // Close the statement
        $stmt->close();
        return ($result->num_rows !== 0); // array or NULL(no matched records)
    }

?>