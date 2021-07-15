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
                 <form action="changeName.php" method="POST">
                    <input class="searchBox" type="text" name="newName" placeholder="Enter a New Name:" required autofocus>
                    <br>
                    <input class="searchButton" type="submit" name="login_button" value="Change Name">
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
        <center><h1>Name Changed Successfully.</h1></center>
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
        $new = $_POST['newName'];

        $result = mysqli_query($con, "UPDATE users SET name = '$new' WHERE username= '$username'");

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

