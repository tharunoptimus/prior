
<?php 
    include '../config.php';
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

    function returnName($q) {
        if($q == "EVS"){
            return "Environmental Sciences";
        }elseif($q == "ADS"){
            return "OOPS & ADS";
        }elseif($q == "ALGO"){
            return "Design and Analysis of Algorithms";
        }elseif($q == "PED"){
            return "Pedogogy";
        }elseif($q == "CA"){
            return "Computer Architecture";
        }else{
            return "Operating Systems";
        }
    }


    if(isset($_GET['q'])){
        $q = $_GET['q'];

        $title = returnName($q);
    }
    else {
        echo("Invalid Request!");
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <link rel="shortcut icon" href="../assets/images/p.png" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="../assets/css/important.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script async src="../assets/fontAwesome/script.js"></script>
        <link rel="stylesheet" href="../assets/fontAwesome/style.css">
        <title>Playlists of <?php echo $title; ?></title>
    </head>
    
<body style="height: auto;" onload="if (location.protocol !== 'https:') {
                location.replace(`https:${location.href.substring(location.protocol.length)}`);
            }">
    <div class="wrappit">  

        <div class="info">
            <div class="back">    
                <a href="index.html" style="text-decoration: none;">
                    <i class="fas fa-arrow-circle-left" style="font-size: 35px;"></i>
                </a>
            </div>
            
            <div class="title">
               <h1 style="margin: 0 8%;"><?php echo $title; ?></h1>
            </div>
        </div>   

        <div class = "priorHolder" id="priorHolder">            
            <?php
                $query = "SELECT * FROM goodman WHERE coursename = '$q' ORDER BY timedate DESC"; 
                $run = $con->query($query); 
                while($row = $run->fetch_assoc()) {

                    echo("<div class='chat_data'>");
                    echo("<span class='username'>"); echo $row['teach']; echo(" : </span>"); 
                    echo("<span class='messagespan'><p class='message'>");
                    $link = $row['link']; $class = $row['class'];
                    echo '<a href="'.$link.'">'.$class.'</a>';
                    echo("</p>
                        </span>
                        <div class='tallheadpostert'>
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
                                echo("</p>
                            </div>
                        </div>
                    </div>");
                }
            ?>
                
        </div>
        <script src="../assets/loading/jquery.js"></script>
    <script src="../assets/loading/prettify.js"></script>
    <script src="../assets/loading/topbar.min.js"></script>
    <script>$(function(){prettyPrint();topbar.config({autoRun:!0,barThickness:10,barColors:{0:"rgba(26,  188, 156, .9)",".25":"rgba(52,  152, 219, .9)",".50":"rgba(241, 196, 15,  .9)",".75":"rgba(230, 126, 34,  .9)","1.0":"rgba(211, 84,  0,   .9)"},shadowBlur:10,shadowColor:"rgba(0,   0,   0,   .6)",className:"topbar"});topbar.show();setTimeout(function(){$("#main_content").fadeIn("slow");topbar.hide()},1500)});</script>

    </body>
</html>