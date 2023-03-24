<?php
    $query = "Select * from tblAdmin where Id = ".$_SESSION['userId']."";
    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rows = $rs->fetch_assoc();
    $fullName = $rows['firstName']." ".$rows['lastName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        header {
            display: flex;
            justify-content: space-between;
            /* width: 30px; */
            height: 30 px;
            padding: 1em;
        }

        .nav {
            position: fixed;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            background-color: gray;
            color: black;
            z-index: 100;
            transform: translateX(100%);
            transition: transform 250ms cubic-bezier(.5, 0, .5, 1);
        }

        .nav-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            height: 100%;
            align-items: center;
            padding: 0;
            margin: 0;
        }

        .nav-link {
            text-decoration: none;
            color: inherit;
            font-size: large;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <header>
        <div>
            <img src="../img/logo/attnlg.jpg" alt="logo-img">
            <span>AMS</span>
        </div>
        <button class="nav-toggler" aria-label="toggler-navigator">
            <span class="hamburgure"></span>
        </button>
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="#" class="nav-link">Manage Class</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Manage Class Arms</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Manage Teachers</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Manage Student</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Manage Sem & Periods</a></li>
            </ul>
            <div class="nav-serach">
                <div class="search-icon">
                    <i class="fa fa -search"></i>
                </div>
                <div>
                    <form >
                        <input type="text" placeholder="Search...">
                    </form>
                </div>
            </div>
            <div class="nav-user">
                <div class="nav-user-pic">
                    <img src="../img/logo/attnlg.jpg" alt="user-pic">
                </div>
                <?php echo "<div class='nav-user-name'>".$fullName."</div>" ?> 
            </div>
        </nav>
    </header>
</body>
</html>