<?php 

	session_start();
	
	if(isset($_SESSION['userlogin'])){
		header("Location: admin.php");
	}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whyerd | Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
            font-family: "Roboto", sans-serif;
        }
        
        body {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .main {
            border-radius: 30px;
            background-color: #D0E8F0;
            padding: 40px;
        }
        
        .main h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        button {
            border-radius: 50px;
            padding: 15px 20px;
            margin: 10px 10px;
            cursor: pointer;
            background-color: #162E35;
            border: none;
            color: white;
            transition: all 0.2s ease-in-out;
            font-weight: bold;
        }
        
        button:hover {
            transform: scale(1.1);
        }
        
        p {
            width: 100%;
            text-align: center;
            margin-bottom: 5px;
            margin-top: 15px;
            font-size: 17px;
            font-weight: 700;
        }
        
        input {
            width: 100%;
            text-align: center;
            border-radius: 100px;
            padding: 5px;
            border: none;
            font-size: 23px;
            box-sizing: border-box;
            border: 3px solid #fff;
        }
        
        input:focus {
            border: 3px solid #162E35;
            outline: none;
        }
        
        .btnc {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="main">
        <h2>Login To Whyerd Admin</h2>
        <form action="">
            <p>Username:</p>
            <input type="username" name="username" id="username" required>
            <p>Password:</p>
            <input type="password" name="password" id="password" required>


        </form>
        <div class="btnc">
            <button type="button" name="loginbtn" id="loginbtn">LOGIN</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.min.js" integrity="sha512-szJ5FSo9hEmXXe7b5AUVtn/WnL8a5VofnFeYC2i2z03uS2LhAch7ewNLbl5flsEmTTimMN0enBZg/3sQ+YOSzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            $('#loginbtn').click(function(e) {
                var username = $('#username').val();
                var password = sha256($('#password').val());
                console.log(password);
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'admin/jslogin.php',
                    data: {
                        username: username,
                        password: password
                    },
                    success: function(data) {
                        if ($.trim(data) === "3") {
                            window.location.href = "admin.php";
                        } else if ($.trim(data) === "2") {
                            alert('Wrong password');
                        } else if ($.trim(data) === "1") {
                            alert('Wrong username');
                        } else if ($.trim(data) === "0") {
                            alert('There was an error was an error connecting to server. Please reload the page!');
                        } else {
                            console.log(data);
                        }
                        //console.log(data);
                    },
                    error: function(data) {
                        alert('Error');
                    }
                });


            });
        });
    </script>
</body>

</html>