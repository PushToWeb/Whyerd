<?php
    $servername = "localhost";
    $db_user = "helooko1_whyerd";
    $db_pass = "ty5h5j8veyom";
    $db_name = "helooko1_why3rddata";
    date_default_timezone_set('America/Chicago'); // CDT

    $dateTime = array(
        "",
        substr(date('Y'), -2),
        date('m'),
        date('d'),
        date('H'),
        date('i'),
        date('s'),
    );
    $dateTime[0] = "".$dateTime[1].$dateTime[2].$dateTime[3].($dateTime[4]*60*60 + (int)$dateTime[5]*60 + (int)$dateTime[6]);
    $dateTime[] = "".$dateTime[1].$dateTime[2].$dateTime[3];
    $dateTime[] = "".($dateTime[4]*60*60 + (int)$dateTime[5]*60 + (int)$dateTime[6]);
    $dateTime[] = "".$dateTime[1].$dateTime[2].$dateTime[3]."0";



    $mysqli = new mysqli($servername, $db_user, $db_pass, $db_name);