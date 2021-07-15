<?php

    if(isset($_COOKIE['name'])) {
        header("Location: index.php");
    }
    else {

        include 'config.php';
        include 'encoderDecoder.php';

        if(mysqli_connect_errno()) 
        {
            echo "Failed to connect: " . mysqli_connect_errno();
        }

        if(isset($_POST['login_button'])) {

            $username = $_POST['username']; //Get username
            $password = $_POST['password'];
            
            $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE username= '$username' and password = '$password'");
            $check_login_query = mysqli_num_rows($check_database_query);

            if($check_login_query == 1) {
                $row = mysqli_fetch_array($check_database_query);
                $name = $row['name'];
                $isMod = $row['ismod'];
                $completed = $row['completed'];
                
                $name = encodePrior($name);
                $isMod = encodePrior($isMod);
                $dark = encodePrior($dark);
                $username = encodePrior($username);
                $password = encodePrior($password);

                setcookie("hello", $username, time()+3600);
                setcookie("ipaddress", $password, time()+3600);
                            
                setcookie("name", $name , time()+3600);
                setcookie("ismod", $isMod, time()+3600);
                setcookie("dark", 0, time()+3600);

                header("Location: ./");
                exit();
            }
            else {
                echo "Incorrect username or password!";
            }
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel='shortcut icon' href='assets/images/p.png' type='image/x-icon' />
</head>
<body>

    <div class="wrapper indexPage">
        <div class="mainSection">
            <div class="logoContainer"><br>
			<a href = "#"><img src="assets/images/prior.png" title="Proof! Logo" alt="Site Logo"/></a>
		</div>
            <div class="searchContainer">
                 <form action="login.php" method="POST">
                    <input class="searchBox" type="text" name="username" placeholder="Username" required autofocus>
                    <br>
                    <input class="searchBox" type="text" name="password" placeholder="Password" required>
                    <br>
                    <input class="searchButton" type="submit" name="login_button" value="Login">
                    <br>
                </form>		
            </div>
        </div>       
    </div>

    <script src="assets/loading/jquery.js"></script>
    <script src="assets/loading/prettify.js"></script>
    <script src="assets/loading/topbar.min.js"></script>
    <script>$(function(){prettyPrint();topbar.config({autoRun:!0,barThickness:10,barColors:{0:"rgba(26,  188, 156, .9)",".25":"rgba(52,  152, 219, .9)",".50":"rgba(241, 196, 15,  .9)",".75":"rgba(230, 126, 34,  .9)","1.0":"rgba(211, 84,  0,   .9)"},shadowBlur:10,shadowColor:"rgba(0,   0,   0,   .6)",className:"topbar"});topbar.show();setTimeout(function(){$("#main_content").fadeIn("slow");topbar.hide()},1500)});</script>
</body>
</html>