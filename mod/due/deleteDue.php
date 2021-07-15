<?php
    include '../../config.php';
    include '../../encoderDecoder.php';

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
    $formUsername = $_COOKIE['hello'];
    $username = decodePrior($_COOKIE['hello']);
    $successMessage = 0;

    if(isset($_COOKIE['gmod'])) {
        $genuineMod = decodePrior(decodePrior($_COOKIE['gmod']));
        if($genuineMod == $username) {
            #pass
        }
    }else header("Location: index.php");


    if(isset($_GET['confirmDelete'])) {

        $formUsername = $_GET['cookieuser']; //Get username
        $priorId = $_GET['messageid'];

        if($username == decodePrior($formUsername)){

            $query = "DELETE FROM duetable WHERE id='$priorId'";
            if ($con->query($query) === TRUE) {
                $successMessage = 1;
            }

        }
        else {
            //User not genuine
        }
        
        
    }

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
                <center>
                    <p style="text-align: center;">Prior Deleted Successfully</p>
                    <button onclick = "closeModal()" class="searchButton">Close</button>
                </center>
            </div>
        </div>
    ';

    $scriptWhenSuccess = '
        
        var modal = document.getElementById("myModal");

        const closeModal = () => {
            modal.style.display = "none";
            window.location.href= "deleteDue.php";
        }
        
    ';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/stylem.css">
    <link rel="stylesheet" href="assets/css/important.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($successMessage) echo '<style>' . $displayStyleWhenSuccess . '</style>'; ?>
    
    
    <title>Delete an Event</title>
    
    
    <script async src="../../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../../assets/fontAwesome/style.css">

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
               <h1 style="margin: 0 8%;">Delete an Event</h1>
            </div>
        </div>


        <div class="mainContent">

            <div class="wrappit" style="width: 100%;">
                <?php 
                    $query = "SELECT * FROM duetable WHERE username = '$username' ORDER BY id ASC"; 
                    $run = $con->query($query); 
                    $row = $run->fetch_array();
                    if ($row) {
                        $query = "SELECT * FROM duetable WHERE username = '$username' ORDER BY id ASC"; $run = $con->query($query); 
                        while($row = $run->fetch_array()) :
                        echo '<form action="deleteDue.php" method="GET">';
                            echo '<input type="hidden" name="cookieuser" value="'.$formUsername.'">';
                            echo ' <input type="hidden" name="messageid" value="'.$row['id'].'">';
                            echo "<button class='deleteConfirmButton' type='submit' name='confirmDelete'>";
                                echo("<div class='chat_data' style='margin: 0;'>");
                                    echo("<span class='username' style='display:flex;'>Subject: " . $row['subject']); echo("</span>"); 
                                    echo("<span class='username' style='display:flex;'>Staff: ". $row['staff'] . "</span>"); 
                                    echo("<span class='messagespan'><p class='message'>".$row['title']."</p></span>");
                                    echo("<div class='tallheadpostert'><div class='timedate'><p class='time'>" . $row['timedate'] ."</p></div></br></div>");
                                echo "</div>";
                            echo("</button>");
                        
                        echo("</form><br>"); endwhile;
                    }
                    else{
                        echo("<p align='center' style='font-size: 30px; text-align: center;color: #2C3A47;''>You haven't posted any Prior Yet.</p>");
                    }
                ?>
            </div>

        </div>

        
    </div>
    <?php if($successMessage) echo $modalDivWhenSuccess; ?>
    <?php if($successMessage) echo '<script>' .  $scriptWhenSuccess . '</script>'; ?>

    <?php include '../loading.php'; ?>
    


</body>
</html>