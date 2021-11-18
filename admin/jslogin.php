<?php
    session_start();
    require_once('config.php');
    $username = $_POST["username"];
    $password = $_POST["password"];
    //echo "$username\n$password \n- \n"; //logging
    $querryStr = "SELECT * FROM `login`";

    if ($result = $mysqli->query($querryStr)) {
        $array[] = array();
        $nameok = false;
        $passwdok = false;
        while($row = $result->fetch_row()) {
            //echo str_replace("\"", "", json_encode($row));
            $array[] = $row;
            if ($row[1] == $username) {
                $nameok = true;
                //echo "$row[3]\n$password\n";
                if ($row[3] == $password) {
                    $passwdok = true;
                    $_SESSION['userlogin'] = $username;
                }
            }
        }      
        $return = 1;
        if ($nameok) {
            if ($passwdok) {
                $return = 3;
            } else {
                $return = 2;
            }
        } 
    } else {
        $return = 0;
    }
    echo $return;
    $mysqli->close();

    // INSERT INTO login (username, email, passwd) VALUES ("reg01","mail01","fa66ed652b77f7a4bbc9e07201ea3e37cdef4e8e130890b137aa5f55a65af1d0");
    // INSERT INTO login (username, email, passwd) VALUES ("reg02","mail02","c4f7128356088f8e74c41aa91d415f173b83167480ee47129be8253e77d722a2");
    // INSERT INTO login (username, email, passwd) VALUES ("ptwstaff","info@pushtoweb.com","2fccb6f3bb16bf879fc7cfac02d5af29e4854b56860fc5cee0e5183f3462b5b5");





