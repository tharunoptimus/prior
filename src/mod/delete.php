<?php

    session_start(); 
    $check = $_SESSION['sname'];
    if($check == ""){
        header("Location: index.php");
        exit(); //Prevent Unauthorized Entry
    }

	require 'db.php'; //Connect to DB
    date_default_timezone_set('Asia/Kolkata'); //Set Server Time Zone
	$date = date('Y-m-d H:i:s');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Your Message!</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site to Input the Message to view in Prior">
    <meta name="keywords" content="prior">
    <meta name="author" content="Developed by Privacy Defenders  - tharunoptimus ">
    
	<link rel="stylesheet" type="text/css" href="assets/css/indexstyle.css">
    <link rel="stylesheet" type="text/css" href="assets/css/delete.css">
    <link rel='shortcut icon' href='/assets/images/p.png' type='image/x-icon' />
    <link rel="stylesheet" type="text/css" href="assets/css/importanttext.css">

</head>
<body>

    <div class="wrapper indexPage">

        <div class="mainSection">

            <div class="logoContainer">
                <br><br>
                <img src="assets/images/delete.gif" title="Delete" alt="delete" style="border-radius: 10px; border: 2px solid #FF814C"/><br><br><br>		
            </div>

            <div class="searchContainer">
                 <form action="deleted.php" method="POST">
                    <input class="searchBox" type="text" name="m_id" placeholder="Enter ID of your message:" required autofocus>
                    <br>
                    <input class="searchButton" type="submit" name="delete" value="Delete!">
                    <br>
                </form>		

            </div>
        </div>

        <div class="information">
            <center><h4>Enter the ID of the Message you wish to delete.</h4></center><br><center><h5>The Yellow colored number at the bottom right corner of the message is the ID of the corresponding message.</h5></center>
        </div>   

    </div>

    <?php    
    $query = "SELECT * FROM announcement WHERE name = '$check' ORDER BY id DESC"; 
    $run = $con->query($query); 
    while($row = $run->fetch_array()) : ?>
        <div class="<?php $priority = $row['important']; 
        if($priority){
            echo "rainbow";
        }
        else echo "chat_data"; ?>">

        <span class="username"><?php echo $row['name']; ?> : </span>
        <span class="messagespan"><p class="message"><?php  $str = $row['message'];
                    $rpl="</a>&nbsp;<img src='redirect.png' style='width: 16px;'>";
                    $str = str_replace("</a>", $rpl, $str); echo $str;
                    ?></p></span>
        <div class="tallheadpostert">

            <div class="timedate">
                <p class="time"><?php
                                    $curr_time = $row['timedate'];
                                    $time_ago = strtotime($curr_time); 
                                    $help=time_Ago($time_ago); 
                                        if (strstr($help, "day")){
                                            if(strstr($help, "Yesterday")){
                                                echo " at " . substr($curr_time, 11);
                                            }
                                            else{
                                            echo " &emsp; Date-Time: $curr_time";
                                            }
                                        }
                                        elseif(strstr($help, "week") || (strstr($help, "month") || (strstr($help, "year")))){
                                            echo "  Date-Time: $curr_time";
                                        }
                                    ?></p>
            </div>
            <div class="timedated">
                <p class="timed"><?php echo $row['id']; ?></p>
            </div>
        </div>
    </div><?php endwhile; ?>

</body>
</html>

<?php 

    function time_Ago($time){

        $diff = time() - $time;
        $sec = $diff;
        $days= round($diff / 86400 );
        $weeks= round($diff / 604800);
        $min = round($diff / 60 );
        $hrs = round($diff / 3600);
        $mnths= round($diff / 2600640 );
        $yrs= round($diff / 31207680 );
        $wanted_time = 0;
        if($sec <= 60){ 
            echo "$sec seconds ago";
            return $sec . " seconds ago";
        } 
        elseif($min <= 60){ 
            if($min==1){ 
                echo "1 minute ago";
                return "1 minute ago";
            } 
            else{ 
                echo "$min minutes ago";
                return $min . " ";
            }
        } 
        elseif($hrs <= 24){ 
            if($hrs == 1){
                echo "an hour ago";
                return "An hour ago";
            }
            else{
                echo "$hrs hours ago";
                return $hrs . " hours ago";
            }
        } 
        elseif($days <= 7){ 
            if($days == 1){
                echo "Yesterday";
                return "Yesterday";
            } 
            else{
                echo "$days days ago";
                return $days . " days ago";
            } 
        } 
        elseif($weeks <= 4.3){ 
            if($weeks == 1){
                echo "A week ago";
                return "A week ago";
            } 
            else{ 
                echo "$weeks weeks ago";
                return $weeks . " weeks ago";
            }
        } 
        elseif($mnths <= 12){ 
            if($mnths == 1){ 
                echo "A month ago";
                return "A month ago";
            }
            else{ 
                echo "$mnths months ago";
                return $mnths . " months ago";
            }
        } 
        else{ 
            if($yrs == 1){ 
                echo "One year ago";
                return "One year ago";
            } 
            else{ 
                echo "$yrs years ago";
                return $yrs . " years ago";
            }
        } 
    } 

?>