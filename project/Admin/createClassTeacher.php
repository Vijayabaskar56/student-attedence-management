<?php
    session_start();
    include '../includes/dbcon.php';

// ----------------------------SAVE-------------------

if(isset($_POST['save'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $emailAddress = $_POST['emailAddress'];
    $phoneNo = $_POST['phoneNo'];
    $classId = $_POST['classId'];
    $dateCreated = date("Y-m-d");

    $query = mysqli_query($conn,"SELECT * from tblclassteacher where emailAddress = '$emailAddress'");
    $ret = mysqli_fetch_array($query);

    $sampPass = "pass123";
    $sampPass_2 = md5($sampPass);

    if($ret > 0){
        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>This Email Address Already Exists!</div>";
    }
    else {
        $query = mysqli_query($conn,"INSERT INTO tblclassteacher(firstName,lastName,emailAddress,password,phoneNo,classId,dateCreated)value('$firstName','$lastName','$emailAddress','$sampPass_2','$phoneNo','$classId','$dateCreated')");

        if($query == true) {
            $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Created Successfully!</div>";
        }
        else {
            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
        }
    }
}


// ----------------------------EDIT-------------------------------------------------------------------------------------------------------------------------


// ----------------------------------------DELETE-------------------------------------------------------------------------------------


if(isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
    {
        $Id = $_GET['Id'];  
        $query = mysqli_query($conn,"DELETE FROM tblclassteacher WHERE Id='$Id'");
        
        if($query == TRUE){
            echo "<script type= \"text/javascript\">window.location = (\"createClassTeacher.php\")</script>";
        }
        else {
            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
        }
    }
?>



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<section class="home-section">
    <div class="home-content">
                <i class= 'bx bx-menu' ></i>
                <span class="text">Attandace Management System</span>
            </div>
        <div class="wrapper">
        <!-- sidebar -->
        <?php include 'Includes/nav.php' ?>
        <!-- container fluid -->
        <div class="container-fluid">
        <h1 class="h3">Create Class</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Class</li>
        </ol>
        </div>

        <div class="form-basic">
            <!-- form-basic -->
            <div class="card">
                <h3 class="h3">Create Class Teachers</h3>
                <!-- <?php echo $statusMsg; ?> -->
            </div>
            <div class="card-body">
                <form action="" method="post">
                <div class="input-container">
                    <label class="form-control-label">FirstName</label>
                    <input type="text"  name="firstName" value="" id="exampleInputFirstName" class="formcontrol"><br>
                    <label class="form-control-label">LastName</label>
                    <input type="text"  name="lastName" value="" id="exampleInputFirstName" class="formcontrol"><br>
                    <label class="form-control-label">Email Address</label>
                    <input type="text"  name="emailAddress" value="" id="exampleInputFirstName" class="formcontrol"><br> 
                    <label class="form-control-label">Phone No</label>
                    <input type="text"  name="phoneNo" value="" id="exampleInputFirstName" class="formcontrol"><br>
                    <label class="form-control-label">Select Class</label>
                    <?php 
                        $qry = "SELECT * FROM tblclass ORDER BY className ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;

                        if($num > 0) {
                            echo '<select required name="classId" class="formcontrol" onchange="classArmDropdown(this.value)" >';
                            echo '<option value="">--Select Class</option>';
                            while ($rows = $result->fetch_assoc()){
                                echo '<option value="'.$rows['Id'].'">'.$rows['className'].'</option>';
                            }
                            echo '</select>';
                        }
                    ?>
                    </div>
                    <div class="input-submit">
                    <?php
                    if (isset($Id))
                    {
                    ?>
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    } else {           
                    ?>
                    <br><button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php
                    }
                    ?>
                    </div>
                </form>
            </div>

            <!-- Input Group -->
            <div class="table-container">
                <h3>All Class Teacher</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead">
                            <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Phone No</th>
                            <th>Class</th>
                            <th>Date Created</th>
                            <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $query = "Select tblclassteacher.Id,tblclass.className,tblclassteacher.firstName,tblclassteacher.lastName,tblclassteacher.emailAddress,tblclassteacher.phoneNo,tblclassteacher.dateCreated FROM tblclassteacher INNER JOIN tblclass";
                                $rs = $conn->query($query);
                                $num = $rs->num_rows;
                                $sn=0;
                                $status="";
                                if($num > 0)
                                {
                                    while($rows = $rs->fetch_assoc())
                                    {
                                        $sn = $sn + 1;
                                        echo "
                                        <tr>
                                            <td>".$sn."</td>
                                            <td>".$rows['firstName']."</td>
                                            <td>".$rows['lastName']."</td>
                                            <td>".$rows['emailAddress']."</td>
                                            <td>".$rows['phoneNo']."</td>
                                            <td>".$rows['className']."</td>
                                            <td>".$rows['dateCreated']."</td>
                                            <td><a href='?action=delete&Id=".$rows['Id']."'><i class='bx bx-trash-alt'></i></a></td>
                                        </tr>";
                                    }
                                }
                                else {
                                    echo "<div class='alert alert-danger' role='alert'>No Record Found!</div>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php include 'Includes/footer.php'; ?>
</body>
</html>
