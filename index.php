<?php 

    include 'config.php';
    include 'encoderDecoder.php';
    if(!isset($_COOKIE['name'])) {
        header("Location: login.php");
        die();
    }   


    $dark = $_COOKIE['dark'];
    $dark = decodePrior($dark);
    if($dark == '1') {$dark = 1;} else {$dark = 0;}

    $name = decodePrior($_COOKIE['name']);
    $isMode = decodePrior($_COOKIE['ismod']);

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
<html>
<head>
    
    <title>Prior</title>
    
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel='shortcut icon' href='assets/images/p.png' type='image/x-icon' />
    <link rel="apple-touch-icon" href="logo.png" />
    <meta name="theme-color" content="#317EFB"/>
    <link rel="manifest" href="modmanifest.json" />
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/darkStyle.css"> -->

    <?php if($dark) echo '<link rel="stylesheet" type="text/css" href="assets/css/darkStyle.css">'; ?>
    <script>
        const https = () => {
            if (location.protocol !== 'https:') {
                location.replace(`https:${location.href.substring(location.protocol.length)}`);
            }
        }
    </script>
    <!-- Font Awesome -->        

</head>

<body>
    <script defer async src="assets/fontAwesome/script.js"></script>

    <div class="wrappit">  

        <div class="top">
            <div class = "topBar" id="topBar" >
                <div class = "dueCalendar flexDisplay" id="leftTopDiv">
                <button class="ham newButton" onclick="window.location.href='due';" aria-label="Due Calander">
                    <i class="fai fas fa-calendar-alt" style="font-size: 35px; color: #3498db"></i>                   
                </button>
                    
                </div>
                <div class="tallheadposter" id="centerTopDiv">
                    <a href = "./"><img src="assets/images/prior.png" alt="Logo"></a>
                </div>
                <div class="hamburger flexDisplay" id="rightTopDiv">
                <button id="ham" class="newButton1" onclick="hamburger()" aria-label="Menu Button">
                    <span id = "openHam">
                        <i class="fai fas fa-bars" style="font-size: 35px;"></i>
                    </span>
                   
                </button>
                </div>
            </div>
        </div>

        <div class="greetings">
            <div class="weather">
                <button id="getWeather" onclick="weatherBurger()" style="padding: 0;" class="newButton1" aria-label="Know Weather"><i class="fai fas fa-cloud-sun" style="font-size: 35px; color: #f39c12"></i></button>
            </div>
            <div class="user">
                <center><p style="margin: 0; color: <?php if($dark){echo '#FFFFFF;';}else{echo '#000000;';}?>">&emsp;Hello <?php echo $name; ?></p></center>
            </div>
        </div>

        <div id="hamMenu" class="hamMenu" style="display: none;">
            <div class="rainbow">
                <button class="ham" style = "float: right;" onclick="hamburger()">
                    <span id = "closeHam" style="display: none;">
                        <i class="fai fas fa-times" style="font-size: 31px;"></i>
                    </span>
                </button>
                <button class="newButton menu" onclick='window.location.href = "settings"'><h1 class="menuHead">Settings <i class="fai fas fa-cogs"></i></h1></button>
                <br>
                <button class="newButton menu" onclick='window.location.href = "good"'><h1 class="menuHead">Good Man <br> From Earth <i class="fai fab fa-youtube"></i></h1></button>
                <br>
                <button class="newButton menu" onclick='window.location.href = "tags"'><h1 class="menuHead">Tags by Mods <i class="fas fa-code-branch"></i></h1></button>
                <br>
                <!-- <button class="newButton menu" onclick='window.location.href = "tags"'><h1 class="menuHead">Tags By Mods <i class="fas fa-code-branch"></i></h1></button>
                <br> -->
                <?php 
                    if(!$dark) echo '<button class="newButton menu" onclick="darkmode()"><h1 class="menuHead">Dark Mode <i class="fas fa-flask"></i></i></h1></button><br>'; 
                    else echo '<button class="newButton menu" onclick="lightmode()"><h1 class="menuHead">Light Mode <i class="fas fa-sun"></i></i></h1></button><br>';
                ?>
                
                <?php if($isMode) echo '<button class="newButton menu" onclick = \'window.location.href= "mod"\'>
                    <h1 class="menuHead">Mod <i class="fai fas fa-chalkboard-teacher"></i></h1></button><br>'; ?>

                <?php if($isMode) echo '<button class="newButton menu" onclick = \'window.location.href= "mod/instant.php"\'>
                                    <h1 class="menuHead">Instant Prior <i class="fas fa-bolt"></i></h1></button><br>'; ?>

                <button class="ham" style="padding: 0; width: 100%" onclick="logout()"><h1 class="menuHead">Logout <i class="fai fas fa-sign-out-alt"></i></h1></button>
                
            </div>
        </div>

        <div class = "priorHolder" id="priorHolder">
            <?php 

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
        </div>

        <div id="redirectWeather" style="display: none;" class="hamMenu">
            <div class="rainbow">
                <button class="ham" style = "float: right;" onclick="weatherBurger()">
                    <span id = "closeWeatherButton" style="display: none;">
                        <i class="fai fas fa-times" style="font-size: 31px;"></i>
                    </span>
                </button>
                <center>
                    <br>
                    <h1>You're being redirected to weather.com</h1>
                    <h1>Click Continue to Proceed.</h1>
                    <button class="styleButton" onclick='window.location.href = "https://weather.com/"'>Continue</button>
                    <br><br>
                </center>
                
            </div>
        </div>

    </div>

    <script src = "assets/js/hamburger.js"></script>

    <script>
        if('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('serviceworker.js')
                    .then((reg) => console.log('Success: ', reg.scope))
                    .catch((err) => console.log('Failure: ', err));
            })
        }

        var loadMultipleCss=function(){loadCss("assets/css/important.css"),loadCss("assets/fontAwesome/style.css")},loadCss=function(e){var s=document.createElement("link");s.rel="stylesheet",s.href=e;var t=document.getElementsByTagName("head")[0];t.parentNode.insertBefore(s,t)};window.addEventListener("load",loadMultipleCss);
    </script>

    <script src="assets/loading/jquery.js"></script>
    <script src="assets/loading/prettify.js"></script>
    <script src="assets/loading/topbar.min.js"></script>
    <script>$(function(){prettyPrint();topbar.config({autoRun:!0,barThickness:10,barColors:{0:"rgba(26,  188, 156, .9)",".25":"rgba(52,  152, 219, .9)",".50":"rgba(241, 196, 15,  .9)",".75":"rgba(230, 126, 34,  .9)","1.0":"rgba(211, 84,  0,   .9)"},shadowBlur:10,shadowColor:"rgba(0,   0,   0,   .6)",className:"topbar"});topbar.show();setTimeout(function(){$("#main_content").fadeIn("slow");topbar.hide()},1500)});</script>

    <script>
        function ajaxCall(){
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('priorHolder').innerHTML = req.responseText;
                }
            }
            req.open('GET', 'assets/ajaxLoading.php', true);
            req.send(); 
            console.log('Updating');
        }
        
        setInterval(function(){ajaxCall()}, 600000)
    </script>

</body>   
</html>