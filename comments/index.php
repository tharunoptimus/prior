<?php

    include '../encoderDecoder.php';
    include '../config.php';
    include "..//assets/Mobile_Detect.php";
    $detect = new Mobile_Detect();
    $is_mobile=($detect->isMobile());
    $formUsername = $_COOKIE['hello'];
    $username = decodePrior($_COOKIE['hello']);

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
    $successMessage = 0;

    function time_Ago($time) { /* https://is.gd/iSeYr8 */
		$diff    = time() - $time;$sec = $diff;$days= round($diff / 86400 );$weeks= round($diff / 604800);$min = round($diff / 60 );
		$hrs = round($diff / 3600);$mnths= round($diff / 2600640 ); $yrs= round($diff / 31207680 );$wanted_time = 0;
		if($sec <= 60) { echo "$sec seconds ago";return $sec . " seconds ago";} 
		else if($min <= 60) { if($min==1) { echo "1 minute ago";return "1 minute ago";} else { echo "$min minutes ago";return $min . " minutes ago";} } 
		else if($hrs <= 24) { if($hrs == 1) {echo "an hour ago";return "An hour ago";} else {echo "$hrs hours ago";return $hrs . " hours ago";} } 
		else if($days <= 7) { if($days == 1) {echo "Yesterday";return "Yesterday";} else {echo "$days days ago";return $days . " days ago";} } 
		else if($weeks <= 4.3) { if($weeks == 1) {echo "A week ago";return "A week ago";} else { echo "$weeks weeks ago";return $weeks . " weeks ago";} } 
		else if($mnths <= 12) { if($mnths == 1) { echo "A month ago";return "A month ago";} else { echo "$mnths months ago";return $mnths . " months ago";}} 
		else { if($yrs == 1) { echo "One year ago";return "One year ago";} else { echo "$yrs years ago";return $yrs . " years ago";} } 
	} 

    if(isset($_GET['roomid'])) {
        $commentid = $_GET['roomid'];
        $commentTable = "comment" . $commentid;

        $username = $_COOKIE['hello'];
        $password = $_COOKIE['ipaddress'];
        $username = decodePrior($username);
        $password = decodePrior($password);

        $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE username= '$username' and password = '$password'");
        $check_login_query = mysqli_num_rows($check_database_query);

        $query = mysqli_query($con, "SELECT * FROM prior WHERE id = '$commentid'");
        $row = mysqli_fetch_array($query);
        $hostName = $row['name'];
        $hostMessage = $row['message'];
        $hosttime = $row['timedate'];

        if($check_login_query == 1) {
            $row = mysqli_fetch_array($check_database_query);
            $username = $row['username'];
            $name = $row['name'];

            if(isset($_GET['message'])) {
                if($username == decodePrior($_GET['cookieuser'])) {
                    $comment = $_GET['message'];
                    $query = "INSERT INTO comments (priorid, username, name, message, timedate) VALUES ('$commentid', '$username', '$name', '$comment', '$date')";
            
                    if ($con->query($query) === TRUE) {
                        $successMessage = 1;
                    }
                }
            }   
        }
    }
    else {
        #pass
    }


?>

