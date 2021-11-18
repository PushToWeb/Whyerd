<?php 
    session_start();
	if(!isset($_SESSION['userlogin'])){
		header("Location: /login.php");
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
        
        .hideme {
            display: none;
        }
        
        .whitebtn {
            background-color: white;
            color: #162E35;
        }
        /*end globals*/
        
        .session {
            display: flex;
            width: 100%;
            background-color: #D0E8F0;
            align-items: stretch;
            border-radius: 100px;
            padding: 3px;
            margin: 5px 0px;
            border: 2px solid #309F43;
            transition: all 0.2s ease-in-out;
            box-shadow: none;
        }
        
        .session:hover {
            transform: scale(1.005);
            box-shadow: 0 0 3px 1px rgb(121, 118, 118);
        }
        
        .unactive {
            border: 2px solid #A2283B;
        }
        
        .preview {
            display: flex;
            width: 100%;
            align-items: center;
            padding: 5px 0px;
        }
        
        .preview div {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0px 5px;
            border-right: #162E35 solid 1px;
            height: 100%;
            text-align: center;
        }
        
        .session button {
            width: 109px;
            float: right;
        }
        
        .preview div:nth-child(8) {
            border: none;
        }
        
        .preview div:nth-child(1) {
            width: 140px !important;
        }
        
        .preview div:nth-child(2) {
            width: 100px !important;
        }
        
        .preview div:nth-child(3) {
            width: 115px !important;
        }
        
        .preview div:nth-child(4) {
            width: 90px !important;
        }
        
        .preview div:nth-child(5) {
            width: 105px !important;
        }
        
        .preview div:nth-child(6) {
            width: 190px !important;
        }
        
        .preview div:nth-child(7) {
            width: 115px !important;
        }
        
        .head {
            background-color: white;
            margin-top: 30px;
            border: 2px solid white;
            padding: 0px 10px;
        }
        
        .head:hover {
            transform: scale(1);
            box-shadow: none;
        }
        
        #bsmainbody {
            padding: 0px 7px;
            height: 100px;
            height: calc(100vh - 235px) !important;
            overflow-x: visible;
            overflow-y: auto;
        }
        
        .active {
            border: solid #162E35 2px;
            background-color: #D0E8F0;
            color: #162E35;
        }
        
        #sbheader {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 55px;
            padding-left: 20px;
        }
        
        #addNew {
            float: right;
        }
        
        #loading h2 {
            width: 100%;
            text-align: center;
        }
        
        #sbb,
        #sbs {
            padding: 7px;
        }
        
        #sbheader img {
            height: 20px;
            width: auto;
            padding: 0px;
            margin: 0px;
            margin-left: 10px;
            display: none;
        }
        
        #sbheader div {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        #sbheader .sbheaderitem:nth-child(1) {
            min-width: 350px;
        }
        
        #sbheader .sbheaderitem:nth-child(2) {
            min-width: 270px;
        }
        
        #sbb.active img,
        #sbs.active img {
            display: block;
        }
        
        button div {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <header>
        <div class="headerbody">
            <div class="menu">
                <button onclick="location.href='/admin.php'">Back to Dashboard</button>
            </div>
            <div>
                <h1>Whyerd Admin</h1>
            </div>
            <div class="logoutfromadmin">
                <button onclick="location.href='/logout.php'">Logout</button>
            </div>
        </div>
    </header>

    <div id="loading" class="main">
        <h2>Loading...</h2>
    </div>
    <div class="main hideme">
        <div>
            <div id="sbheader">
                <div class="sbheaderitem">
                    <p>Short by:</p>
                    <button id="sbb"><div><p>date of booking</p><img src="/assets/checked_26px.png"></div></button>
                    <button id="sbs"><div><p>date of session</p><img src="/assets/checked_26px.png"></div></button>

                </div>
                <div class="sbheaderitem">

                    <button>Show all</button>
                    <button>Hide canceled</button>

                </div>
                <div id="addNew" class="sbheaderitem">
                    <button onclick="location.href='/sessions/add.php'">Add New Booking Session Manually</button>
                </div>
            </div>

            <div class="session head">
                <div class="preview">
                    <div>
                        <p>Date of booking</p>
                    </div>
                    <div>
                        <p>Date of session</p>
                    </div>
                    <div>
                        <p>Time</p>
                    </div>
                    <div>
                        <p>Voucher</p>
                    </div>
                    <div>
                        <p>Name</p>
                    </div>
                    <div>
                        <p>Main Email</p>
                    </div>
                    <div>
                        <p>Phone Number</p>
                    </div>
                    <div>
                        <p>Team</p>
                    </div>
                </div>

            </div>
            <div id="bsmainbody">
                <div id="bsmain"></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js" integrity="sha512-szJ5FSo9hEmXXe7b5AUVtn/WnL8a5VofnFeYC2i2z03uS2LhAch7ewNLbl5flsEmTTimMN0enBZg/3sQ+YOSzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        getbookedsessions(0)
        $("#sbs").addClass("active");


        $("#sbb").click(function() {
            if ($("#sbb").attr("class") !== "active") {
                getbookedsessions(1);
                $("#sbb").addClass("active");
                $("#sbs").removeClass("active");
            }
        });
        $("#sbs").click(function() {
            if ($("#sbs").attr("class") !== "active") {
                getbookedsessions(0);
                $("#sbs").addClass("active");
                $("#sbb").removeClass("active");
            }
        });

        function details(id) {
            location.href = "/sessions/details.php?id=" + id;
        }

        function getbookedsessions(short) {
            $.ajax({
                type: 'POST',
                url: '/interact.php',
                data: {
                    m: 1,
                    s: short,
                    c: 0
                },
                success: function(data) {
                    rawdt = jQuery.parseJSON(data);
                    console.log(rawdt);
                    $("#bsmain").html("");
                    for (let i = 0; i < rawdt.length; i++) {
                        $("#bsmain").html(
                            $("#bsmain").html() +
                            '<div class="session' + ((rawdt[i][1] === false) ? ' unactive' : '') + '"><div class="preview"><div><p>' + rawdt[i][5] +
                            '</p></div><div><strong><p>' + rawdt[i][2] +
                            '</p></strong></div><div><strong><p>' + rawdt[i][3] +
                            '</p></strong></div><div><p>' + rawdt[i][4] +
                            '</p></div><div><p>' + rawdt[i][6] +
                            '</p></div><div><p>' + ((rawdt[i][7].length > 20) ? (rawdt[i][7].substr(0, 5) + '...' + rawdt[i][7].substr(-13)) : rawdt[i][7]) +
                            '</p></div><div><p>' + rawdt[i][8] + '</p></div><div><p>' + rawdt[i][9] +
                            '</p></div></div><button onclick=\"details(' + rawdt[i][0] + ')\">More Details</button></div>'
                        )
                        $(".main").removeClass("hideme");
                        $("#loading").addClass("hideme");

                    }
                },
                error: function(data) {
                    alert('There was an error was an error connecting to server. Please reload the page!');
                }
            });
        }
    </script>
</body>

</html>