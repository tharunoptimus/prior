<?php
    include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags by Mods</title>
    
    <script async src="../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../assets/fontAwesome/style.css">
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
               <h1 style="margin: 0 8%;">Tags by Mods</h1>
            </div>
        </div>

        <div class = "priorHolder" id="priorHolder" style="margin-top: 5%;">
            <?php 

                $query = "SELECT * FROM tags ORDER BY id DESC"; 
                $run = $con->query($query); 
                $row = $run->fetch_array();
                if ($row) {
                    $query = "SELECT * FROM tags ORDER BY id DESC"; $run = $con->query($query); 
                    while($row = $run->fetch_array()) :
                    echo '<form action="viewtag.php" method="GET">';
                        echo ' <input type="hidden" name="tagid" value="'.$row['id'].'">';
                        echo ' <input type="hidden" name="tagname" value="'.$row['tagname'].'">';
                        echo "<button class='searchBox tagButton' type='submit' name='viewtag'>";
                            echo("<div class='chat_data' style='margin: 0; padding: 1%;'>");
                                echo("<span class='messagespan' style='align-items:center;'><p class='message'>");
                                    echo $row['tagname'];
                                echo("</p></span>");
                            echo "</div>";
                        echo("</button>");
                    echo("</form><br>"); endwhile;
                }
                else{
                    echo("<p align='center' style='font-size: 30px; text-align: center;color: #2C3A47;''>No tags yet.</p>");
                }
            ?>
        </div>
        
    </div>

    <script src="../assets/loading/jquery.js"></script>
    <script src="../assets/loading/prettify.js"></script>
    <script src="../assets/loading/topbar.min.js"></script>
    <script>$(function(){prettyPrint();topbar.config({autoRun:!0,barThickness:10,barColors:{0:"rgba(26,  188, 156, .9)",".25":"rgba(52,  152, 219, .9)",".50":"rgba(241, 196, 15,  .9)",".75":"rgba(230, 126, 34,  .9)","1.0":"rgba(211, 84,  0,   .9)"},shadowBlur:10,shadowColor:"rgba(0,   0,   0,   .6)",className:"topbar"});topbar.show();setTimeout(function(){$("#main_content").fadeIn("slow");topbar.hide()},1500)});</script>

</body>
</html>