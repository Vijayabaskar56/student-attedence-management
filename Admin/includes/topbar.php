<?php
    $query = "Select * from tblHOD where Id = ".$_SESSION['userId']."";
    $rs = $conn->query($query);
    $num = $rs->num_rows();
    $rows = $rs->fetch_assoc();
    $fullName = $rows['firstName']."".['lastName'];
?>

