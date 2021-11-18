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
            display: flex;
            max-width: 977px;
            margin: auto;
            position: relative;
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
            border-radius: 15px;
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
        .whitebtn {
            background-color: white;
            color: #162E35;
        }
        /*end globals*/
        
        .box {
            border-radius: 20px;
            padding: 15px;
            margin: 10px;
            background-color: #D0E8F0;
            transition: all 0.2s ease-in-out;
            box-shadow: none;
        }
        
        .box:hover {
            transform: scale(1.02);
            box-shadow: 0 0 3px 1px #D0E8F0;
        }
        
        .display-block {
            display: block;
        }
        
        .alignicenter {
            text-align: center;
        }
        
        .flexxcol {
            width: 50%;
        }
        
        .box span {
            font-weight: bold;
        }
        
        .box h4 {
            width: 100%;
            text-align: center;
        }
        
        #loading h2 {
            width: 100%;
            text-align: center;
        }
        
        .hideme {
            display: none;
        }
        
        #details {
            padding-top: 80px;
        }
        
        #teamdiv {
            margin-top: 70px;
            padding-top: 10px;
            height: calc(100vh - 70px) !important;
            overflow: auto;
        }
    </style>
</head>

<body>
<header>
        <div class="headerbody">
            <div class="menu">
                <button onclick="location.href='/sessions.php'">See all Sessions</button>
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

        <div class="flexxcol" id="details">
            <div class="alignicenter">
                <h2>Session Details</h2>
            </div>
            <div class="box">

                <p>Session Date: <span id="sDate">Loading...</span></p>
                <p>Session Start: <span id="sStart">Loading...</span></p>
                <p>Session End: <span id="sEnd">1Loading...</span></p>
                <p>Status: <span id="sStatus">Loading...</span></p>
                <p>Booked: <span id="bDate">Loading...</span></p>
                <p>Voucher used: <span id="sVoucher">Loading...</span></p>
            </div>
            <div class="box">
                <p>Firstname:<span id="fName">BLoading...</span></p>
                <p>Lastname: <span id="lName">Loading...</span></p>
                <p>Email: <span id="email">Loading...</span></p>
                <p>Sex: <span id="sex">Loading...</span> </p>
                <p>Birth: <span id="birth">Loading...</span></p>
                <p>Phone: <span id="phone">Loading...</span></p>
            </div>
            <div class="box">
                <p>Message: <br><span id="message">Loading...</span></p>

            </div>
        </div>
        <div class="flexxcol" id="teamdiv">
            <div class="alignicenter">
                <h2>Team</h2>
            </div>
            <div id="teamMembers">

            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js" integrity="sha512-szJ5FSo9hEmXXe7b5AUVtn/WnL8a5VofnFeYC2i2z03uS2LhAch7ewNLbl5flsEmTTimMN0enBZg/3sQ+YOSzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // (A) GET THE PARAMETERS
        var params = new URLSearchParams(window.location.search);

        id = params.get("id");
        if (id === null) {
            location.href = "/admin.php";
        }
        console.log(id);
        $.ajax({
            type: 'POST',
            url: '/interact.php',
            data: {
                m: 2,
                i: id
            },
            success: function(data) {
                rawdt = jQuery.parseJSON(data);
                console.log(rawdt);
                $("#sDate").html(rawdt[0]);
                $("#sStart").html(rawdt[1]);
                $("#sEnd").html(rawdt[2]);
                $("#sStatus").html(rawdt[3]);
                $("#bDate").html(rawdt[4]);
                $("#sVoucher").html(rawdt[5]);
                $("#fName").html(rawdt[6]);
                $("#lName").html(rawdt[7]);
                $("#email").html(rawdt[8]);
                $("#sex").html(rawdt[9]);
                $("#birth").html(rawdt[10]);
                $("#phone").html(rawdt[11]);
                $("#message").html(rawdt[12]);

                $("#teamdiv .alignicenter h2").html('Team(' + rawdt[13] + ' members)');
                for (let i = 0; i < rawdt[14].length; i++) {
                    $("#teamMembers").html(
                        $("#teamMembers").html() +
                        '<div class="box"><h4>Member ' + (i + 1) +
                        '</h4><p>Firstname: <span>' + rawdt[14][i][0] +
                        '</span></p><p>Lastname: <span>' + rawdt[14][i][1] +
                        '</span></p><p>Email: <span>' + rawdt[14][i][2] +
                        '</span></p><p>Sex: <span>' + rawdt[14][i][3] +
                        '</span></p><p>Birth: <span>' + rawdt[14][i][4] + '</span></p></div>'

                    );

                }
                $(".main").removeClass("hideme");
                $("#loading").addClass("hideme");
            },
            error: function(data) {
                alert('There was an error was an error connecting to server. Please reload the page!');
            }
        });
    </script>
</body>