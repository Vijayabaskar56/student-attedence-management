<?php

    $query = "Select * from tblAdmin where Id = ".$_SESSION['userId']."";
    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rows = $rs->fetch_assoc();
    $fullName = $rows['firstName']."".['lastName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
        <nav>
  <div class="nav-heading">AMS</div>
  <div class="nav-right">
    <div class="nav-hamburger">
      <i class="fa fa-bars"></i>
    </div>
  </div>
  <div class="nav-left">
    <div class="nav-search-icon">
      <i class="fa fa-search"></i>
    </div>
    <div class="nav-search-bar">
      <form>
        <input type="text" placeholder="Search...">
      </form>
    </div>
  </div>
  <div class="nav-user">
    <div class="nav-user-pic">
      <img src="path/to/user-pic.jpg">
    </div>
    <div class="nav-user-name">John Doe</div>
  </div>
</nav>
</body>
</html>