<?php //User is Genuine $genuineMod  = encodePrior($username . $password);
    include '../../encoderDecoder.php';
    include '../../config.php';

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
    <title>Manage Prior</title>

    <script async src="../../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../../assets/fontAwesome/style.css">
    
    <link rel="stylesheet" href="assets/css/indexstyle.css">

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
                <a href="../" style="text-decoration: none;">
                    <i class="fas fa-arrow-circle-left" style="font-size: 35px;"></i>
                </a>
            </div>
            
            <div class="title">
               <h1 style="margin: 0 8%;">Manage Prior</h1>
            </div>
        </div>

        <div class="cardWrapper">

            <div class="cardHolder">
                <div class="card" id="send">
                    <div class="logoHolder">
                        <i class="icon fas fa-paper-plane" style="color: #4285F4"></i>
                    </div>
                    <div class="container">
                        <center>
                            <h4><b>Send a Prior</b></h4> 
                        </center>
                    </div>
                </div>
            
                <div class="card" id="image">
                    <div class="logoHolder">
                        <i class="icon fas fa-image" style="color: #F4B400"></i>
                    </div>
                    <div class="container">
                        <center>
                            <h4><b>Send an Image</b></h4><h2>Currently Down</h2>
                        </center> 
                    </div>
                </div>


                <div class="card" id="delete">
                    <div class="logoHolder">
                        <i class="icon fas fa-trash-alt" style="color: #DB4437"></i>
                    </div>
                    <div class="container">
                        <center>
                            <h4><b>Delete a Prior</b></h4> 
                        </center> 
                    </div>
                </div>
            </div>
        </div>        

        
        
    </div>

    <?php include '../loading.php'; ?>

</body>
<script>
var prior=document.getElementById("send");prior.style.cursor="pointer",prior.onclick=(()=>{window.location.href="sendPrior.php"});var tag=document.getElementById("delete");tag.style.cursor="pointer",tag.onclick=(()=>{window.location.href="deletePrior.php"});
</script>
</html>