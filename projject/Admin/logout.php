<?php
    session_start();
    session_destroy(); //desroy session
    echo "<script type = \"text/javascript\">window.location = (\"../index.php\")</script>";
?>