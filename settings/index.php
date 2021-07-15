<?php

    include '../config.php';
    include '../encoderDecoder.php';

    if(!isset($_COOKIE['name'])) {
        header("Location: login.php");
        die();
    }

    $dark = $_COOKIE['dark'];
    $dark = decodePrior($dark);
    if($dark == '1') {$dark = 1;} else {$dark = 0;}

    $name = decodePrior($_COOKIE['name']);
    $isMode = decodePrior($_COOKIE['ismod']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <script async src="../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../assets/fontAwesome/style.css">
    
    <link rel="stylesheet" href="style.css">
    
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
               <h1 style="margin: 0 8%;">Account Settings</h1>
            </div>
        </div>


        <div class="mainContent">

            <div class="mainSettings">

                <div class="chat_data">
                    <div class="taskInfo">
                        <center>
                            <h3>Change the password of your account.</h3>
                            <button class="searchButton" onclick = "passwordChangeFunction()">Continue <i class="fas fa-key"></i> </button>
                        </center>
                    </div>
                </div>

                <div class="chat_data">
                    <div class="taskInfo">
                        <center>
                            <h3>Change the Display Name of your account.</h3>
                            <button class="searchButton" onclick = "changeNameFunction()">Continue <i class="fas fa-file-signature"></i> </button>
                        </center>
                    </div>
                </div>

            </div>

        </div>

        <div id="passwordChange" class="hamMenu">
            <div class="rainbow">
                <center>
                    <h2>Enter Password To Continue</h2>
                
                    <form action="changePassword.php" method="POST">
                        <input class="searchBox" type="text" name="username" placeholder="Username" required autofocus>
                        <br><br>
                        <input class="searchBox" type="text" name="password" placeholder="Password" required>
                        <br><br><br>
                        <input class="searchButton" type="submit" name="requestAccess" value="Login">
                        <br><br>
                    </form>	

                    <br>
                    <button class="searchButton" onclick = "passwordChangeFunction()">Click To Cancel</button>

                    <br>
                </center>
                
            </div>
        </div>


        <div id="changeName" class="hamMenu">
            <div class="rainbow">
                <center>
                    <h2>Enter Password To Continue</h2>
                
                    <form action="changeName.php" method="POST">
                        <input class="searchBox" type="text" name="username" placeholder="Username" required autofocus>
                        <br><br>
                        <input class="searchBox" type="text" name="password" placeholder="Password" required>
                        <br><br><br>
                        <input class="searchButton" type="submit" name="requestAccess" value="Login">
                        <br><br>
                    </form>	

                    <br>
                    <button class="searchButton" onclick = "changeNameFunction()">Click To Cancel</button>

                    <br>
                </center>
                
            </div>
        </div>

        
    </div>

    <script>
        var passwordChange=document.getElementById('passwordChange');const passwordChangeFunction=()=>{if(passwordChange.style.display!=="block"){passwordChange.style.display="block"}else{passwordChange.style.display="none"}}
        var changeName=document.getElementById('changeName');const changeNameFunction=()=>{if(changeName.style.display!=="block"){changeName.style.display="block"}else{changeName.style.display="none"}}
    </script>

<script src="../assets/loading/jquery.js"></script>
    <script src="../assets/loading/prettify.js"></script>
    <script src="../assets/loading/topbar.min.js"></script>
    <script>$(function(){prettyPrint();topbar.config({autoRun:!0,barThickness:10,barColors:{0:"rgba(26,  188, 156, .9)",".25":"rgba(52,  152, 219, .9)",".50":"rgba(241, 196, 15,  .9)",".75":"rgba(230, 126, 34,  .9)","1.0":"rgba(211, 84,  0,   .9)"},shadowBlur:10,shadowColor:"rgba(0,   0,   0,   .6)",className:"topbar"});topbar.show();setTimeout(function(){$("#main_content").fadeIn("slow");topbar.hide()},1500)});</script>

</body>
</html>