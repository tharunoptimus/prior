<?php
    session_start(); 
    $check = $_SESSION['sname'];
    if($check == ""){
        header("Location: index.php");
        exit(); //Prevent unauthorized entry
    }

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

?>

<!DOCTYPE html>
<html>
<head>
    <title>PriorM -> Prior</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site to Input the Message to view in Prior">
    <meta name="keywords" content="prior">
    <meta name="author" content="Developed by Privacy Defenders  - tharunoptimus ">

    <link rel='shortcut icon' href='assets/images/p.png' type='image/x-icon' />

    <link rel="stylesheet" href="assets/css/quantumalert.css" />
    <link rel="stylesheet" type="text/css" href="toggle.css">
	<link rel="stylesheet" type="text/css" href="assets/css/indexstyle.css">

    <style type="text/css">
    	.cke_textarea_inline{
    		border: 1px solid black;
    	}
	</style>

	<script src="ckeditor/ckeditor.js" ></script>

</head>
    
<body> 

    <div class="wrapper indexPage">

        <div class="mainSection">

            <div class="logoContainert">
                <br><br><a href = "index.php"><img src="assets/images/sending.gif" title="Proof -> Prior" alt="Send to Prior" style="border-radius: 10px;"></a>

			</div>

            <div class="searchContainer">
                <br>
				<form method="post" action="success.php">
                    <textarea class="textBox" id='enter_message' name="enter message"></textarea>
                    <br><h4>Important?&emsp;<input id="c1" name="important" type="checkbox"/></h4><br>                    
                    <input class="searchButton" type="submit" name="submit" value="Send!">
                </form>
                <br>

            </div>

        </div>

    </div> 

    <script type="text/javascript">

		CKEDITOR.replace('enter_message',{
            width: "500px",
        	height: "200px"
		});     

	</script>

</body>
</html>