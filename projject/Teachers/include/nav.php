<?php
    $query = "SELECT * from tblclassteacher where Id = ".$_SESSION['$userID']."" ;
    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rows = $rs->fetch_assoc();
    $fullName = $rows['firstName']." ".$rows['lastName'];
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <style>
            /* Google fonts imports */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

* {
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
  margin: 0%;
}

.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 260px; 
  background: #11101d;
  /* z-index: 100;
  transition: all 0.5s ease; */
}
/* .sidebar.close{
  width: 78px;
} */

.sidebar .logo-detils {
  height: 60px;
  width: 100%;  
  display: flex;
  align-items: center ;
}

.sidebar .logo-details i{
  height: 50px;
  min-width: 78px;
  text-align: center;
  line-height: 50px;
  color: #fff;
  font-size: 20px;
}


.logo-details,
.sidebar .logo-details .logo-name{
  font-size: 22px;
  color: #fff;
  font-weight: 600;
  transition: 0.3s ease;
  position: relative;
  display: flex;
  text-align: center;
  padding-top: 3.5%;
}

.sidebar  ul{
  display: flex;
  flex-direction: column;
  height: inherit;
}

/* .sidebar.close .logo-details .logo-name{
  transition-delay: 0s;
  opacity: 0;
  pointer-events: none;
} */

.sidebar .nav-links {
  background-color: #11101d;
  padding-left: 0;
  justify-content: space-around;
  height: 80%;
}
.sidebar .nav-links{
  overflow: visible;
}

.sidebar .nav-links::-webkit-scrollbar{
  display: none;
}

.sidebar .nav-links li{
  list-style: none;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.sidebar .nav-links li .icon-link{
  display: flex;
  align-items: center;
}

.sidebar .nav-links li i{
  height: 50px;
  min-width: 78px;
  text-align: center;
  line-height: 50px;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
  transition: all 0.3s ease;
}

/* .sidebar.close .nav-links i{
  display: none;
} */
.sidebar .nav-links li a{
  text-decoration: none;
  display: flex;
  align-items: center;
}
/* .sidebar.close .nav-links li a .link_name{
  opacity: 0;
  pointer-events: none;
} */
.sidebar .nav-links li a .link_name{
  font-size: 18px;
  display: flex;
  font-weight: 200;
  color: #fff;
}

.sidebar .profile-details{
  position: fixed;
  bottom: 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #1d1b31;
  padding: 6px 0;
}

.sidebar .profile-details .profile-content {
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  /* width: 135px; */
}
.sidebar .profile-details img{
  height: 52px;
  width: 52px;
  object-fit: cover;
  border-radius: 16px;
  margin: 0 14px 0 12px;
  background: #1d1d31;
  padding: 10px;
}

.sidebar .profile-details .name-job .profile-name{
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  white-space: nowrap;
} 

.home-section{
    position: relative;
    background: #E4E9F7;
    height: 100vh;
    left: 260px;
    width: calc(100% - 260px);
    transition: all 0.5s ease;
}
/* 
.sidebar.close ~ .home-section {
  left: 78px;
  width: calc(100% - 78px);

} */

/* footer */
.sidebar.close ~ .foot-container {
  left: 78px;
  width: calc(100% - 78px);
}

.home-section .home-content{
    height: 60px;
    display: flex;
    align-items: center;
}

.home-section .home-content .bx-menu,
.home-section .home-content .text{
    color: #11101d;
    font-size: 35px;
}
.home-section .home-content .bx-menu{
  margin: 0 15px;
}

.home-section .home-content .text{
    font-size: 26px;
    font-weight: 600;
}

.nav-user-name {
  color: #fff;
}


        </style>
    </head>
    <body>
        <div class="sidebar">
            <div class="logo-details">
                <i class='bx bxs-user'></i>
                <span class="logo-name">SAM</span>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="./">
                        <i class='bx bx-grid-alt'></i>
                        <span class="link_name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <div class="icon-link">
                    <a href="http://localhost/project/Teachers/viewStudents.php">
                        <i class='bx bx-chalkboard'></i>
                        <span class="link_name">View Students</span>
                    </a>
                    </div>
                </li>
                <li>
                    <div class="icon-link">
                    <a href="http://localhost/project/Teachers/takeAttendance.php">
                        <i class='bx bx-book-add'></i>
                        <span class="link_name">Take Attendance</span>
                    </a>
                    </div>
                </li>
                <li>
                    <div class="icon-link">
                    <a href="http://localhost/project/Teachers/viewClassAttendance.php">
                        <i class='bx bx-brain'></i>
                        <span class="link_name">View Class Attendance</span>
                    </a>
                    </div>
                </li>
                <li>
                    <div class="icon-link">
                    <a href="./viewStudentAttendance.php">
                        <i class='bx bx-book-open'></i>
                        <span class="link_name">View Student Attendance</span>
                    </a>
                    </div>
                </li>
                <li>
                    <div class="icon-link">
                    <a href="./downloadrecord.php">
                        <i class='bx bx-book-open'></i>
                        <span class="link_name">Download Report</span>
                    </a>
                    </div>
                </li>
                <li>
                    <div class="profile-details">
                        <div class="profile-content">
                            <img src="../img/user-icn.png" alt="profil-pic">
                        </div>
                        <div class="name-job">
                            <?php echo "<div class='nav-user-name'>".$fullName."</div>" ?>
                        </div>
                        <a href="./logout.php" class="log-out"><i class="bx bx-log-out"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </body>
</html>