<?php
    include '../config.php';
    include "..//assets/Mobile_Detect.php";
    include '../encoderDecoder.php';

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
    $successMessage = 0;
    $formUsername = $_COOKIE['hello'];
    $username = decodePrior($_COOKIE['hello']);

    if(isset($_COOKIE['gmod'])) {
        $genuineMod = decodePrior(decodePrior($_COOKIE['gmod']));
        if($genuineMod == $username) {
            #pass
        }
    }else header("Location: index.php");
    
    $detect = new Mobile_Detect();
    $is_mobile=($detect->isMobile());

    if(isset($_GET['submit'])) {

        $formUsername = $_GET['cookieuser']; //Get username
        $priorMessage = $_GET['message'];
        if(empty($_GET["important"])){
            $important = 0;
        }
        else {
            $important = 1;
        }

        if($username == decodePrior($formUsername)){
            $name = decodePrior($_COOKIE['name']);

            $query = "INSERT INTO prior (name,username,message,important, iscomment, timedate) VALUES ('$name', '$username', '$priorMessage', '$important', '0', '$date')";
            
            if ($con->query($query) === TRUE) {
                $successMessage = 1;
            }

        }
        else {
            //User not genuine
        }
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
                    <p style="text-align: center;">Sent Your Prior Successfully</p>
                    <button onclick = "closeModal()" class="searchButton"  style="font-size: 17px;">Go to Home</button>
                </center>
            </div>
        </div>
    ';

    $scriptWhenSuccess = '
        
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        const closeModal = () => {
            modal.style.display = "none";
            window.location.href= "../";
        }

        span.onclick = function() {
            modal.style.display = "none";
            window.location.href="instant.php";
        }
        
    ';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="prior/assets/css/style.css">
    <link rel="stylesheet" href="prior/assets/css/checkbox.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($successMessage) echo '<style>' . $displayStyleWhenSuccess . '</style>'; ?>
    <title>Send an Instant Prior</title>
    
    
    <script async src="../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../assets/fontAwesome/style.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>

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
               <h1 style="margin: 0 8%;">Instant Prior</h1>
            </div>
        </div>


        <div class="mainContent">

            <div class="formContainer">
                <form method="GET" action="instant.php">
                    <textarea class="textBox" id="editor" name="message" placeholder='Enter Your Message:'></textarea>
                    <input type="hidden" name="cookieuser" value="<?php echo $formUsername; ?>">
                    <center>
                        <div class="importantField">
                            <label for="c1">Important?&emsp;</label><input id="c1" name="important" type="checkbox"/>
                        </div>                        
                        <input class="searchButton" type="submit" name="submit" value="Send!">
                        <br>
                    </center>
                </form>
            </div>

        </div>

        
    </div>

    <script type="text/javascript">
		ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
	</script>

    <?php if($successMessage) echo $modalDivWhenSuccess; ?>
    <?php if($successMessage) echo '<script>' .  $scriptWhenSuccess . '</script>'; ?>

    <script src="../assets/loading/jquery.js"></script>
    <script src="../assets/loading/prettify.js"></script>
    <script src="../assets/loading/topbar.min.js"></script>
    <script>$(function(){prettyPrint();topbar.config({autoRun:!0,barThickness:10,barColors:{0:"rgba(26,  188, 156, .9)",".25":"rgba(52,  152, 219, .9)",".50":"rgba(241, 196, 15,  .9)",".75":"rgba(230, 126, 34,  .9)","1.0":"rgba(211, 84,  0,   .9)"},shadowBlur:10,shadowColor:"rgba(0,   0,   0,   .6)",className:"topbar"});topbar.show();setTimeout(function(){$("#main_content").fadeIn("slow");topbar.hide()},1500)});</script>

</body>
</html>