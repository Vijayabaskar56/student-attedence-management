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
                <span class="text">View Student Attendance</span>
            </div>

            <div class="container-fluid">
                <h1 class="h3">View Student Attendance</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Student Attendance</li>
                    </ol>
            </div>
            <!-- <?php echo $statusMsg; ?> -->
            <div class="card-body">
                <form action="" method="post">
                    <label for="" class="form-control-label">Select Student</label>
                    <?php
                        $qry= "SELECT * FROM tblstudents where classId = '$_SESSION[classId]' ORDER BY firstName ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;
                        if ($num > 0){
                            echo ' <select required name="admissionNumber" class="form-control mb-3">';
                            echo'<option value="">--Select Student--</option>';
                            while ($rows = $result->fetch_assoc()){
                            echo'<option value="'.$rows['rollNumber'].'" >'.$rows['firstName'].' '.$rows['lastName'].'</option>';
                            }
                        echo '</select>';
                        }
                    ?>
                    <label for="" class="form-control-label">Type</label>
                    <select required name="type" onchange="typeDropDown(this.value)" class="form-control">
                        <option value="">--Select--</option>
                        <option value="1" >All</option>
                        <option value="2" >By Single Date</option>
                        <option value="3" >By Date Range</option>
                    </select>
                <button type="submit" name="view" class="btn btn-primary">View Attendance</button>
                </form>
            </div>

            <!-- INput Group -->
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

                       $admissionNumber =  $_POST['admissionNumber'];
                       $type =  $_POST['type'];

                       if($type == "1"){ //All Attendance

                        $query = "SELECT tblattendance.Id,tblattendance.status,tblattendance.dateTimeTaken,tblclass.className,
                        tblclassarms.classArmName,tblsessionterm.sessionName,tblsessionterm.termId,tblterm.termName,
                        tblstudents.firstName,tblstudents.lastName,tblstudents.otherName,tblstudents.admissionNumber
                        FROM tblattendance
                        INNER JOIN tblclass ON tblclass.Id = tblattendance.classId
                        INNER JOIN tblclassarms ON tblclassarms.Id = tblattendance.classArmId
                        INNER JOIN tblsessionterm ON tblsessionterm.Id = tblattendance.sessionTermId
                        INNER JOIN tblterm ON tblterm.Id = tblsessionterm.termId
                        INNER JOIN tblstudents ON tblstudents.admissionNumber = tblattendance.admissionNo
                        where tblattendance.admissionNo = '$admissionNumber' and tblattendance.classId = '$_SESSION[classId]' and tblattendance.classArmId = '$_SESSION[classArmId]'";

                       }
                       if($type == "2"){ //Single Date Attendance

                        $singleDate =  $_POST['singleDate'];

                         $query = "SELECT tblattendance.Id,tblattendance.status,tblattendance.dateTimeTaken,tblclass.className,
                        tblclassarms.classArmName,tblsessionterm.sessionName,tblsessionterm.termId,tblterm.termName,
                        tblstudents.firstName,tblstudents.lastName,tblstudents.otherName,tblstudents.admissionNumber
                        FROM tblattendance
                        INNER JOIN tblclass ON tblclass.Id = tblattendance.classId
                        INNER JOIN tblclassarms ON tblclassarms.Id = tblattendance.classArmId
                        INNER JOIN tblsessionterm ON tblsessionterm.Id = tblattendance.sessionTermId
                        INNER JOIN tblterm ON tblterm.Id = tblsessionterm.termId
                        INNER JOIN tblstudents ON tblstudents.admissionNumber = tblattendance.admissionNo
                        where tblattendance.dateTimeTaken = '$singleDate' and tblattendance.admissionNo = '$admissionNumber' and tblattendance.classId = '$_SESSION[classId]' and tblattendance.classArmId = '$_SESSION[classArmId]'";
                        

                    }
                       if($type == "3"){ //Date Range Attendance

                        $fromDate =  $_POST['fromDate'];
                        $toDate =  $_POST['toDate'];

                        $query = "SELECT tblattendance.Id,tblattendance.status,tblattendance.dateTimeTaken,tblclass.className,
                        tblclassarms.classArmName,tblsessionterm.sessionName,tblsessionterm.termId,tblterm.termName,
                        tblstudents.firstName,tblstudents.lastName,tblstudents.otherName,tblstudents.admissionNumber
                        FROM tblattendance
                        INNER JOIN tblclass ON tblclass.Id = tblattendance.classId
                        INNER JOIN tblclassarms ON tblclassarms.Id = tblattendance.classArmId
                        INNER JOIN tblsessionterm ON tblsessionterm.Id = tblattendance.sessionTermId
                        INNER JOIN tblterm ON tblterm.Id = tblsessionterm.termId
                        INNER JOIN tblstudents ON tblstudents.admissionNumber = tblattendance.admissionNo
                        where tblattendance.dateTimeTaken between '$fromDate' and '$toDate' and tblattendance.admissionNo = '$admissionNumber' and tblattendance.classId = '$_SESSION[classId]' and tblattendance.classArmId = '$_SESSION[classArmId]'";
                        
                    }

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
                                <td>".$rows['classArmName']."</td>
                                <td>".$rows['sessionName']."</td>
                                <td>".$rows['termName']."</td>
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