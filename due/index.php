<?php
    include '../config.php';
    include '../encoderDecoder.php';

    if(!isset($_COOKIE['name'])) {
        header("Location: ../");
        die();
    }

    function printDues($row, $courses, $completed) {

        $subject = $row['subject'];
        $staff = $row['staff'];
        $message = $row['title'];
        $timedate = $row['timedate'];
        $courseCode = substr($subject,0, 2) . substr($staff,0, 4);
        $dueid = $row['id'] . $courseCode;
        
        if (strpos($courses, $courseCode)  && !strstr($completed, $dueid)) {
            echo("<div class='chat_data comments'>");
                echo("<span class='username' style='display:flex;'>Subject: " . serverName($subject)); renderForm($dueid);echo("</span>"); 
                echo("<span class='username'>Staff: ". $staff . "</span>"); 
                echo("<span class='messagespan'><p class='message'>".$message."</p></span>");
                echo("<div class='tallheadpostert'><div class='timedate'><p class='time'>" . $timedate ."</p></div></br></div>");
            echo "</div>";
        }

    }

    function renderForm ($dueid) {
        $dueid = encodePrior($dueid);
        echo "
        <form action='index.php' method='GET'>
            <input type='hidden' name='dueid' value='".$dueid."'>
            <button type='submit' style='outline: none; border: 0px; background-color:transparent;'><i class='fas fa-check-circle' style='color: #0F9D58; font-size: 20px;'></i></button>
        </form>
        ";
    }

    function serverName ($subject) {
        if($subject == "DAA") {
            return "Design and Analysis of Algorithms";
        }elseif($subject == "CAA") {
            return "Computer Architecture";
        }elseif($subject == "OST") {
            return "Operating Systems";
        }elseif($subject == "ADS") {
            return "OOPS & ADS";
        }else if($subject == "OLA") {
            return "Operating Systems Lab";
        }else {
            return "OOPS & ADS Lab";
        }
    }

    $username = $_COOKIE['hello'];
    $password = $_COOKIE['ipaddress'];
    $username = decodePrior($username);
    $password = decodePrior($password);

    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE username= '$username' and password = '$password'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if($check_login_query == 1) {
        $row = mysqli_fetch_array($check_database_query);
        $name = $row['name'];
        $courses = $row['course'];
        $completed = $row['completed'];
        

        if(isset($_GET['dueid'])){
            $dueid = decodePrior($_GET['dueid']);
            $completed.=$dueid;
            echo $completed;
            $query = "UPDATE users SET completed='$completed' WHERE username ='$username' and password='$password'";
            if ($con->query($query) === TRUE) {
                header("Location: ./");
            }
            unset($_COOKIE['completed']);
            setcookie("completed", encodePrior($completed), time()+3600);
    
        }
    }
    else header("Location: ../");
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Due Schedules</title>
    
    <script src="https://kit.fontawesome.com/ab8c818c9d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" 
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body onload="if (location.protocol !== 'https:') {
                location.replace(`https:${location.href.substring(location.protocol.length)}`);
            }">
    <div class="wrapper">

        <div class="info">
            <div class="back">    
                <a href="../index.php" style="text-decoration: none;">
                    <i class="fas fa-arrow-circle-left" style="font-size: 35px;"></i>
                </a>
            </div>
            
            <div class="title">
               <h1 style="margin: 0 8%;">Due Schedule</h1>
            </div>
        </div>

        

        <div class = "priorHolder" id="priorHolder">
            <?php
                
                $query = "SELECT * FROM duetable ORDER BY id ASC"; 
                $run = $con->query($query); 
                while($row = $run->fetch_assoc()) {
                    printDues($row, $courses, $completed);
                }
            ?>
        </div>
        
    </div>

    <script src="../assets/loading/jquery.js"></script>
    <script src="../assets/loading/prettify.js"></script>
    <script src="../assets/loading/topbar.min.js"></script>
    <script>$(function(){prettyPrint();topbar.config({autoRun:!0,barThickness:10,barColors:{0:"rgba(26,  188, 156, .9)",".25":"rgba(52,  152, 219, .9)",".50":"rgba(241, 196, 15,  .9)",".75":"rgba(230, 126, 34,  .9)","1.0":"rgba(211, 84,  0,   .9)"},shadowBlur:10,shadowColor:"rgba(0,   0,   0,   .6)",className:"topbar"});topbar.show();setTimeout(function(){$("#main_content").fadeIn("slow");topbar.hide()},1500)});</script>

</body>
</html>