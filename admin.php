<?php 
    session_start();
	if(!isset($_SESSION['userlogin'])){
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
            font-family: "Roboto", sans-serif;
        }
        
        .main {
            padding-top: 90px;
            display: flex;
            max-width: 1005px;
            margin: auto;
            padding-bottom: 50px;
            transition: all 0.5s ease-in-out;
        }
        
        .menu,
        .logoutfromadmin {
            width: 200px;
        }
        
        .logoutfromadmin {
            display: flex;
            justify-content: right;
        }
        
        header {
            background-color: #D0E8F0;
            position: fixed;
            width: 100%;
            z-index: 10;
            box-shadow: 0 0 10px 3px #fff;
        }
        
        .headerbody {
            display: flex;
            max-width: 1005px;
            margin: auto;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        
        button {
            border-radius: 20px;
            padding: 7px 12px;
            margin: 7px 7px;
            cursor: pointer;
            background-color: #162E35;
            border: none;
            color: white;
            transition: all 0.2s ease-in-out;
        }
        
        button:hover {
            transform: scale(1.05);
        }
        /*end globals*/
        
        #loadingdiv {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            transition: all 1s ease-in-out;
        }
        
        .mainbody {
            margin: 0 auto;
        }
        
        .bgroup {
            display: flex;
            width: fit-content;
            align-items: stretch;
            padding: 15px;
            box-shadow: none;
        }
        
        .bgoupouter {
            display: flex;
            width: 100%;
            justify-content: center;
            border-radius: 30px;
            margin-top: 10px;
            background-color: #D0E8F0;
        }
        
        .bgroup h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .globals div h3 {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 25px;
        }
        
        .globaltime {
            display: flex;
            align-items: center;
            width: max-content;
            margin: 10px auto;
            border-radius: 100px;
            border: 2px solid #fff;
            padding: 5px 5px;
            padding-left: 20px;
        }
        
        .globaltime span {
            font-weight: bold;
            margin-right: 10px;
        }
        
        .globaldays {
            display: flex;
        }
        
        .globaldays button {
            background-color: #309F43;
            width: 105px;
            padding: 7px 10px;
        }
        
        .globaldays div {
            flex-grow: 1;
        }
        
        .item:hover {
            transform: scale(1.005);
            box-shadow: 0 0 3px 1px rgb(121, 118, 118);
        }
        
        .structurehelper {
            padding-left: 15px;
            margin: 5px 0px;
            display: flex;
            align-items: stretch;
            position: relative;
            border: 2px solid #D0E8F0;
        }
        
        .item {
            border-radius: 100px;
            border: 2px solid #309F43;
            transition: all 0.3s ease-in-out;
        }
        
        .structurehelper .customif {
            margin-left: -30px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 28px;
            width: 28px;
            border-radius: 50px;
            border: #162E35 2px solid;
            background-color: white;
            color: #162E35;
            font-weight: bold;
            font-size: 20px;
            margin-top: -2px;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        
        .structurehelper .customif:hover {
            transform: scale(1.1);
        }
        
        .buttonplace {
            display: flex;
            margin-top: 15px;
        }
        
        .buttonplace div {
            flex-grow: 1;
            display: flex;
            justify-content: center;
        }
        
        .upcomingsessions {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }
        
        .structitem {
            display: flex;
            justify-content: center;
            align-items: center;
            border-right: 1px solid #162E35;
            text-align: center;
            margin: 5px 0px;
        }
        
        .structitem div p {
            border-radius: 20px;
            border: White solid 2px;
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            padding: auto;
            height: 25px;
            width: 25px;
            font-size: 15px;
        }
        
        .upcomingsessions div.structitem:nth-child(1) {
            border: none;
        }
        
        .upcomingsessions div.structitem:nth-child(2) {
            width: 120px;
        }
        
        .upcomingsessions div.structitem:nth-child(3) {
            width: 105px;
        }
        
        .upcomingsessions div.structitem:nth-child(4) {
            width: 76px;
        }
        
        .upcomingsessions div.structitem:nth-child(5) {
            width: 90px;
        }
        
        .upcomingsessions div.structitem:nth-child(6) {
            width: 180px;
        }
        
        .upcomingsessions div.structitem:nth-child(7) {
            width: 113px;
        }
        
        .upcomingsessions div.structitem:nth-child(8) {
            border: none;
            padding-left: 5px;
            min-width: 30px;
        }
        
        .upcomingsessions div.structitem:nth-child(9) {
            float: right;
            border: none;
        }
        
        .recentsessions div.structitem:nth-child(2) {
            width: 130px;
        }
        
        .recentsessions div.structitem:nth-child(3) {
            width: 120px;
        }
        
        .recentsessions div.structitem:nth-child(4) {
            width: 105px;
        }
        
        .recentsessions div.structitem:nth-child(5) {
            width: 76px;
        }
        
        .recentsessions div.structitem:nth-child(6) {
            width: 89px;
        }
        
        .recentsessions div.structitem:nth-child(7) {
            width: 180px;
        }
        
        .recentsessions div.structitem:nth-child(8) {
            width: 113px;
        }
        
        .recentsessions div.structitem:nth-child(9) {
            min-width: 30px;
            padding-left: 5px;
            border: none;
        }
        
        .recentsessions div.structitem:nth-child(10) {
            border: none;
            width: 113px;
        }
        
        .recentsessions div.structitem:nth-child(1) {
            border: none;
        }
        
        .unactive {
            border: 2px solid #A2283B;
        }
        
        .dayoff {
            background-color: #A2283B !important;
        }
        
        .btnicon div {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btnicon img {
            height: auto;
            width: 0px;
            margin-left: 0px;
            transition: all 0.2s ease-in-out;
            transform: scale(0);
        }
        
        button.btnicon:hover img {
            margin-left: 5px;
            width: 15px;
            transform: scale(1);
        }
        
        button.btnicon {
            min-width: 93px;
        }
        
        .csessions div.structitem:nth-child(1) {
            width: 100px;
        }
        
        .csessions div.structitem:nth-child(2) {
            width: 80px;
        }
        
        .csessions div.structitem:nth-child(3) {
            width: 65px;
        }
        
        .csessions div.structitem:nth-child(4) {
            width: 65px;
        }
        
        .csessions div.structitem:nth-child(5) {
            width: 100px;
            border: none;
        }
        
        .csessions div.structitem:nth-child(6) {
            float: right;
            border: none;
            margin-right: 5px;
        }
        
        .vouchers div.structitem:nth-child(1) {
            width: 100px;
        }
        
        .vouchers div.structitem:nth-child(2) {
            width: 135px;
        }
        
        .vouchers div.structitem:nth-child(3) {
            width: 135px;
        }
        
        .vouchers div.structitem:nth-child(4) {
            width: 50px;
        }
        
        .vouchers div.structitem:nth-child(5) {
            width: 100px;
            border: none;
        }
        
        .vouchers div.structitem:nth-child(6) {
            border: none;
        }
        
        .hideme {
            display: none !important;
        }
        
        .whitebtn {
            background-color: white;
            color: #162E35;
        }
    </style>
</head>

<body>
    <header>
        <div class="headerbody">
            <div class="menu">
                <button class="whitebtn" onclick="location.href='/'">Back to HomePage</button>
            </div>
            <div>
                <h1>Whyerd Admin</h1>
            </div>
            <div class="logoutfromadmin">
                <button onclick="location.href='/logout.php'">Logout</button>
            </div>
        </div>
    </header>
    <div id="loadingdiv">
        <h3>Loading...</h3>
    </div>
    <div class="main hideme">
        <div class="mainbody">
            <div class="bgoupouter">
                <div class="bgroup">
                    <div class="bookedsessions">
                        <div class="upcomingsessions">
                            <div>
                                <h2>Upcoming events</h2>
                                <div class="structurehelper">
                                    <div class="structitem">

                                    </div>
                                    <div class="structitem">
                                        <p>Date</p>
                                    </div>
                                    <div class="structitem">
                                        <p>Time</p>
                                    </div>
                                    <div class="structitem">
                                        <p>Voucher</p>
                                    </div>
                                    <div class="structitem">
                                        <p>Name</p>
                                    </div>
                                    <div class="structitem">
                                        <p>Email</p>
                                    </div>
                                    <div class="structitem">
                                        <p>Phone</p>
                                    </div>
                                    <div class="structitem">
                                        <p>Team</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recentsessions">
                            <h2>Recently Booked Sessions</h2>
                            <div class="structurehelper">

                                <div class="structitem">

                                </div>
                                <div class="structitem">
                                    <p>Date of booking</p>
                                </div>
                                <div class="structitem">
                                    <p>Date of session</p>
                                </div>
                                <div class="structitem">
                                    <p>Time</p>
                                </div>
                                <div class="structitem">
                                    <p>Voucher</p>
                                </div>
                                <div class="structitem">
                                    <p>Name</p>
                                </div>
                                <div class="structitem">
                                    <p>Email</p>
                                </div>
                                <div class="structitem">
                                    <p>Phone</p>
                                </div>
                                <div class="structitem">
                                    <p>Team</p>
                                </div>
                            </div>

                        </div>
                        <div class="buttonplace">
                            <div>
                                <button onclick="location.href='/sessions.php'">See all Bookings</button>
                            </div>
                            <div>
                                <button class="whitebtn" onclick="location.href='/sessions/add.php'">Add New Booking Session Manually</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bgoupouter">
                <div class="bgroup">
                    <div class="globals">
                        <h2>Global Settings</h2>
                        <div>
                            <h3>First session</h3>
                            <div class="globaltime session1global">
                                <p>Start time: <span id="starttime1">8:00</span></p>
                                <p>Start time: <span id="endtime1">13:30</span></p>
                                <p>Duration: <span id="duration1">5:30</span></p>
                                <button class="btnicon" onclick="changeGlobal1()"><div><p>Edit</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                            </div>
                            <div class="globaldays">
                                <div>
                                    <button class="btnicon" id="day11" onclick='changeGlobal("11")'><div><p>Monday</p> <img src="./assets/edit_property_26px.png" alt=""></div> </button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day12" onclick='changeGlobal("12")'><div><p>Tuesday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day13" onclick='changeGlobal("13")'><div><p>Wednesday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day14" onclick='changeGlobal("14")'><div><p>Thursday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day15" onclick='changeGlobal("15")'><div><p>Friday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day16" onclick='changeGlobal("16")'><div><p>Saturday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day17" onclick='changeGlobal("17")'><div><span>Sunday</span> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3>Second session</h3>
                            <div class="globaltime session2global">
                                <p>Start time: <span id="starttime2">8:00</span></p>
                                <p>Start time: <span id="endtime2">13:30</span></p>
                                <p>Duration: <span id="duration2">5:30</span></p>
                                <button class="btnicon" onclick="changeGlobal2()"><div><p>Edit</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                            </div>
                            <div class="globaldays">
                                <div>
                                    <button class="btnicon" id="day21" onclick='changeGlobal("21")'><div><p>Monday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day22" onclick='changeGlobal("22")'><div><p>Tuesday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day23" onclick='changeGlobal("23")'><div><p>Wednesday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day24" onclick='changeGlobal("24")'><div><p>Thursday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day25" onclick='changeGlobal("25")'><div><p>Friday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day26" onclick='changeGlobal("26")'><div><p>Saturday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                                <div>
                                    <button class="btnicon" id="day27" onclick='changeGlobal("27")'><div><p>Sunday</p> <img src="./assets/edit_property_26px.png" alt=""></div></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bgoupouter">
                <div class="bgroup">
                    <div>
                        <div class="csessions">
                            <h2>Custom sessions</h2>
                            <div class="structurehelper">

                                <div class="structitem">
                                    <p>Date</p>
                                </div>
                                <div class="structitem">
                                    <p>Session</p>
                                </div>
                                <div class="structitem">
                                    <p>Start</p>
                                </div>
                                <div class="structitem">
                                    <p>End</p>
                                </div>
                                <div class="structitem">
                                    <p>Status</p>
                                </div>
                            </div>
                        </div>
                        <div class="buttonplace">
                            <div>
                                <button onclick="location.href='/customsessions.php'">See all Custom Sessions</button>
                            </div>
                            <div>
                                <button class="whitebtn" onclick="location.href='/customsessions/add.php'">Add New Custom Session</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bgoupouter">
                <div class="bgroup">
                    <div>
                        <div class="vouchers">
                            <h2>Wouchers</h2>
                            <div class="structurehelper">
                                <div class="structitem">
                                    <p>Voucher</p>
                                </div>
                                <div class="structitem">
                                    <p>Start</p>
                                </div>
                                <div class="structitem">
                                    <p>End</p>
                                </div>
                                <div class="structitem">
                                    <p>Used</p>
                                </div>
                                <div class="structitem">
                                    <p>Status</p>
                                </div>
                            </div>
                        </div>

                        <div class="buttonplace">
                            <div>
                                <button onclick="location.href='/vouchers.php'">See all Vouchers</button>
                            </div>
                            <div>
                                <button class="whitebtn" onclick="location.href='/vouchers/add.php'">Add New Voucher</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js" integrity="sha512-szJ5FSo9hEmXXe7b5AUVtn/WnL8a5VofnFeYC2i2z03uS2LhAch7ewNLbl5flsEmTTimMN0enBZg/3sQ+YOSzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function details(id) {
            location.href = "/sessions/details.php?id=" + id;
        }

        function changeGlobal(id) {
            alert("Change day" + id)
        }

        function changeGlobal1() {
            alert("Change Global settings on session 1")
        }

        function changeGlobal2() {
            alert("Change Global settings on session 2")
        }

        function changeCustomSession(id) {
            alert("Change Custom session: " + id)
        }

        function changeVoucher(id) {
            alert("Change Voucher: " + id)
        }
        $.ajax({
            type: 'POST',
            url: '/interact.php',
            data: {
                m: 3
            },
            success: function(data) {
                rawdt = jQuery.parseJSON(data);
                console.log(data);
                console.log(rawdt);
                for (let i = 0; i < rawdt[0].length; i++) {
                    $(".upcomingsessions div").html(
                        $(".upcomingsessions div").html() +
                        '<div class="structurehelper item' +
                        ((rawdt[0][i][1] === false) ? ' unactive' : '') +
                        '"><div class="structitem' +
                        ((rawdt[0][i][10] === false) ? ' hideme' : '') +
                        '"><div class="customif">!</div></div><div class="structitem"><p>' +
                        rawdt[0][i][3] +
                        '</p><div><p>' +
                        rawdt[0][i][2] +
                        '</p></div></div><div class="structitem"><p>' +
                        rawdt[0][i][4] +
                        '</p></div><div class="structitem"><p>' +
                        rawdt[0][i][5] +
                        '</p></div><div class="structitem"><p>' +
                        rawdt[0][i][6] +
                        '</p></div><div class="structitem"><p>' +
                        ((rawdt[0][i][7].length > 20) ? (rawdt[0][i][7].substr(0, 5) + '...' + rawdt[0][i][7].substr(-13)) : rawdt[0][i][7]) +
                        '</p></div><div class="structitem"><p>' +
                        rawdt[0][i][8] +
                        '</p></div><div class="structitem"><p>' +
                        rawdt[0][i][9] +
                        '</p></div><div class="structitem"><button onclick=\"details(' + rawdt[0][i][0] + ')\">More Details</button></div></div>'
                    );
                }

                for (let i = 0; i < rawdt[1].length; i++) {
                    $(".recentsessions").html(
                        $(".recentsessions").html() +
                        '<div class="structurehelper item' +
                        ((rawdt[1][i][1] === false) ? ' unactive' : '') +
                        '"><div class="structitem' +
                        ((rawdt[1][i][10] === false) ? ' hideme' : '') +
                        '"><div class="customif">!</div></div><div class="structitem"><p>' +
                        rawdt[1][i][11] +
                        '</p></div><div class="structitem"><p>' +
                        rawdt[1][i][3] +
                        '</p><div><p>' +
                        rawdt[1][i][2] +
                        '</p></div></div><div class="structitem"><p>' +
                        rawdt[1][i][4] +
                        '</p></div><div class="structitem"><p>' +
                        rawdt[1][i][5] +
                        '</p></div><div class="structitem"><p>' +
                        rawdt[1][i][6] +
                        '</p></div><div class="structitem"><p>' +
                        ((rawdt[1][i][7].length > 20) ? (rawdt[1][i][7].substr(0, 5) + '...' + rawdt[1][i][7].substr(-13)) : rawdt[1][i][7]) +
                        '</p></div><div class="structitem"><p>' +
                        rawdt[1][i][8] +
                        '</p></div><div class="structitem"><p>' +
                        rawdt[1][i][9] +
                        '</p></div><div class="structitem"><button onclick=\"details(' + rawdt[1][i][0] + ')\">More Details</button></div></div>'
                    );
                }
                $("#starttime1").html(rawdt[2][0]);
                $("#endtime1").html(rawdt[2][1]);
                $("#duration1").html(rawdt[2][2]);
                $("#starttime2").html(rawdt[2][10]);
                $("#endtime2").html(rawdt[2][11]);
                $("#duration2").html(rawdt[2][12]);
                let count = 11;
                for (let i = 3; i < rawdt[2].length; i++) {
                    if (i === 10) {
                        i = 13;
                        count = 21;
                    }
                    if (!rawdt[2][i]) {
                        $("#day" + count).addClass("dayoff");
                    }
                    count++;
                }

                for (let i = 0; i < rawdt[3].length; i++) {
                    $(".csessions").html(
                        $(".csessions").html() +
                        '<div class="structurehelper item' +
                        ((rawdt[3][i][1] === false) ? ' unactive' : '') + '"><div class="structitem"><p>' +
                        rawdt[3][i][3] + '</p></div><div class="structitem"><div><p>' +
                        rawdt[3][i][2] + '</p></div></div><div class="structitem"><p>' +
                        rawdt[3][i][4] + '</p></div><div class="structitem"><p>' +
                        rawdt[3][i][5] + '</p></div><div class="structitem"><p>' +
                        ((rawdt[3][i][1] === false) ? ' Unavailable' : 'Available') +
                        '</p></div><div class="structitem"><button class="btnicon" onclick="changeCustomSession(' + rawdt[3][i][0] +
                        ')"><div><span>Edit</span><img src="/assets/edit_property_26px.png" alt=""></div></button></div></div>'
                    )
                }

                for (let i = 0; i < rawdt[4].length; i++) {
                    $(".vouchers").html(
                        $(".vouchers").html() +
                        '<div class="structurehelper item' +
                        ((rawdt[4][i][1] === false) ? ' unactive' : '') + '"><div class="structitem"><p>' +
                        rawdt[4][i][2] + '</p></div><div class="structitem"><p>' +
                        rawdt[4][i][3] + '</p></div><div class="structitem"><p>' +
                        rawdt[4][i][4] + '</p></div><div class="structitem"><p>' +
                        rawdt[4][i][5] + '</p></div><div class="structitem"><p>' +
                        ((rawdt[4][i][1] === false) ? ' Unavailable' : 'Available') +
                        '</p></div><div class="structitem"><button class="btnicon" onclick="changeVoucher(' + rawdt[3][i][0] +
                        ')"><div><span>Edit</span><img src="/assets/edit_property_26px.png" alt=""></div></button></div></div>'
                    )
                }

                $(".main").removeClass("hideme");
                $("#loadingdiv").addClass("hideme");


            },
            error: function(data) {
                alert('There was an error was an error connecting to server. Please reload the page!');
            }
        });
    </script>
</body>

</html>