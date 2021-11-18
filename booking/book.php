<?php
    $obj = json_decode($_POST["data"]);
    
    $servername = "localhost";
    $username = "helooko1_whyerd";
    $password = "ty5h5j8veyom";
    $dbname = "helooko1_why3rddata";
    date_default_timezone_set('America/Chicago'); // CDT

    $current_day = date('d');
    $current_month = date('m');
    $current_year = substr(date('Y'), -2);
    $current_hour = date('H');
    $current_minute = date('i');
    $current_second = date('s');
    $b = $obj[0];
    $n0 = $obj[1];
    $m0 = $obj[2];
    $p = $obj[4];
    $t = $current_year .$current_month .$current_day .((int)$current_hour*60*60 + (int)$current_minute*60 + (int)$current_second);
    //echo $t;
    $emails = "";
    $ms = "";
    for ($i=0; $i < count($obj[3]); $i++) { 
        $emails = $emails .",\"" .$obj[3][$i] ."\"";
        $ms = $ms .",m" .($i+1);
    }
    $querryStr = "INSERT INTO booked (b,n0,m0,p,t$ms) VALUES ($b,\"$n0\",\"$m0\",\"$p\",$t$emails)";
    //$querryStr = mysql_real_escape_string($querryStr);
    echo $querryStr;
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($result = $mysqli->query($querryStr)) {
        echo $result;
        
    }
    

    
    $mysqli->close();


 ?>