<?php 

    header("Access-Control-Allow-Origin: *"); // !!SECURITY WARNING: Make sure you input the domain name before hosting it.
    session_start();
    include 'db.php';
    $raiseNotification = 0; //For pushing Notifications
    date_default_timezone_set('Asia/Kolkata'); //Set Server Time Zone
    $date = date('Y-m-d H:i:s');
    
    $query = "SELECT * FROM announcement ORDER BY id DESC"; //Query Call
    $run = $con->query($query); 
    $numberOfRows = mysqli_num_rows($run);

    //Algorithm to find the right time to push notification.
    if ($numberOfRows > $_SESSION['numberOfRows']){
        $raiseNotification  = 1;
        $_SESSION["numberOfRows"] = $numberOfRows;
    }
    elseif ($numberOfRows < $_SESSION['numberOfRows']){
        $_SESSION["numberOfRows"] = $numberOfRows;
    }

    $row = $run->fetch_array();
    if ($row) {
        $query = "SELECT * FROM announcement ORDER BY id DESC"; $run = $con->query($query); 
        while($row = $run->fetch_array()) : //For every messages available in the table
            echo("<div id='chat_data' class='");  
            $priority = $row['important']; 
            if($priority){ //Check for normal/Important message
                echo "rainbow";
            }
            else{
                echo "chat_data"; 
            }
            echo("'>");
            echo("<span class='username'>"); 
            echo $row['name']; 
            echo(" : </span>"); 
            echo("<span class='messagespan'><p class='message'>");
            $str = $row['message'];
            $rpl="</a>&nbsp;<img src='assets/images/redirect.png' style='width: 16px;'>";
            $str = str_replace("</a>", $rpl, $str); 
            echo $str;
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
        endwhile;
    }
    else{
        echo("<p align='center' style='font-size: 30px; text-align: center;color: #2C3A47;''>No Priority Messages right now.</p>");
        echo("<p align='center' style='font-size: 30px; text-align: center;color: #2C3A47;'>Dance with Ice Bear!!</p>");
        echo("<img class='panda' src='panda.gif' alt='Dance with Ice Bear'>");
    }
?>

<div class='chat_data' style="padding: 3% 7%;">
    <span class='messagespan'>
        <p class='message' style="text-align: -webkit-center; color: #000000; margin-bottom: 0px;"> Developed by <a href="http://privacydefenders.rf.gd/" style="color: #fd79a8;">Privacy Defenders <img src="assets/images/redirect.png" style="width: 16px;"/></a></p>
    </span>
</div> 

<?php 

    if($raiseNotification == 1){
        echo "<iframe onload='notifyMe()' src='https://www.example.com/' width='0' height='0'></iframe>";
    } 

    function time_Ago($time){
        $diff = time() - $time;
        $sec = $diff;
        $days= round($diff / 86400 );
        $weeks= round($diff / 604800);
        $min = round($diff / 60 );
        $hrs = round($diff / 3600);
        $mnths= round($diff / 2600640 );
        $yrs= round($diff / 31207680 );
        $wanted_time = 0;
        if($sec <= 60){ 
            echo "$sec seconds ago";
            return $sec . " seconds ago";
        } 
        elseif($min <= 60){ 
            if($min==1){ 
                echo "1 minute ago";
                return "1 minute ago";
            } 
            else{ 
                echo "$min minutes ago";
                return $min . " ";
            }
        } 
        elseif($hrs <= 24){ 
            if($hrs == 1){
                echo "an hour ago";
                return "An hour ago";
            }
            else{
                echo "$hrs hours ago";
                return $hrs . " hours ago";
            }
        } 
        elseif($days <= 7){ 
            if($days == 1){
                echo "Yesterday";
                return "Yesterday";
            } 
            else{
                echo "$days days ago";
                return $days . " days ago";
            } 
        } 
        elseif($weeks <= 4.3){ 
            if($weeks == 1){
                echo "A week ago";
                return "A week ago";
            } 
            else{ 
                echo "$weeks weeks ago";
                return $weeks . " weeks ago";
            }
        } 
        elseif($mnths <= 12){ 
            if($mnths == 1){ 
                echo "A month ago";
                return "A month ago";
            }
            else{ 
                echo "$mnths months ago";
                return $mnths . " months ago";
            }
        } 
        else{ 
            if($yrs == 1){ 
                echo "One year ago";
                return "One year ago";
            } 
            else{ 
                echo "$yrs years ago";
                return $yrs . " years ago";
            }
        } 
    }
    
?>