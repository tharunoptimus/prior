<?php

	session_start(); 
	$name = $_SESSION['sname'];
	$username = $_SESSION['usernamed'];

	if($username = ""){
	    header("Location: index.php");
	    die();  //Prevent Unauthorized entry
	}

	require 'db.php'; //Connect to DB

    date_default_timezone_set('Asia/Kolkata'); //Set Server Time Zone
	$date = date('Y-m-d H:i:s');

    if(isset($_POST['submit'])){

        $name = $name;
        $message = $_POST['enter_message'];
        $message = mysqli_real_escape_string($con, $message);  //Escape Potentially Harmful SQL Scripts

       if( empty($_POST["important"]) ) {

			$query = $con->prepare("INSERT INTO announcement (username,name,message,timedate) VALUES (?, ?, ?, ?)");
			$query->bind_param('ssss', $usernames, $named, $messaged, $timedated);
            $usernames = $username;
			$named = $name;
			$messaged = $message;
			$timedated = $date;
			$query->execute(); //Execute Prepared Statement

		}
		else{

			$query = $con->prepare("INSERT INTO announcement (username,name,message,timedate,important) VALUES (?, ?, ?, ?, ?)");
			$query->bind_param('ssssi', $usernames, $named, $messaged, $timedated, $important);

            $usernames = $username;
			$named = $name;
			$messaged = $message;
			$timedated = $date;
			$important = 1;
            $query->execute(); //Execute Prepared Statement

		}

        header("Location: success.html"); //Prior Made-> Redirecting to Success Page.
        exit();
    }
    else{
        header("Location: index.php");  //Something Failed. Possibly a SQL Injection or SQL Overload
        die();
    }

?>