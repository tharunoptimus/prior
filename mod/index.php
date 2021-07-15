<?php //User is Genuine $genuineMod  = encodePrior($username . $password);
    include '../encoderDecoder.php';
    include '../config.php';

    $username = $_COOKIE['hello'];
    $password = $_COOKIE['ipaddress'];
    $name = $_COOKIE['name'];
    $isMod = $_COOKIE['ismod'];

    $username = decodePrior($username);
    $password = decodePrior($password);
    $name = decodePrior($name);
    $isMod = decodePrior($isMod);

    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE username= '$username' and password = '$password'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if($check_login_query == 1) {
        $row = mysqli_fetch_array($check_database_query);
        $disMod = $row['ismod'];
        $dname = $row['name'];

        if($name != $dname or $disMod != $isMod) {
            header("Location: ../index.php");
            die();
        }
    }
    else {
        header("Location: ../index.php");
        die();
    }

    $genuineMod = $username;
    $genuineMod = encodePrior(encodePrior($genuineMod));
    setcookie('gmod', $genuineMod, time()+3600);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mod Place</title>

    <script async src="../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../assets/fontAwesome/style.css">
    
    <link rel="stylesheet" href="style.css">

    <style>

        .cardHolder {
        display: flex;
        flex-direction: column;
        align-items: center;
        }

        .card {
        box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%);
        transition: 0.3s;
        width: 80%;
        margin: 5% 2px;
        border-radius: 15px;
        padding-top: 10px;
        }

        .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .container {
        padding: 2px 16px;
        }

        .back {
        display: flex;
        flex-direction: column;
        justify-content: center;

        }

        .info {
        display: flex;
        margin: 2% 2%;
        }

        .cardAnchor {
        text-decoration: none;
        }

        .logoHolder {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        }

        .icon {
            font-size: 90px;
        }
    </style>
    
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
               <h1 style="margin: 0 8%;">Mod Place</h1>
            </div>
        </div>


        <div class="cardWrapper">

            <div class="cardHolder">
                <div class="card" id="prior">
                    <div class="logoHolder">
                        <i class="icon fab fa-product-hunt" style="color: #4285F4"></i>
                    </div>
                    <div class="container">
                        <center>
                            <h4><b>Manage Prior. <br> Create or Delete your Priors</b></h4> 
                        </center>
                    </div>
                </div>
            
                <div class="card" id="tag">
                    <div class="logoHolder">
                        <i class="icon fas fa-code-branch" style="color: #F4B400"></i>
                    </div>
                    <div class="container">
                        <center>
                            <h4><b>Manage Tags. <br> Create a New Tag, Add New Post to existing Tag or Delete a Tag</b></h4> 
                        </center> 
                    </div>
                </div>

                <div class="card" id="due">
                    <div class="logoHolder">
                        <i class="icon fas fa-calendar-alt" style="color: #0F9D58"></i>
                    </div>
                    <div class="container">
                    <a class="cardAnchor" href="deleteTag.php">
                        <center>
                            <h4><b>Manage Due Timetable. <br> Add or Delete Event</b></h4> 
                        </center> 
                    </a>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <script src="../assets/loading/jquery.js"></script>
    <script src="../assets/loading/prettify.js"></script>
    <script src="../assets/loading/topbar.min.js"></script>
    <script>$(function(){prettyPrint();topbar.config({autoRun:!0,barThickness:10,barColors:{0:"rgba(26,  188, 156, .9)",".25":"rgba(52,  152, 219, .9)",".50":"rgba(241, 196, 15,  .9)",".75":"rgba(230, 126, 34,  .9)","1.0":"rgba(211, 84,  0,   .9)"},shadowBlur:10,shadowColor:"rgba(0,   0,   0,   .6)",className:"topbar"});topbar.show();setTimeout(function(){$("#main_content").fadeIn("slow");topbar.hide()},1500)});</script>

</body>
<script>
var prior=document.getElementById("prior");prior.style.cursor="pointer",prior.onclick=(()=>{window.location.href="prior"});var tag=document.getElementById("tag");tag.style.cursor="pointer",tag.onclick=(()=>{window.location.href="tag"});var due=document.getElementById("due");due.style.cursor="pointer",due.onclick=(()=>{window.location.href="due"});
</script>
</html>