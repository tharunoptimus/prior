 var specialKeys = new Array();
    specialKeys.push(8); //Backspace Character
    specialKeys.push(9); //Tab Character
    specialKeys.push(46); //Delete Character
    specialKeys.push(36); //Home Character
    specialKeys.push(35); //End Character
    specialKeys.push(37); //Left Character
    specialKeys.push(39); //Right Character

function IsAlphaNumeric(e) {
    var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
    var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
    document.getElementById("error").style.display = ret ? "none" : "inline";
    return ret;
}