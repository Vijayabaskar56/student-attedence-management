<?php 
    session_start();
    include '../include/dbcon.php';
    include '../Teachers/include/nav.php';

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
    <?php include 'include/title.php'; ?>
</head>
<body>
    <section class="home-section">
    <div class="home-content">
                <i class= 'bx bx-menu' ></i>
                <span class="text">Attandace Management System</span>
            </div>

            <div class="container-fluid">
                <h1 class="h3">View Student Attenedance</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Class Attendance</li>
                    </ol>
            </div>
            <form action="" method="post">
                <label for="">Select Date</label>
                <input type="date" class="form-control" name="dateTaken" id="exampleInputFirstName" placeholder="Class Name">
                <button type="submit" name="view" class="btn">View Attendance</button>
            </form>
            <!-- Input Group -->
            <div class="row">
                <h6 class="h3">Class Attendance</h6>
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Other Name</th>
                            <th>Admission No</th>
                            <th>Class</th>
                            <th>Session</th>
                            <th>Term</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php

                    if(isset($_POST['view'])){

                    $dateTaken =  $_POST['dateTaken'];

                    $query = "SELECT tblattendance.Id,tblattendance.status,tblattendance.dateTimeTaken,tblclass.className,
                    tblsemterm.batchName,tblsemterm.semId,tblsem.semName,
                    tblstudents.firstName,tblstudents.lastName,tblstudents.rollNumber
                    FROM tblattendance
                    INNER JOIN tblclass ON tblclass.Id = tblattendance.classId
                    INNER JOIN tblsemterm ON tblsemterm.Id = tblattendance.semTermId
                    INNER JOIN tblsem ON tblsem.Id = tblsessionterm.termId
                    INNER JOIN tblstudents ON tblstudents.rollNumber = tblattendance.rollNo
                    where tblattendance.dateTimeTaken = '$dateTaken' and tblattendance.classId = '$_SESSION[classId]'";
                    $rs = $conn->query($query);
                    $num = $rs->num_rows;
                    $sn=0;
                    $status="";
                    if($num > 0)
                    { 
                        while ($rows = $rs->fetch_assoc())
                        {
                            if($rows['status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}
                            $sn = $sn + 1;
                            echo"
                            <tr>
                                <td>".$sn."</td>
                                <td>".$rows['firstName']."</td>
                                <td>".$rows['lastName']."</td>
                                <td>".$rows['otherName']."</td>
                                <td>".$rows['admissionNumber']."</td>
                                <td>".$rows['className']."</td>
                                <td>".$rows['BatchName']."</td>
                                <td>".$rows['semName']."</td>
                                <td style='background-color:".$colour."'>".$status."</td>
                                <td>".$rows['dateTimeTaken']."</td>
                            </tr>";
                        }
                    }
                    else
                    {
                        echo   
                        "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                    }
                    }
                    ?>
                </table>
            </div>
    </section>
</body>
</html>