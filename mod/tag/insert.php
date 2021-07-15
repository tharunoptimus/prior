<?php
    include '../../config.php';
    include '../../encoderDecoder.php';

    $successMessage = 0;

    if(isset($_GET['tagid']) and isset($_COOKIE['hello'])) {

        $id = $_GET['tagid'];
        $name = $_GET['tagname'];
        $successMessage = 0;
        $tagname = $_GET['tagname'];
        $formUsername = $_COOKIE['hello'];
        $username = decodePrior($_COOKIE['hello']);

        if(isset($_GET['submit'])) {
            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d H:i:s');

            $formUsername = $_GET['cookieuser']; //Get username
            $priorMessage = $_GET['message'];
    
            if($username == decodePrior($formUsername)){
                $name = decodePrior($_COOKIE['name']);
                $query = "INSERT INTO tagposts (tagid,tagname,name,username, message, timedate) VALUES ('$id', '$tagname', '$name', '$username', '$priorMessage', '$date')";
                if (mysqli_query($con, $query)) {
                    //$last_id = mysqli_insert_id($con);
                    $successMessage = 1;
                }
            }
            else {
                //User not genuine
            }
        }
    }
    else {
        header("Location: ./");
    }

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');
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
                    <p style="text-align: center;">Sent Your Post Successfully</p>
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
    <link rel="stylesheet" href="../../tags/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send a post</title>
    
    <script async src="../../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../../assets/fontAwesome/style.css">

    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>

    <style>
        .ck.ck-editor {
            max-width: 100;
            height: 200;
        }
    </style>
<body onload="if (location.protocol !== 'https:') {
                location.replace(`https:${location.href.substring(location.protocol.length)}`);
            }">

    <div class="wrapper">

        <div class="info">
            <div class="back">    
                <a href="./" style="text-decoration: none;">
                    <i class="fas fa-arrow-circle-left" style="font-size: 35px;"></i>
                </a>
            </div>
            
            <div class="title">
               <h1 style="margin: 0 8%;"><?php echo $name; ?></h1>
            </div>
        </div>

        <div class="mainContent" style="margin-top: 5%;">

            <div class="formContainer">
                <form method="GET" action="insert.php">
                    <textarea class="textBox" id="editor" name="message" placeholder='Enter Your Message:'></textarea>
                    <input type="hidden" name="cookieuser" value="<?php echo $formUsername; ?>">
                    <input type="hidden" name="tagid" value="<?php echo $id; ?>">
                    <input type="hidden" name="tagname" value="<?php echo $tagname; ?>">
                    
                    <center>                    
                        <input class="searchButton" type="submit" name="submit" value="Post">
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