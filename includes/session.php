<?php
    session_start();

    if(!isset($_SESSION['$userID']))
    {
        echo "<script type = \"text/javascript\">
        window.location = (\"../index.php\");
        </script>";
    }
?>