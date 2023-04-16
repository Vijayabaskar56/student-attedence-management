<?php
    include '../includes/dbcon.php';
    session_start();
    include './Includes/title.php';
    include './Includes/nav.php';   
    // include './Includes/index.html';
    // include '../includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>


        .cards-container{
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

        .cards-containe .card {
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
                $query1 = mysqli_query($conn,"select * from tblstudent");
                $query2 = mysqli_query($conn,"select * from tblclass");
                $query3 = mysqli_query($conn,"select * from tblattendance");
                $query4 = mysqli_query($conn,"select * from tblprofessor");
                // $query5 = mysqli_query($conn,"select * from tblbatch");
                // $query6 = mysqli_query($conn,"select * from tblsemterm");

                $students = mysqli_num_rows($query1);
                $class = mysqli_num_rows($query2);
                $attendance = mysqli_num_rows($query3);
                $professor = mysqli_num_rows($query4);
                // $sem = mysqli_num_rows($query5);
                // $term = mysqli_num_rows($query6);
            ?>
            <div class="card-heading">
                <h3><center>Admistrator Dashboard</center> </h3>
            </div>
            <div class="cards-container">
                <div class="card">
                    <div class="details">STUDENTS</div>
                    <div class="details-opt"><?php echo $students; ?></div>
                    <div class="details-icon">
                        <i class='bx bxs-user-check'></i>
                    </div>
                </div>
                <div class="card">
                    <div class="details">CLASS</div>
                    <div class="details-opt"><?php echo $class; ?></div>
                    <div class="details-icon">
                        <i class='bx bx-buildings'></i>
                    </div>
                </div>
                <div class="card">
                    <div class="details">ATTENDANCE</div>
                    <div class="details-opt"><?php echo $attendance; ?></div>
                    <div class="details-icon">
                        <i class='bx bxs-calendar-alt'></i>
                    </div>
                </div>
                <div class="card">
                    <div class="details">TEACHERS</div>
                    <div class="details-opt"><?php echo $professor; ?></div>
                    <div class="details-icon">
                        <i class='bx bx-user-voice' ></i>
                    </div>
                </div>
                <!-- <div class="card">
                    <div class="details">SEMESTER</div>
                    <div class="details-opt"><?php echo $sem; ?></div>
                    <div class="details-icon">
                        <i class='bx bxs-calendar' ></i>
                    </div>
                </div> -->
                <!-- <div class="card">
                    <div class="details">TERMS</div>
                    <div class="details-opt"><?php echo $term; ?></div>
                    <div class="details-icon">
                        <i class='bx bx-grid'></i>
                    </div> -->
                </div>
            </div>

            <?php include './Includes/footer.php'; ?>

        </section>

        <script>
            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".bx-menu");
            console.log(sidebarBtn);
            sidebarBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("close");
        });
        </script>
</body>
</html>


