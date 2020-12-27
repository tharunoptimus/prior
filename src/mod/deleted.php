<?php

    session_start(); 
    $check = $_SESSION['sname'];
    if($check == ""){
        header("Location: index.php");
        exit(); //Prevents Unauthorized Entry
    }

	require 'db.php'; //Call to DB

    if(isset($_POST['delete'])){

        $name = $check;
        $message_id = $_POST['m_id'];
        $message_id = mysqli_real_escape_string($con, $message_id); //Escapes Potential SQL Scripts

        $check_database_query = mysqli_query($con, "SELECT * FROM announcement WHERE id='$message_id' AND name= '$name'");
    	$check_id_query = mysqli_num_rows($check_database_query);
        if($check_id_query == 0) {
            header("Location: index.php");
            die();
        }
    	if($check_id_query == 1) {
			$query = "DELETE FROM announcement WHERE id='$message_id'AND name= '$name'";
			$run = $con->query($query);
		}
        header("Location: deleted.html");
        exit(); 

    }
    else{
    	header("Location: index.php"); //Entered unauthorized number
    	die();
    }

?>