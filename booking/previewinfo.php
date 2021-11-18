<?php
    $servername = "localhost";
    $username = "helooko1_whyerd";
    $password = "ty5h5j8veyom";
    $dbname = "helooko1_why3rddata";
        
    $id = $_POST['id'];

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    //echo $id;
    if ($result = $mysqli->query("SELECT d,s,e FROM `bookings` WHERE i = $id")) {
        while($row = $result->fetch_row()) {
            //echo str_replace("\"", "", json_encode($row));
            echo json_encode($row);
        }
        
    }
    

    $result->close();
    $mysqli->close();

?>