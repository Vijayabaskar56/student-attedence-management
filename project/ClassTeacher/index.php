<?php 
    session_start();
    include '../includes/dbcon.php';
    include 'Includes/nav.php';

    $query = "SELECT tblclass.className 
    FROM tblclassteacher
    INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
    Where tblclassteacher.Id = ".$_SESSION['$userID']."";

    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rrw = $rs->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'Includes/title.php' ?>
    <style>
                .card-container{
            /* border: 3px dotted red; */
            display:flex;
            padding-top: 20px;
            position: inherit;
            justify-content: space-between;
        }
        .card-heading {
            padding: 15% 0 0 0%;
            border: 5px black;
        }

        .card-containe .card {
            /* border: 3px dotted blue; */
            display: inherit;
            align-self: center;
            text-align: right;
            height: 75px;
            width: 200px;
        }
        
        .card {
            padding-left: 10px;
        }
        

        .details-icon i {
            height: 50px;
            min-width: 78px;
            text-align: right;
            line-height: 50px;
            font-size: 20px;
            display: flex;
        }

        .foot-container {
        position: fixed;
        left: 260px;
        bottom: 10;
        left: 250px;
        width: calc(100vw - 160px);
        background-color: gray;
        color: white;
        transition: all 0.5 ease;
        text-align: center;
    }

    .sidebar.close ~ .foot-container {
        left: 78px;
        width: calc(100% - 78px);
    }
    </style>
</head>
<body>
    <section class="home-section">
    <div class="home-content">
                <i class= 'bx bx-menu' ></i>
                <span class="text">Attandace Management System</span>
            </div>

            <?php
                $query1 = mysqli_query($conn,"select * from tblstudents");
                $query2 = mysqli_query($conn,"select * from tblclass");
                $query3 = mysqli_query($conn,"select * from tblattendance");

                $students = mysqli_num_rows($query1);
                $class = mysqli_num_rows($query2);
                $attendance = mysqli_num_rows($query3);
            ?>

            <div class="card_heading">
                <h3><center>Class Teacher Dashboard (<?php echo $rrw['className']; ?>)</center></h3>
            </div>

            <div class="card-container">
                <div class="card">
                    <div class="details">STUDENTS</div>
                    <div class="details-opt"><?php echo $students; ?></div>
                    <div class="details-icon">
                        <i class='bx bxs-user-check'></i>
                    </div>
                </div>
                <div class="card">
                    <div class="details">CLASSES</div>
                    <div class="details-opt"><?php echo $class; ?></div>
                    <div class="details-icon">
                        <i class='bx bx-buildings'></i>
                    </div>
                </div>
                <div class="card">
                    <div class="details">TOTAL STUDENT ATTENDANCE</div>
                    <div class="details-opt"><?php echo $attendance; ?></div>
                    <div class="details-icon">
                        <i class='bx bxs-calendar-alt'></i>
                    </div>
                </div>
            </div>

            <div class="footer">
                <!-- <?php include './ClassTeacher/Includes/footer.php' ?> -->
            </div>
    </section>
</body>
</html>