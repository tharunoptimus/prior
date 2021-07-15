<?php
    include 'encoderDecoder.php';
    $zero = encodePrior(0);

    setcookie('dark', $zero, 1);
    setcookie('dark', $zero, strtotime( '+30 days' ));
    header("Location: index.php");

?>