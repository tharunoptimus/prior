<?php
session_start();

$fullString = '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/images/p.png" type="image/x-icon" />
    </head>
    <body>

    <div class="wrapper indexPage">
        <div class="mainSection">
            <div class="logoContainer"><br>
			<a href = "#"><img src="../assets/images/prior.png" title="Proof! Logo" alt="Site Logo"/></a>
		</div>
            <div class="searchContainer">
                 <form action="changePassword.php" method="POST">
                    <input class="searchBox" type="text" name="old" placeholder="Old Password" required autofocus>
                    <br>
                    <input class="searchBox" type="text" name="new" placeholder="New Password" required>
                    <br>
                    <input class="searchButton" type="submit" name="login_button" value="Change Password">
                    <br>
                </form>		
            </div>
        </div>       
    </div>
</body>
</html>';

$complete = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Changed Successfully</title>
        <meta http-equiv="refresh" content="1;url=index.php" />
    </head>
    <body>
        <center><h1>Password Changed Successfully.</h1></center>
    </body>
</html>';


    include '../config.php';
    include '../encoderDecoder.php';

    if(mysqli_connect_errno()) 
    {
        echo "Failed to connect: " . mysqli_connect_errno();
    }

    if(isset($_POST['login_button'])) {

        if(!isset($_SESSION['username'])) { header("Location: index.php"); }
        $username = $_SESSION['username'];

        $old = $_POST['old']; //Get username
        $new = $_POST['new'];

        $result = mysqli_query($con, "UPDATE users SET password = '$new' WHERE username= '$username'");

        echo $complete;
    }

    if(isset($_POST['requestAccess'])) {

        $username = $_POST['username']; //Get username
        $password = $_POST['password'];
        
        $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE username= '$username' and password = '$password'");
        $check_login_query = mysqli_num_rows($check_database_query);

        if($check_login_query == 1) {
            $_SESSION['username'] = $username;
            echo $fullString;
        }
        else {
            header("Location: index.php");
        }
    }
?>

