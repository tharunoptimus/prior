var closeHam = document.getElementById('closeHam');
var hamMenu = document.getElementById('hamMenu');
var openHam = document.getElementById('openHam');

const hamburger = () => {
    if(openHam.style.visibility !== "hidden") {
        openHam.style.visibility = "hidden";
        closeHam.style.display = "block";
        hamMenu.style.display = "block";
    }
    else {
        openHam.style.visibility = "visible";
        closeHam.style.display = "none";
        hamMenu.style.display = "none";
    }

}

var getWeather = document.getElementById('getWeather');
var redirectWeather = document.getElementById('redirectWeather');
var closeWeatherButton = document.getElementById('closeWeatherButton');

const weatherBurger = () => {
    if(getWeather.style.visibility !== "hidden") {
        getWeather.style.visibility = "hidden";
        closeWeatherButton.style.display = "block";
        redirectWeather.style.display = "block";
    }
    else {
        getWeather.style.visibility = "visible";
        closeWeatherButton.style.display = "none";
        redirectWeather.style.display = "none";
    }

}

const logout = () => {
    window.location.href = "logout.php";
}

const lightmode = () => {
    window.location.href = "lightmode.php";
}

const darkmode = () => {
    console.log("calling dark");
    window.location.href = "darkmode.php";
}