<?php 

    $displayStyleWhenSuccess = '
        .modal {
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    ';

    $modalDivWhenSuccess = '
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <br>
                <center>  
                    <p style="text-align: center;">Your Comment was posted Successfully!</p>
                    <button onclick = "closeModal()" class="searchButton"  style="font-size: 17px;">OK</button>
                </center>
            </div>
        </div>
    ';

    $scriptWhenSuccess = '

        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        const closeModal = () => {
            modal.style.display = "none";
            window.location.href="index.php?roomid=' . $commentid . '";
        }

        span.onclick = function() {
            modal.style.display = "none";
            window.location.href="index.php?roomid=' . $commentid . '";
        }

        ';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment</title>

    <script src="https://kit.fontawesome.com/ab8c818c9d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    <?php if($successMessage) echo '<style>' . $displayStyleWhenSuccess . '</style>'; ?>
    
    <link rel="stylesheet" href="../assets/css/important.css">
    <link rel="stylesheet" href="../mod/prior/assets/css/style.css">
    <link rel="stylesheet" href="../mod/prior/assets/css/checkbox.css">
    <link rel="stylesheet" href="style.css">

    <style>
        .ck.ck-editor {
            max-width: 100;
            height: 200;
        }
    </style>
    
</head>
<body onload="if (location.protocol !== 'https:') {
                location.replace(`https:${location.href.substring(location.protocol.length)}`);
            }">

    <div class="wrapper">

        <div class="info">
            <div class="back">    
                <a href="../" style="text-decoration: none;">
                    <i class="fas fa-arrow-circle-left" style="font-size: 35px;"></i>
                </a>
            </div>
            
            <div class="title">
            <h1 style="margin: 0 8%;">Comment</h1>
            </div>
        </div>

        <div class="mainContent">


            <div class="rainbow hostMessage">
                <span class="usernmae">
                    <?php echo $hostName; ?>
                </span>
                <span class="messagespan">
                    <?php echo $hostMessage; ?>
                </span>
                <div class="tallheadpostert">
                    <div class="timedate">
                        <p class="time"><?php echo $hosttime; ?></p>
                    </div>
                </div>

            </div>

            <input class="searchButton commentmenu" id="commentmenu" onclick="showCommentBox()" type="button" value="Show Comment Box">
            <div class="chat_data" id="postComment" style="display: none;">
                <div class="formContainer">
                    <form method="GET" action="index.php">
                        <textarea class="textBox" id="editor" name="message" placeholder='Post your comment:'></textarea>
                        <input type="hidden" name="cookieuser" value="<?php echo $formUsername; ?>">
                        <input type="hidden" name="roomid" value="<?php echo $commentid; ?>">
                        <center>                        
                            <input class="searchButton" type="submit" name="submit" value="Comment">
                        </center>
                    </form>
                </div>
            </div>

            <div class = "priorHolder" id="priorHolder">
                <?php
                    
                    $query = "SELECT * FROM comments WHERE priorid = '$commentid' ORDER BY id DESC"; 
                    $run = $con->query($query); 
                    while($row = $run->fetch_assoc()) {

                        echo("<div class='chat_data comments'>");
                        echo("<span class='username'>"); echo $row['name']; echo(" : </span>"); 
                        echo("<span class='messagespan'><p class='message'>");$str = $row['message'];
                        $rpl="</a>&nbsp;<img src='assets/images/redirect.png' style='width: 16px;'>";
                        $str = str_replace("</a>", $rpl, $str); echo $str;
                        echo("</p>
                            </span>
                            <div class='tallheadpostert'>
                                <div class='timedate'>
                                    <p class='time'>");
                                        $curr_time = $row['timedate'];
                                        $time_ago = strtotime($curr_time); 
                                        $help=time_Ago($time_ago); 
                                        if (strstr($help, "day")){
                                            if(strstr($help, "Yesterday")){
                                                echo " at " . substr($curr_time, 11);
                                            }
                                            else{
                                                echo ".&nbsp;Date: $curr_time";
                                            }
                                        }
                                        elseif(strstr($help, "week") || (strstr($help, "month") || (strstr($help, "year")))){
                                            echo ".&nbsp;Date: $curr_time";
                                        }
                                    echo("</p>
                                </div>
                                </br>
                            </div>
                        </div>");
                    }
                ?>
            </div>

        </div>

    </div>

    

    <script type="text/javascript">
        var btn = document.getElementById('commentmenu');
        var commentBox = document.getElementById('postComment');
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

        //document.getElementById('button').innerHTML
        const showCommentBox = () => {
            if(commentBox.style.display !== "block") {
                commentBox.style.display = "block";
                btn.value = "Hide Comment Box";
            }
            else {
                commentBox.style.display = "none";
                btn.value = "Show Comment Box";
            }

        }
    </script>

    <?php if($successMessage) echo $modalDivWhenSuccess; ?>
    <?php if($successMessage) echo '<script>' .  $scriptWhenSuccess . '</script>'; ?>

    <script src="../assets/loading/jquery.js"></script>
    <script src="../assets/loading/prettify.js"></script>
    <script src="../assets/loading/topbar.min.js"></script>
    <script>$(function(){prettyPrint();topbar.config({autoRun:!0,barThickness:10,barColors:{0:"rgba(26,  188, 156, .9)",".25":"rgba(52,  152, 219, .9)",".50":"rgba(241, 196, 15,  .9)",".75":"rgba(230, 126, 34,  .9)","1.0":"rgba(211, 84,  0,   .9)"},shadowBlur:10,shadowColor:"rgba(0,   0,   0,   .6)",className:"topbar"});topbar.show();setTimeout(function(){$("#main_content").fadeIn("slow");topbar.hide()},1500)});</script>

</body>
</html>