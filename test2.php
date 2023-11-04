<?php
    require_once "db_connection.php";
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

    echo get_doc_name($db,10);
    $doctorId = 18;

    // Your database connection code here
    // Replace with your actual database connection code

    // Perform the deletion
    $query = "DELETE FROM doctors WHERE doctor_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i',$doctorId);
    if ($stmt->execute()) {
        // Successful deletion
        $doc_name = get_doc_name($db,$doctorId);
        $query = "DELETE FROM appointments WHERE doctor_name = ?";
        $stmt2 = $db->prepare($query);
        $stmt2->bind_param('s',$doc_name);
        if ($stmt2->execute()) {
            echo "success";
        }else{
            echo "error";
        }

    } else {
        // Error during deletion
        echo 'error';
    }

?>