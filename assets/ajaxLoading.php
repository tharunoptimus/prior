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

    $query = "SELECT * FROM prior ORDER BY id DESC"; 
    $run = $con->query($query); 
    while($row = $run->fetch_assoc()) {

        echo("<div class='");  $priority = $row['important']; if($priority){echo "rainbow";}else echo "chat_data"; echo("'>");
        echo("<span class='username'><a href='comments?roomid=".$row["id"]."'><i class='fas fa-comment-alt'></i></a>
        "); echo $row['name']; echo(" : </span>"); 
        echo("<span class='messagespan'><p class='message'>");$str = $row['message'];
        $rpl="</a>&nbsp;<img src='assets/images/redirect.png' style='width: 16px;'>";
        $str = str_replace("</a>", $rpl, $str); echo $str;
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
                    echo("</p></div></div>");
        echo("</div>");
    }
?>