<?php
include 'userConfig.php';
session_start(); 
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');

if(mysqli_connect_errno()) 
{
    echo "Failed to connect: " . mysqli_connect_errno();
}

if(isset($_POST['login_button'])) {

    $userID = $_POST['newUserID'];
    $username = $_POST['newUserName'];
    $query = "INSERT INTO users (name,username) VALUES ('$username', '$userID')";
    if (!mysqli_query($con, $query)) {
        echo ("Failed to Insert New User!!!");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Prior Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site to Input the Message to view in Prior">
	<meta name="keywords" content="prior, priorm, proof">
	<link rel="stylesheet" type="text/css" href="assets/css/indexstyle.css">
    <link rel='shortcut icon' href='assets/images/p.png' type='image/x-icon' />
    <script type="text/javascript" src="assets/js/keyscript.js"></script>
</head>
<body>

    <div class="wrapper indexPage">
        <div class="mainSection">
            <div class="logoContainer"><br>
			<a href = "#"><img src="assets/images/priorm.jpg" title="Proof! Logo" alt="Site Logo"/></a>
		</div>
            <div class="searchContainer">
                 <form action="index.php" method="POST">
                    <input class="searchBox" type="text" name="newUserName" placeholder="User Name" required autofocus >
                    <br>
                    
                    <input class="searchBox" type="text" name="newUserID" placeholder="User PIN" required autofocus >
                    <br>

                    <input class="searchButton" type="submit" name="login_button" value="Create New User">
                    <br>
                </form>		
            </div>
        </div>       
    </div>
</body>
</html>