<?php
    session_start(); 
    $name = $_SESSION['sname'];
    if($name == ""){
        header("Location: index.php");
        exit(); //Prevent unauthorized entry
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Success!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/indexstyle.css">
    <link rel='shortcut icon' href='assets/images/p.png' type='image/x-icon' />

</head>
<body>

    <div class="wrapper indexPage">

        <div class="mainSection">

            <div class="information">
                <h1>Hello <?php echo "$name"; ?>!</h1><center><h3>What do you want to do?</h3></center><br>
            </div>

            <div class="logoContainer">
    			<a href="profile.php"><img src="assets/images/sending.gif" title="Proof -> Prior" alt="Send to Prior" style="border-radius: 10px;"></a><center><h4>Send a Prior!</h4></center><br><br>
                <a href="delete.php"><img src="assets/images/delete.gif" title="Proof -> Prior" alt="Send to Prior" style="border-radius: 10px; border: 2px solid #FF814C"></a><center><h4>Delete a Prior!</h4></center><br>
            </div>

        </div>

    </div>
</body>
</html>