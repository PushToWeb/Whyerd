<?php
    $servername = "localhost";
    $username = "helooko1_whyerd";
    $password = "ty5h5j8veyom";
    $dbname = "helooko1_why3rddata";
    date_default_timezone_set('America/Chicago'); // CDT

    $current_day = date('d');
    $current_month = date('m');
    $current_year = substr(date('Y'), -2);
    

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $myArray = array((int)$current_year, (int)$current_month, (int)$current_day);
    $ym = (int)($current_year .$current_month);
    $response = array(array((int)$current_year, (int)$current_month, (int)$current_day));
    if ($result = $mysqli->query("SELECT * FROM `months` WHERE d >= $ym-1 AND d <= $ym+1 ORDER BY d")) {
        while($row = $result->fetch_row()) {
                $myArray[] = array((int)$row[0], (int)$row[1]);
        }
        if ($myArray[2] + (int)substr($myArray[4][1], -1) + 1 > 7) {
            if ($myArray[2] < (int)substr($myArray[4][1], 0, 2) - 6 + (int)substr($myArray[4][1], -1) ) {
                $response[] = array( array($myArray[2] + 2 - (int)substr($myArray[4][1], -1) - $myArray[2] % 7, array()),
                array($myArray[2] + 3 - (int)substr($myArray[4][1], -1) - $myArray[2] % 7, array()),
                array($myArray[2] + 4 - (int)substr($myArray[4][1], -1) - $myArray[2] % 7, array()),
                array($myArray[2] + 5 - (int)substr($myArray[4][1], -1) - $myArray[2] % 7, array()),
                array($myArray[2] + 6 - (int)substr($myArray[4][1], -1) - $myArray[2] % 7, array()),
                array($myArray[2] + 7 - (int)substr($myArray[4][1], -1) - $myArray[2] % 7, array()),
                array($myArray[2] + 8 - (int)substr($myArray[4][1], -1) - $myArray[2] % 7, array()));
            } else {
                $response[] = array(
                    array( ,array())
                    
                );
            }
        }else {
            
        }
        $dmin = 100*(int)($current_year .$current_month) + $response[1][0][0];
        $dmax = 100*(int)($current_year .$current_month) + $response[1][6][0];

        if ($result = $mysqli->query("SELECT d,s,e,i FROM bookings WHERE d >= $dmin AND d <= $dmax ORDER BY d, s")) {
            

            while($row = $result->fetch_row()) {

                for ($x = 0; $x < count($response[1]); $x++) {
                    if (100*(int)($current_year .$current_month) + $response[1][$x][0] == (int)$row[0]) {
                        $response[1][$x][1][] = $row;
                    }
                    
                  }     
            }
        }
    }
    echo json_encode($response);

    $result->close();
    $mysqli->close();

    //INSERT INTO months(d,i) VALUES (2109,303);
    //INSERT INTO months(d,i) VALUES (2110,315);
    //INSERT INTO months(d,i) VALUES (2111,301);
    //INSERT INTO months(d,i) VALUES (2112,313);
    //INSERT INTO months(d,i) VALUES (2201,316);
    //INSERT INTO months(d,i) VALUES (2202,282);
    //INSERT INTO months(d,i) VALUES (2203,312);
    //INSERT INTO months(d,i) VALUES (2204,305);
    //INSERT INTO months(d,i) VALUES (2205,317);
    //INSERT INTO months(d,i) VALUES (2206,303);
    //INSERT INTO months(d,i) VALUES (2207,315);
    //INSERT INTO months(d,i) VALUES (2208,311);
    //INSERT INTO months(d,i) VALUES (2209,304);
    //INSERT INTO months(d,i) VALUES (2210,316);
    //INSERT INTO months(d,i) VALUES (2211,302);
    //INSERT INTO months(d,i) VALUES (2212,314);


    //INSERT INTO bookings(d,s,e,b,t) VALUES (210926,"1400","1930",false,false);

    //SELECT d,s,e,i FROM bookings WHERE d >= 210920 AND d <= 210926 ORDER BY d, s

    //INSERT INTO booked (b,n0,m0,t,m1,m2) VALUES (1,"bencze Levente", "bencze.levente011@gmail.com", 2109271234124,"m11@gmail.com","m2@gmail.com" );

?>

