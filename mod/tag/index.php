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

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags Management</title>
    
    <script async src="../../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../../assets/fontAwesome/style.css">
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
               <h1 style="margin: 0 8%;">Tags Management</h1>
            </div>
        </div>

        

        <div class="cardWrapper">

            <div class="cardHolder">
                <div class="card">
                    <div class="logoHolder">
                        <a class="cardAnchor" href="insertInto.php">
                            <i class="icon far fa-plus-square" style="color: #4285F4"></i>
                        </a>
                    </div>
                    <div class="container">
                    <a class="cardAnchor" href="insertInto.php">
                        <center>
                            <h4><b>Add a post to an existing Tag</b></h4> 
                        </center>
                    </a>
                    </div>
                </div>
            
                <div class="card">
                    <div class="logoHolder">
                        <a class="cardAnchor" href="createTag.php">
                            <i class="icon fas fa-folder-plus" style="color: #0F9D58"></i>
                        </a>
                    </div>
                    <div class="container">
                    <a class="cardAnchor" href="createTag.php">
                        <center>
                            <h4><b>Create a new Tag</b></h4> 
                        </center> 
                    </a>
                    </div>
                </div>

                <div class="card">
                    <div class="logoHolder">
                        <a class="cardAnchor" href="deleteTag.php">
                            <i class="icon fas fa-trash-alt" style="color: #DB4437"></i>
                        </a>
                    </div>
                    <div class="container">
                    <a class="cardAnchor" href="deleteTag.php">
                        <center>
                            <h4><b>Delete a Tag</b></h4> 
                        </center> 
                    </a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <?php include '../loading.php'; ?>

</body>
</html>