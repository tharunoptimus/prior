<?php
    session_start(); 
    require 'db.php';  
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

    if(mysqli_connect_errno()) 
    {
        echo "Failed to connect: " . mysqli_connect_errno();
    }

    if(isset($_POST['login_button'])) {

        $username = $_POST['log_uid']; //Get username
        if(preg_match('/[^a-z_\-0-9]/i', $username)){
            header("Location: redirect.html");
            die();
        }
        else{
            $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");  //Check for the user
            $check_login_query = mysqli_num_rows($check_database_query);  //Get the number of rows corresponding with the WHERE condition
            if($check_login_query == 1) {
                $row = mysqli_fetch_array($check_database_query);
                $name = $row['name'];
                                 
                // Store the submitted data sent 
                // via POST method, stored  
                  
                // Temporarily in $_POST structure. 
                $_SESSION['sname'] = $name; 
                $_SESSION['usernamed'] = $username;

                header("Location: loginsuccess.php");
                exit();
            }
            else {
                header("Location: redirect.php");
            }
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>PriorM! Login</title>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site to Input the Message to view in Prior">
	<meta name="keywords" content="prior">
	<meta name="author" content="Developed by Privacy Defenders  - tharunoptimus">

	<link rel="stylesheet" type="text/css" href="assets/css/indexstyle.css">
    <link rel='shortcut icon' href='p.png' type='image/x-icon' />

    <script type="text/javascript" src="assets/js/keyscript.js"></script>
    <script>
            function load(){  //Tell user to use chromium browsers for better interface.
                var userAgent = navigator.userAgent.toLowerCase(); 
                if (userAgent .indexOf('safari')==1){ 
                    alert('You are using Safari! This webpage is best viewed with FireFox or Chromium Browsers');
                }
            }
    </script>

</head>

<body onload="load();">

    <div class="wrapper indexPage">
        
        <div class="mainSection">
            
            <div class="logoContainer">
                <br>
                <a href = "bypd.html"><img src="assets/images/priorm.jpg" title="Proof! Logo" alt="Site Logo"/></a>
            </div>
            
            <div class="searchContainer">
                <form action="index.php" method="POST">
                    <input class="searchBox" type="text" name="log_uid" placeholder="User PIN" required autofocus pattern="[a-zA-Z0-9]+" maxlength="20" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;" onpaste="return false; ">
                    <br>
                    <span id="error" style="color: Red; display: none"><center>Special Characters are not allowed</center></span>
                    <input class="searchButton" type="submit" name="login_button" value="Login">
                    <br>
                </form>		

            </div>

        </div>

        <div class="information">
            <center><h4>Login To Continue to send Messages!</h4><br><p align="center" class="headertab" font-family="jamun">Developed for the students of IT MIT by <a href = "https://privacydefenders.bss.design">Privacy Defenders (NR)</a>&emsp;</p></center>
        </div>  

    </div>

</body>

</html>