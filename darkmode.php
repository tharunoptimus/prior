<?php
    include 'encoderDecoder.php';

    $one = encodePrior(1);
    setcookie('dark', $one, 1);
    setcookie('dark', $one, strtotime( '+30 days' ));
    header("Location: index.php");

?>