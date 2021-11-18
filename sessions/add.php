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
        
        header {
            background-color: #D0E8F0;
            position: fixed;
            width: 100%;
            z-index: 10;
        }
        
        .headerbody {
            display: flex;
            max-width: 977px;
            margin: auto;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }
        .whitebtn {
            background-color: white;
            color: #162E35;
        }
        /*end globals*/
    </style>
</head>
<body>
    <header>
        <div class="headerbody">
            <div>
                <button onclick="location.href='/sessions.php'">See all Sessions</button>
            </div>
            <div>
                <h1>Whyerd Admin</h1>
            </div>
            <div>
                <button onclick="location.href='/logout.php'">Logout</button>
            </div>
        </div>
    </header>
    <h1>Add new sessions here</h1>
</body>