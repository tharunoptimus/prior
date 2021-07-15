<?php

    function encodePrior($string) {
        $string =  base64_encode($string);
        $string = "df3t" . $string . "12034dw3j==";
        return $string;
    }

    function decodePrior($string) {
        $string = substr($string, 4, -11);
        $string = base64_decode($string);
        return $string;
    }

?>