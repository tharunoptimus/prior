<?php
    include '../../config.php';
    include "../../assets/Mobile_Detect.php";
    include '../../encoderDecoder.php';

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
        $message = $_GET['message'];

        if($username == decodePrior($formUsername)){
            $subject = $_GET['course'];
            $staff = $_GET['staff'];
            $dueDate = $_GET['dueDate'];
            $timestamp = strtotime($dueDate);
            $date = date("d-m-Y", $timestamp);
            $query = "INSERT INTO duetable (username,subject,staff, title, timedate) VALUES ('$username', '$staff', '$subject', '$message', '$date')";
            if (mysqli_query($con, $query)) {
                //$last_id = mysqli_insert_id($con);
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
                    <button onclick = "closeModal()" class="searchButton"  style="font-size: 17px;">Back to Mod Page</button>
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
            window.location.href="sendDue.php";
        }
        
    ';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/checkbox.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($successMessage) echo '<style>' . $displayStyleWhenSuccess . '</style>'; ?>
    <title>Schedule an Event</title>
    
    <script async src="../../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../../assets/fontAwesome/style.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>

    <style>
        .ck.ck-editor {
            max-width: 100;
            height: 200;
        }
        [type="date"] {
        background:#fff url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
        }
        [type="date"]::-webkit-inner-spin-button {
        display: none;
        }
        [type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        }
    </style>
</head>
<body onload="if (location.protocol !== 'https:') {
                location.replace(`https:${location.href.substring(location.protocol.length)}`);
            }">

    <div class="wrapper">

        <div class="info">
            <div class="back">    
                <a href="index.php" style="text-decoration: none;">
                    <i class="fas fa-arrow-circle-left" style="font-size: 35px;"></i>
                </a>
            </div>
            
            <div class="title">
               <h1 style="margin: 0 8%;">Schedule an Event</h1>
            </div>
        </div>


        <div class="mainContent">

            <div class="formContainer">
                <form method="GET" action="sendDue.php">
                    <textarea class="textBox" id="editor" name="message" placeholder='Enter Your Message:'></textarea>
                    <input type="hidden" name="cookieuser" value="<?php echo $formUsername; ?>">
                    <center>       
                        <br> 
                        <label for="staff">Choose a Course:</label>
                        <select name="staff" id="staff">
                            <option value="DAA">DAA</option>
                            <option value="CAA">Computer Architecture</option>
                            <option value="OST">Operating Systems</option>
                            <option value="ADS">OOPS & ADS</option>
                            <option value="OLA">OS Lab</option>
                            <option value="ALA">OOPS & ADS Lab</option>
                        </select> 
                        <br><br>       
                        <label for="course">Choose a Staff:</label>
                        <select name="course" id="course">
                            <option value="NONE">Select Option</option>
                            <option value="SUNIL">Sunil Retmin Raj</option>
                            <option value="SHANMUGAPRIYA">Shanmuga Priya</option>
                            <option value="HEMALATHA">Hemalatha</option>
                            <option value="SWEETLYN">Sweetlyn</option>
                            <option value="SHERLEY">Sherley</option>
                            <option value="VIVEK">Vivekanandan</option>
                            <option value="NATHEZHTHA">Nathezhtha</option>
                            <option value="JAYANTHI">Jayanthi</option>
                            <option value="ARULNAN">Arulnan</option>
                        </select>  
                        <br><br>
                        <label for="dueDate">Due</label>
                        <input type="date" name="dueDate" id="dueDate">
                        <br>
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

    <?php include '../loading.php'; ?>

</body>
</html>