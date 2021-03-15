<?php
    function bodyEchoer(){
        echo('<body>
            <div class="wrapper indexPage">
                <div class="mainSection">
                    <div class="logoContainer">
                        <img src="assets/images/prior.png">
                    </div>
                    <center>
                        <h1>Fill in the details to activate PRIOR</h1>
                        <br><h3>Danger Ahead: This file will be deleted after activation!!
                        <br><br>
                        Kindly ensure the reliability of the data you provide below.</h3>
                    </center>
                    <div class="searchContainer">
                        <form action="activate.php" method="POST">
                            <input class="searchBox" type="text" name="host_name" placeholder="Host Name: "><br>
                            <input class="searchBox" type="text" name="db_name" placeholder="Database Name: "><br>
                            <input class="searchBox" type="text" name="user_name" placeholder="Database Username: "><br>
                            <input class="searchBox" type="text" name="password" placeholder="Database Password: "><br>
                            <input class="searchButton" type="submit" name="login_button" value="Activate"><br>
                        </form>		
                    </div>
                </div>       
            </div>
        </body>
        </html>');
    }

    function htmlHeader(){
        echo('<!DOCTYPE html>
            <html>
            <head>
                <title>Activate</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="Site to Input the Message to view in Prior">
                <meta name="keywords" content="prior, priorm, proof">
                <link rel="stylesheet" type="text/css" href="mod/assets/css/indexstyle.css">
                <link rel="shortcut icon" href="mod/assets/images/p.png" type="image/x-icon" />
            </head>');
    }

    function deleteFile(){
        $file_pointer = "activate.php"; 
        if (!unlink($file_pointer)) { 
            header("Location: index.php");
        }
    }

    function createTable(){
        $host = $_POST['host_name'];
        $dbname = $_POST['db_name'];
        $username = $_POST['user_name'];
        $password = $_POST['password'];

        $con = new mysqli($host, $username, $password, $dbname);

        $query = "CREATE TABLE `announcement` (
            `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
            `username` varchar(512) NOT NULL,
            `name` varchar(512) NOT NULL,
            `message` varchar(4096) NOT NULL,
            `timedate` varchar(128) NOT NULL,
            `important` int(11) DEFAULT 0)";

        if(mysqli_query($con, $query)){
            $usersSql = "CREATE TABLE `users` (
                        `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
                        `name` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `username` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
            if(mysqli_query($con, $usersSql)){
                deleteFile();
            }     
        }

    }

    if(isset($_POST['login_button'])) {
        createTable();
    }
    htmlHeader();
    bodyEchoer();

?>