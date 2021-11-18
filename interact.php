<?php
    session_start();
    require_once('admin/config.php');
    $method = $_POST["m"];
    $return = 0;


    

    switch ($method) {
        case '1': # get a of list all booked sessions

            $shortby = $_POST["s"];
            $max = $_POST["c"];

            if ($shortby == 0) {
                $querryStr = "SELECT * FROM `booked` WHERE session >= $dateTime[9] ORDER BY `booked`.`session` ASC"; // "s=0" order by date of session
            } else {
                $querryStr = "SELECT * FROM `booked` WHERE session >= $dateTime[9] ORDER BY `booked`.`created` ASC"; // "s!=0" order by date of booking
            }
            $max == 0 ? "" : $querryStr = $querryStr . " LIMIT $max" ;
            //echo "$querryStr\n";

            if ($result = $mysqli->query($querryStr)) {
                while($row = $result->fetch_row()) {
                    $bookedS[] = $row;
                }      
                //got all the booked sessions -> $bookedS
                $querryStr = "SELECT * FROM `custom` WHERE 1";
                if ($result = $mysqli->query($querryStr)) {
                    while($row = $result->fetch_row()) {
                        $customS[] = $row;
                    }      
                    //got all the custom sessions -> $customS
                    $querryStr = "SELECT * FROM `globals` WHERE 1";
                    if ($result = $mysqli->query($querryStr)) {
                        while($row = $result->fetch_row()) {
                            $globalS[] = $row;
                        }      
                        //got all the global settings -> $globalS
                        
                        for ($i=0; $i < count($bookedS); $i++) { 
                            $team = 0;
                            for ($j=14; $j < 56; $j += 5) { 
                                $bookedS[$i][$j] != null ? $team++ : "" ;
                            }    

                            $customSessionif = -1;
                            for ($j=0; $j < count($customS); $j++) { 
                                if ($customS[$j][1] == $bookedS[$i][2] ) {
                                    $customSessionif = $j;
                                    break;
                                }
                            }
                            if ($customSessionif != -1) {
                                $startTime = $customS[$customSessionif][2];
                                $endTime = $customS[$customSessionif][3];
                                                                
                            }
                            $customSessionif = true;
                            if ($startTime == null) {
                                substr($bookedS[$i][2],-1) == "0" ? $startTime = $globalS[0][0] : $startTime = $globalS[0][9];
                                $customSessionif = false;
                            }
                            if ($endTime == null) {
                                substr($bookedS[$i][2],-1) == "0" ? $endTime = $globalS[0][1] : $endTime = $globalS[0][10];
                                $customSessionif = false;
                            }
                           
                            $retArray[] = array($bookedS[$i][0], 
                            ($bookedS[$i][1] == null ? true : false),
                            "20" .substr($bookedS[$i][2],0,2) ."." .substr($bookedS[$i][2],2,2) ."." .substr($bookedS[$i][2],4,2) .".",
                            (substr($startTime,0,-2) . ":" . substr($startTime,-2) . " - " . substr($endTime,0,-2) . ":" . substr($endTime,-2)),
                            ($bookedS[$i][3] != null ? $bookedS[$i][3] : "---"), 
                            "20" .substr($bookedS[$i][4],0,2) ."." .substr($bookedS[$i][4],2,2) ."." .substr($bookedS[$i][4],4,2) .". " .(intval(substr($bookedS[$i][4],6) / 3600)) .":" 
                            .(intval(substr($bookedS[$i][4],6) % 3600 / 60) < 10 ? "0" .intval(substr($bookedS[$i][4],6) % 3600 / 60) : intval(substr($bookedS[$i][4],6) % 3600 / 60) ),
                            $bookedS[$i][6] . " " . $bookedS[$i][7], // name
                            $bookedS[$i][8],
                            "+" .$bookedS[$i][10],
                            $team,
                            $customSessionif);
                        }
                        
                        $return = json_encode($retArray);
    
    
                    
                    }
                }
            }
        
            break;
        case '2': # 

            $id = $_POST["i"];
            
            $querryStr = "SELECT * FROM `booked` WHERE `id` = $id";

            if ($result = $mysqli->query($querryStr)) {
                while($row = $result->fetch_row()) {
                    $bookedS[] = $row;
                }      

                //got all the booked sessions -> $bookedS
                $querryStr = "SELECT * FROM `custom` WHERE 1";
                if ($result = $mysqli->query($querryStr)) {
                    while($row = $result->fetch_row()) {
                        $customS[] = $row;
                    }      
                    //got all the custom sessions -> $customS
                    $querryStr = "SELECT * FROM `globals` WHERE 1";
                    if ($result = $mysqli->query($querryStr)) {
                        while($row = $result->fetch_row()) {
                            $globalS[] = $row;
                        }      
                        //got all the global settings -> $globalS
                        
                            $rawdata = $bookedS[0];
                            $team = 0;
                            for ($j=14; $j < 56; $j += 5) { 
                                if ($rawdata[$j] != null) {
                                    $team++;
                                    $teamMembers[] = array(
                                        $rawdata[$j-2],
                                        $rawdata[$j-1],
                                        $rawdata[$j],
                                        $rawdata[$j+1] == 1 ? "male" :  "female",
                                        substr($rawdata[$j+2],0,4) ."." .substr($rawdata[$j+2],4,2) ."." .substr($rawdata[$j+2],6,2) .". "
                                    );
                                }
                                
                            }    
                            $customSessionif = -1;
                            for ($j=0; $j < count($customS); $j++) { 
                                if ($customS[$j][1] == $rawdata[2] ) {
                                    $customSessionif = $j;
                                    break;
                                }
                            }
                            if ($customSessionif != -1) {
                                $startTime = $customS[$customSessionif][2];
                                $endTime = $customS[$customSessionif][3];
                                                                
                            }
                            $customSessionif = true;
                            if ($startTime == null) {
                                substr($rawdata[2],-1) == "0" ? $startTime = $globalS[0][0] : $startTime = $globalS[0][9];
                                $customSessionif = false;
                            }
                            if ($endTime == null) {
                                substr($rawdata[2],-1) == "0" ? $endTime = $globalS[0][1] : $endTime = $globalS[0][10];
                                $customSessionif = false;
                            }


                            
                            $retArray[] = "20" .substr($rawdata[2],0,2) ."." .substr($rawdata[2],2,2) ."." .substr($rawdata[2],4,2) .".";
                            $retArray[] = substr($startTime,0,-2) . ":" . substr($startTime,-2);
                            $retArray[] = substr($endTime,0,-2) . ":" . substr($endTime,-2);
                            $retArray[] = $rawdata[1] == null  ? "Valid" : "Canceled on " . "20" .substr($rawdata[1],0,2) ."." .substr($rawdata[1],2,2) ."." .substr($rawdata[1],4,2) .". " .(intval(substr($rawdata[1],6) / 3600)) .":" 
                            .(intval(substr($rawdata[1],6) % 3600 / 60) < 10 ? "0" .intval(substr($rawdata[1],6) % 3600 / 60) : intval(substr($rawdata[1],6) % 3600 / 60) );
                            $retArray[] = substr($rawdata[4],0,2) ."." .substr($rawdata[4],2,2) ."." .substr($rawdata[4],4,2) .". " .(intval(substr($rawdata[4],6) / 3600)) .":" 
                            .(intval(substr($rawdata[4],6) % 3600 / 60) < 10 ? "0" .intval(substr($rawdata[4],6) % 3600 / 60) : intval(substr($rawdata[4],6) % 3600 / 60) );
                            $retArray[] = $rawdata[3] == null ? " -None-" :  $rawdata[3];
                            $retArray[] = $rawdata[6];
                            $retArray[] = $rawdata[7];
                            $retArray[] = $rawdata[8];
                            $retArray[] = $rawdata[9] == 1 ? "male" :  "female";
                            $retArray[] = substr($rawdata[11],0,4) ."." .substr($rawdata[11],4,2) ."." .substr($rawdata[11],6,2) .". ";
                            $retArray[] = "+" .$rawdata[10];
                            $retArray[] = $rawdata[5];
                            $retArray[] = $team;
                            $retArray[] = $teamMembers;
                            $retArray[] = $customSessionif;


                            #$return = json_encode($retArray);
                            #$return = json_encode($rawdata);
                            $return = json_encode($retArray);
                    }
                }

                
            }
        
            break;
        
        case '3': # get data for main admin (admin.php)

            $querryStr = "SELECT * FROM `booked` WHERE session >= $dateTime[9] ORDER BY `booked`.`session` ASC LIMIT 5";
            if ($result = $mysqli->query($querryStr)) { # get top 5 upcoming events
                while($row = $result->fetch_row()) {
                    $upcomingB[] = $row;
                    $sessions[] = $row[2];
                } 

                $querryStr = "SELECT * FROM `booked` WHERE session >= $dateTime[9] ORDER BY `booked`.`created` ASC LIMIT 5";
                if ($result = $mysqli->query($querryStr)) { # get top 5 most recent bookings
                    while($row = $result->fetch_row()) {
                        $recentB[] = $row;
                        $sessions[] = $row[2];
                    } 

                    $querryStr = "SELECT * FROM `globals` LIMIT 1";
                    if ($result = $mysqli->query($querryStr)) { # get Global Settings
                        while($row = $result->fetch_row()) {
                            $globals = $row;
                        } 

                        $querryStr = "SELECT * FROM `custom` WHERE session >= $dateTime[9] ORDER BY `custom`.`session` ASC LIMIT 5";
                        if ($result = $mysqli->query($querryStr)) { # get top 5 custom sessions
                            while($row = $result->fetch_row()) {
                                $allCustomSessions[] = $row;
                            } 

                            $querryStr = "SELECT * FROM `vouchers` LIMIT 5";
                            if ($result = $mysqli->query($querryStr)) { # get top 5 custom sessions
                                while($row = $result->fetch_row()) {
                                    $vouchers[] = $row;
                                } 
                        



                                $gotAllData = false;
                                if (count($sessions) > 0) {
                                    $querryStr = "SELECT * FROM `custom` WHERE `session` = $sessions[0]";
                                    if (count($sessions) > 1) {
                                        for ($i=1; $i < count($sessions); $i++) { 
                                            $querryStr = $querryStr." OR `session` = $sessions[$i]";
                                        }
                                    }
                                    if ($result = $mysqli->query($querryStr)) { # get custom data for dashboard
                                        while($row = $result->fetch_row()) {
                                            $customSessionsHelper[] = $row;
                                        } 
                                        $gotAllData = true;
                                    }
                                    # code...
                                } else {
                                    $gotAllData = true;
                                }
                                if ($gotAllData) {
                                    $rawReturn = array(
                                        array(),
                                        array(),
                                        array(),
                                        array(),
                                        array()
                                    );

                                    for ($i=0; $i < count($upcomingB); $i++) { # make the data ready for frontend - - top 5 upcoming events
                                        $rawReturn[0][$i][] = $upcomingB[$i][0]; # ID
                                        $rawReturn[0][$i][] = $upcomingB[$i][1] == null ? true : false; # is it walid
                                        $rawReturn[0][$i][] = substr($upcomingB[$i][2],-1) == "0" ? 1 : 2; # session
                                        $rawReturn[0][$i][] = "20".substr($upcomingB[$i][2],0,2).".".substr($upcomingB[$i][2],2,2).".".substr($upcomingB[$i][2],4,2)."."; # date
                                        
                                        $customif = -1;
                                        for ($j=0; $j < count($customSessionsHelper); $j++) { 
                                            if ($customSessionsHelper[$j][1] == $upcomingB[$i][2]) {
                                                $customif = $j;
                                            }
                                        }
                                        $startTime = null;
                                        $endTime = null;
                                        if ($customif != -1) {
                                            $startTime = $customSessionsHelper[$customif][2];
                                            $endTime = $customSessionsHelper[$customif][3];
                                        }
                                        $customif = true;
                                        if ($startTime == null) {
                                            substr($upcomingB[$i][2],-1) == "0" ? $startTime = $globals[0] : $startTime = $globals[9];
                                            $customif = false;
                                        }
                                        if ($endTime == null) {
                                            substr($upcomingB[$i][2],-1) == "0" ? $endTime = $globals[1] : $endTime = $globals[10];
                                            $customif = false;
                                        }
                                        $rawReturn[0][$i][] = substr($startTime,0,-2).":".substr($startTime,-2)." - ".substr($endTime,0,-2).":".substr($endTime,-2); # time

                                        $rawReturn[0][$i][] = $upcomingB[$i][3] == null ? "---" : $upcomingB[$i][3]; # voucher
                                        $rawReturn[0][$i][] = $upcomingB[$i][6]." ".$upcomingB[$i][7]; # name
                                        $rawReturn[0][$i][] = $upcomingB[$i][8]; # email
                                        $rawReturn[0][$i][] = "+".$upcomingB[$i][10]; # phone number
                                        $team = 0;
                                        for ($j=14; $j < 56; $j += 5) { 
                                            $upcomingB[$i][$j] != null ? $team++ : "" ;
                                        }  
                                        $rawReturn[0][$i][] = $team; # team meber count
                                        $rawReturn[0][$i][] = $customif; #custom session
                                        
                                    }
                                    for ($i=0; $i < count($recentB); $i++) { # make the data ready for frontend - - top 5 recent bookings
                                        $rawReturn[1][$i][] = $recentB[$i][0]; # ID
                                        $rawReturn[1][$i][] = $recentB[$i][1] == null ? true : false; # is it walid
                                        $rawReturn[1][$i][] = substr($recentB[$i][2],-1) == "0" ? 1 : 2; # session
                                        $rawReturn[1][$i][] = "20".substr($recentB[$i][2],0,2).".".substr($recentB[$i][2],2,2).".".substr($recentB[$i][2],4,2)."."; # date
                                        
                                        $customif = -1;
                                        for ($j=0; $j < count($customSessionsHelper); $j++) { 
                                            if ($customSessionsHelper[$j][1] == $recentB[$i][2]) {
                                                $customif = $j;
                                            }
                                        }
                                        $startTime = null;
                                        $endTime = null;
                                        if ($customif != -1) {
                                            $startTime = $customSessionsHelper[$customif][2];
                                            $endTime = $customSessionsHelper[$customif][3];
                                        }
                                        $customif = true;
                                        if ($startTime == null) {
                                            substr($recentB[$i][2],-1) == "0" ? $startTime = $globals[0] : $startTime = $globals[9];
                                            $customif = false;
                                        }
                                        if ($endTime == null) {
                                            substr($recentB[$i][2],-1) == "0" ? $endTime = $globals[1] : $endTime = $globals[10];
                                            $customif = false;
                                        }
                                        $rawReturn[1][$i][] = substr($startTime,0,-2).":".substr($startTime,-2)." - ".substr($endTime,0,-2).":".substr($endTime,-2); # time
                                        

                                        $rawReturn[1][$i][] = $recentB[$i][3] == null ? "---" : $recentB[$i][3]; # voucher
                                        $rawReturn[1][$i][] = $recentB[$i][6]." ".$recentB[$i][7]; # name
                                        $rawReturn[1][$i][] = $recentB[$i][8]; # email
                                        $rawReturn[1][$i][] = "+".$recentB[$i][10]; # phone number
                                        $team = 0;
                                        for ($j=14; $j < 56; $j += 5) { 
                                            $recentB[$i][$j] != null ? $team++ : "" ;
                                        }  
                                        $rawReturn[1][$i][] = $team; # team meber count
                                        $rawReturn[1][$i][] = $customif; #custom session
                                        $rawReturn[1][$i][] = "20" .substr($recentB[$i][4],0,2) ."." .substr($recentB[$i][4],2,2) ."." .substr($recentB[$i][4],4,2) .". " .(intval(substr($recentB[$i][4],6) / 3600)) .":" 
                                        .(intval(substr($recentB[$i][4],6) % 3600 / 60) < 10 ? "0" .intval(substr($recentB[$i][4],6) % 3600 / 60) : intval(substr($recentB[$i][4],6) % 3600 / 60) ); # booked time
                                        
                                        
                                    }

                                    for ($i=0; $i < count($allCustomSessions); $i++) { 
                                        $rawReturn[3][$i][] = $allCustomSessions[$i][0]; # ID
                                        $rawReturn[3][$i][] = $allCustomSessions[$i][4] != "0" ? true : false; # is it walid
                                        $rawReturn[3][$i][] = substr($allCustomSessions[$i][1],-1)+1;
                                        $rawReturn[3][$i][] = "20" .substr($allCustomSessions[$i][1],0,2) ."." .substr($allCustomSessions[$i][1],2,2) ."." .substr($allCustomSessions[$i][1],4,2) ."."; # date
                                        $rawReturn[3][$i][] = $allCustomSessions[$i][2] == null ? "---" : substr($allCustomSessions[$i][2],0,-2).":".substr($allCustomSessions[$i][2],-2) ; # start
                                        
                                        $rawReturn[3][$i][] = $allCustomSessions[$i][3] == null ? "---" : substr($allCustomSessions[$i][3],0,-2).":".substr($allCustomSessions[$i][3],-2) ; # end
                                        
                                    }

                                    for ($i=0; $i < count($vouchers); $i++) { 
                                        $rawReturn[4][$i][] = $vouchers[$i][0]; # ID
                                        $rawReturn[4][$i][] = $vouchers[$i][5] != "0" ? true : false; # is it walid
                                        $rawReturn[4][$i][] = $vouchers[$i][1]; # name/code
                                        $rawReturn[4][$i][] = $vouchers[$i][3] == null ? "---" : ("20" .substr($vouchers[$i][3],0,2) ."." .substr($vouchers[$i][3],2,2) ."." .substr($vouchers[$i][3],4,2) .". " .(intval(substr($vouchers[$i][3],6) / 3600)) .":" 
                                        .(intval(substr($vouchers[$i][3],6) % 3600 / 60) < 10 ? "0" .intval(substr($vouchers[$i][3],6) % 3600 / 60) : intval(substr($vouchers[$i][3],6) % 3600 / 60) )); # start
                                        $rawReturn[4][$i][] = $vouchers[$i][3] == null ? "---" : ("20" .substr($vouchers[$i][4],0,2) ."." .substr($vouchers[$i][4],2,2) ."." .substr($vouchers[$i][4],4,2) .". " .(intval(substr($vouchers[$i][4],6) / 3600)) .":" 
                                        .(intval(substr($vouchers[$i][4],6) % 3600 / 60) < 10 ? "0" .intval(substr($vouchers[$i][4],6) % 3600 / 60) : intval(substr($vouchers[$i][4],6) % 3600 / 60) )) ; # end
                                        $rawReturn[4][$i][] = $vouchers[$i][2]; # used
                                        
                                         
                                        
                                    }

                                    $rawReturn[2][] = substr($globals[0],0,-2).":".substr($globals[0],-2);
                                    $rawReturn[2][] = substr($globals[1],0,-2).":".substr($globals[1],-2);
                                    $rawReturn[2][] = 
                                    (int)((((int)substr($globals[1],0,-2)*60 + (int)substr($globals[1],-2))-((int)substr($globals[0],0,-2)*60 + (int)substr($globals[0],-2))) / 60).":".((((int)substr($globals[1],0,-2)*60 + (int)substr($globals[1],-2))-((int)substr($globals[0],0,-2)*60 + (int)substr($globals[0],-2))) % 60);
                                    $rawReturn[2][] = $globals[2] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[3] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[4] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[5] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[6] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[7] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[8] != "0" ? true : false;
                                    $rawReturn[2][] = substr($globals[9],0,-2).":".substr($globals[9],-2);
                                    $rawReturn[2][] = substr($globals[10],0,-2).":".substr($globals[10],-2);
                                    $rawReturn[2][] = 
                                    (int)((((int)substr($globals[10],0,-2)*60 + (int)substr($globals[10],-2))-((int)substr($globals[9],0,-2)*60 + (int)substr($globals[9],-2))) / 60).":".((((int)substr($globals[10],0,-2)*60 + (int)substr($globals[10],-2))-((int)substr($globals[9],0,-2)*60 + (int)substr($globals[9],-2))) % 60);
                                    $rawReturn[2][] = $globals[11] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[12] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[13] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[14] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[15] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[16] != "0" ? true : false;
                                    $rawReturn[2][] = $globals[17] != "0" ? true : false;
                            
                                    $toret = array(
                                        $upcomingB,
                                        $recentB,
                                        $customSessionsHelper,
                                        $globals,
                                        $allCustomSessions,
                                        $vouchers,
                                        $rawReturn
                                    );
                        
                                    $return = json_encode($rawReturn);
                                }
                            }
                        }
                    }
                }
            }

            break;
        case '4':

            $dateTime[1] = "21"; #year
            $dateTime[2] = "11"; #month
            $dateTime[3] = "09"; #day
            $querryStr = "SELECT * FROM `globals` LIMIT 1";
            if ($result = $mysqli->query($querryStr)) { # get Global Settings
                while($row = $result->fetch_row()) {
                    $globals = $row;
                } 
                $querryStr = "SELECT session FROM `booked` WHERE session >= $dateTime[9] and canceled IS NULL ORDER BY `booked`.`session` ASC";
                if ($result = $mysqli->query($querryStr)) { # get Booked sessions
                    while($row = $result->fetch_row()) {
                        $bookedS[] = $row;
                    } 
                    $querryStr = "SELECT session, start, end, available FROM custom WHERE session >= $dateTime[9] ORDER BY session ASC";
                    if ($result = $mysqli->query($querryStr)) { # get Custom Sessions
                        while($row = $result->fetch_row()) {
                            $customS[] = $row;
                        } 
                        $querryStr = "SELECT * FROM `months`";
                        if ($result = $mysqli->query($querryStr)) { # get Custom Sessions
                            while($row = $result->fetch_row()) {
                                $months[] = $row;
                            } 
                        
                            for ($i=0; $i < count($customS); $i++) { 
                                $status = null;
                                for ($j=0; $j < count($bookedS); $j++) { 
                                    if ($customS[$i][0] == $bookedS[$j][0]) {
                                        $status = "b"; # booked
                                        break;
                                    }
                                }
                                if ($status == null) {
                                    if ($customS[$i][3]==0) {
                                        $status = "b"; # unavaliable / deleted
                                    } else {
                                        $status = "a"; # avaliable
                                    }
                                }
                                $customStatus[] = array($customS[$i][0] , $status);
                            }
                            for ($i=0; $i < count($bookedS); $i++) { 
                                $containsif = false;
                                for ($j=0; $j < count($customStatus); $j++) { 
                                    if ($customStatus[$j][0] == $bookedS[$i][0]) {
                                        $containsif = true;
                                        break;
                                    }
                                }
                                if (!$containsif) {
                                    for ($j=0; $j < count($customStatus); $j++) { 
                                        if ((int)$bookedS[$i][0] < (int)$customStatus[$j][0]) {
                                            $customStatus =  array_merge( array_slice($customStatus,0,$j), array(array($bookedS[$i][0],"b")), array_slice($customStatus, $j, count($customStatus) -1, true)) ;
                                            #+ array_slice($customStatus, $j, count($customStatus) -1, true));
                                            $containsif = true;
                                            break;
                                        } 
                                    }
                                    if (!$containsif) {
                                        $customStatus[] = array($bookedS[$i][0],"b");
                                    }
                                }
                            }

                            $globals[0] =  substr($globals[0],0,-2).":".substr($globals[0],-2);
                            $globals[1] =  substr($globals[1],0,-2).":".substr($globals[1],-2);
                            $globals[9] =  substr($globals[9],0,-2).":".substr($globals[9],-2);
                            $globals[10] =  substr($globals[10],0,-2).":".substr($globals[10],-2);
                            $rawReturn[0] = array_merge(array($dateTime[1],$dateTime[2],$dateTime[3]) ,$globals);
                            $rawReturn[1] = $customStatus;
                            for ($i=array_search($dateTime[1].$dateTime[2] ,array_column($months,0))-1; $i < count($months); $i++) { 
                                $rawReturn[2][] = array((int)substr($months[$i][0],0,2),(int)substr($months[$i][0],2),(int)substr($months[$i][1],0,2),(int)substr($months[$i][1],-1));
                            }
                            for ($i=0; $i < count($customS); $i++) { 
                                $rawReturn[3][] = array(
                                    $customS[$i][0],
                                    substr($customS[$i][1],0,-2).":".substr($customS[$i][1],-2),
                                    substr($customS[$i][2],0,-2).":".substr($customS[$i][2],-2)

                                );
                            }
                           
                            
                            

                            

                            $toret = array(
                                $globals,
                                $bookedS,
                                $customS,
                                $months,
                                $dateTime,
                                $customStatus,
                                $rawReturn
                            );

                            $return = json_encode($rawReturn);
                        }
                    }
                }
            }
            

            
            
            break;
        default:
            $return = "else";
            break;
    }
    echo $return;
    $mysqli->close();