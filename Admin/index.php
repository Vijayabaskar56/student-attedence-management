<?php
include '../includes/dbcon.php';
include '../includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./includes/style.css">


<!-- <style>

.ul {
    display: flex;
    flex-direction: row;
}
.sidebar-brand {
    display: flex;
    align-items: center;
    background-color: gray;
    justify-content: center;
}
     -->

</style>
</head>
<body>
    <div class="wrapper">
        <?php include 'includes/nav.php'; ?>
        <?php include 'includes/index.html'; ?>
    </div>
</body>
</html>