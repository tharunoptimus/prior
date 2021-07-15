<?php
    include '../config.php';

    if(isset($_GET['tagid'])) {

        $id = $_GET['tagid'];
        $name = $_GET['tagname'];
    }
    else {
        header("Location: ./");
    }

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d H:i:s');

    function time_Ago($time) { /* https://is.gd/iSeYr8 */
		$diff    = time() - $time;$sec = $diff;$days= round($diff / 86400 );$weeks= round($diff / 604800);$min = round($diff / 60 );
		$hrs = round($diff / 3600);$mnths= round($diff / 2600640 ); $yrs= round($diff / 31207680 );$wanted_time = 0;
		if($sec <= 60) { echo "$sec seconds ago";return $sec . " seconds ago";} 
		else if($min <= 60) { if($min==1) { echo "1 minute ago";return "1 minute ago";} else { echo "$min minutes ago";return $min . " minutes ago";} } 
		else if($hrs <= 24) { if($hrs == 1) {echo "an hour ago";return "An hour ago";} else {echo "$hrs hours ago";return $hrs . " hours ago";} } 
		else if($days <= 7) { if($days == 1) {echo "Yesterday";return "Yesterday";} else {echo "$days days ago";return $days . " days ago";} } 
		else if($weeks <= 4.3) { if($weeks == 1) {echo "A week ago";return "A week ago";} else { echo "$weeks weeks ago";return $weeks . " weeks ago";} } 
		else if($mnths <= 12) { if($mnths == 1) { echo "A month ago";return "A month ago";} else { echo "$mnths months ago";return $mnths . " months ago";}} 
		else { if($yrs == 1) { echo "One year ago";return "One year ago";} else { echo "$yrs years ago";return $yrs . " years ago";} } 
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name; ?></title>
    
    <script async src="../assets/fontAwesome/script.js"></script>
    <link rel="stylesheet" href="../assets/fontAwesome/style.css">
</head>
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

        <div class = "priorHolder" id="priorHolder" style="margin-top: 5%;">
            <?php 

                $query = "SELECT * FROM tagposts WHERE tagid = '$id' ORDER BY id DESC"; 
                $run = $con->query($query); 
                $row = $run->fetch_array();
                if ($row) {
                    $query = "SELECT * FROM tagposts WHERE tagid = '$id' ORDER BY id DESC"; $run = $con->query($query); 
                    while($row = $run->fetch_array()) :
                    echo '<div><form action="viewtag.php" method="GET">';
                        echo ' <input type="hidden" name="tagid" value="'.$row['id'].'">';
                        echo "<button class='searchBox tagButton' type='submit' name='viewtag'>";
                            echo("<div class='chat_data'>");
                                echo("<span class='username'>".$row['name']."</span>"); 
                                echo("<span class='messagespan'><p class='message'>");
                                    echo $row['message'];
                                echo("</p></span>");
                                echo ("<div class='tallheadpostert'>
                                    <div class='timedate'>
                                        <p class='time'>");
                                            $curr_time = $row['timedate'];
                                            $time_ago = strtotime($curr_time); 
                                            $help=time_Ago($time_ago); 
                                            if (strstr($help, "day")){
                                                if(strstr($help, "Yesterday")){
                                                    echo " at " . substr($curr_time, 11);
                                                }
                                                else{
                                                    echo ".&nbsp;Date: $curr_time";
                                                }
                                            }
                                            elseif(strstr($help, "week") || (strstr($help, "month") || (strstr($help, "year")))){
                                                echo ".&nbsp;Date: $curr_time";
                                            }
                                        echo("</p>"); 
                                    echo("</div>");
                                echo ("</div>");
                            echo "</div>";
                        echo("</button>");
                    echo("</form></div>"); endwhile;
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