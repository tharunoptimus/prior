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
        $message = $_GET['name'];

        if($username == decodePrior($formUsername)){

            $query = "INSERT INTO tags (tagname,username) VALUES ('$message', '$username')";
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
                    <p style="text-align: center;">New Tag Created Successfully</p>
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
            window.location.href= "./";
        }

        span.onclick = function() {
            modal.style.display = "none";
            window.location.href="./";
        }
        
    ';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if($successMessage) echo '<style>' . $displayStyleWhenSuccess . '</style>'; ?>
    <title>Create New Tag</title>
    
    <script async src="../../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../../assets/fontAwesome/style.css">
    
    <style>
        .searchButton {
            height: 35px;
            width: 100px;
            font-size: 20px;
        }
        .searchBox {
            border: none;
            box-shadow: 0 2px 2px 0 rgb(0 0 0 / 5%), 0 0 0 1px rgb(0 0 0 / 6%);
            height: 44px;
            border-radius: 10px;
            outline: none;
            padding: 10px;
            box-sizing: border-box;
            font-size: 16px;
            max-width: 630px;
            color: #000;
            font-family: "jamun";
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
               <h1 style="margin: 0 8%;">Create New Tag</h1>
            </div>
        </div>


        <div class="mainContent" style="margin-top: 5%;">

            <div class="formContainer">
                <form method="GET" action="createTag.php">
                    <input class="searchBox" type="text" name="name" placeholder="New Tag Name:" required>
                    <br>
                    <input type="hidden" name="cookieuser" value="<?php echo $formUsername; ?>">
                    <center>
                        <input class="searchButton" type="submit" name="submit" value="Create">
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