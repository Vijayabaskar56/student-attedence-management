<?php
    error_reporting(0);
    include '../includes/dbcon.php';
    include '../includes/session.php';
    include '../ClassTeacher/Includes/nav.php';

    $query = "SELECT tblclass.className
    FROM tblclassteacher
    INNER JOIN tblclass ON tblclass.Id = tblclassteacher.classId
    Where tblclassteacher.Id = ".$_SESSION['$userID']."";

    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rrw = $rs->fetch_assoc();


    // sem and term 
    $query1 =mysqli_query($conn,"SELECT * from tblsemterm where isActive ='1'");
    $rrws = mysqli_fetch_array($query1);
    $semTermId = $rrws['Id'];

    $dataTaken = date("Y-m-d");

    $query2 = mysqli_query($conn,"SELECT * from tblattendance where classId = '$_SESSION[classId]' and dateTimeTaken='$dateTaken'");
    $count = mysqli_num_rows($query2);

    if($count == 0){
        // if Record does not exst, insert the new record
        // omsert the students record into the ttendance table on page load
        $query3 = mysqli_query($conn,"SELECT * from tblstudents where classId = '$_SESSION[classId]'");

        while($ros = $query3->fetch_assoc())
        {
            $query4=mysqli_query($conn,"INSERT into tblattendance(rollNO,classId,semtermId,stauts,dateTimeTaken) value('$ros[rollNumber]','$_SESSION[classId]','0','$dateTaken')");
        }
    }

    
if(isset($_POST['save'])){
    
    $admissionNo=$_POST['admissionNo'];

    $check=$_POST['check'];
    $N = count($admissionNo);
    $status = "";


//check if the attendance has not been taken i.e if no record has a status of 1
$qurty=mysqli_query($conn,"select * from tblattendance  where classId = '$_SESSION[classId]' and classArmId = '$_SESSION[classArmId]' and dateTimeTaken='$dateTaken' and status = '1'");
$count = mysqli_num_rows($qurty);

if($count > 0){

    $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Attendance has been taken for today!</div>";

}

    else //update the status to 1 for the checkboxes checked
    {

        for($i = 0; $i < $N; $i++)
        {
                $admissionNo[$i]; //admission Number

                if(isset($check[$i])) //the checked checkboxes
                {
                    $qquery=mysqli_query($conn,"update tblattendance set status='1' where rollNo = '$check[$i]'");

                    if ($qquery) {

                        $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Attendance Taken Successfully!</div>";
                    }
                    else
                    {
                        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
                    }
                
                }
        }
    }



}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'Includes/title.php'; ?>
</head>
<body>
    <section class="home-section">
    <div class="home-content">
                <i class= 'bx bx-menu' ></i>
                <span class="text">Attandace Management System</span>
            </div>

            <div class="container-fluid">
                <h1 class="h3">Take Attendance (Today's Date : <?php echo date("d-m-Y"); ?>)</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Student in Class</li>
                    </ol>
            </div>
            <div class="row">
                        <form method="post">
                            <!-- input class -->
                            <div class="card-input">
                <div class="card">
                    <h3>ALL Student in (<?php echo $rrw['className'] ?>)</h3>
                    <h3>Note"<i>Click on the checkboxes besides each student to take attendance!</i></h3>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Roll Number</th>
                                <th>Email Address</th>
                                <th>class</th>
                                <th>Check</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT tblstudents.Id,tblclass.className, tblstudents.firstName,
                                tblstudents.lastName,tblstudents.emailAddress,tblstudents.rollNumber,tblstudents.dateCreated
                                FROM tblstudents
                                INNER JOIN tblclass ON tblclass.Id = tblstudents.classId;";
                                $rs = $conn->query($query);
                                $num = $rs->num_rows;
                                $sn=0;
                                if($num > 0)
                                {
                                    while ($rows = $rs->fetch_assoc()) {
                                        $sn = $sn + 1;
                                        echo "
                                        <tr>
                                        <td>".$sn."</td>
                                        <td>".$rows['firstName']."</td>
                                        <td>".$rows['lastName']."</td>
                                        <td>".$rows['rollNumber']."</td>
                                        <td>".$rows['emailAddress']."</td>
                                        <td>".$rows['className']."</td>
                                        <td><input type='checkbox' name='check[]' value=".$rows['admissionNumber']." class='form-control'>
                                        </td>
                                        </tr>";
                                        echo "<input name='admissoionNO[]' value=".$rows['admissionNumber']." type='hidden' class='form-control'>";
                                    }
                                }
                                else
                                {
                                    echo
                                    "<div class='alert'> NO Record Found! </div>";
                                }
                            ?>
                        </tbody>
                    </table>
                    <br>
                <button type="submit" name="save" class="btn btn-primary">Take Attendance</button>
                </form>
            </div>
                </div>
    </section>
</body>
</html>