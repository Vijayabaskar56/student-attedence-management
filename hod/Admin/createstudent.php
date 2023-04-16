<?php 
    session_start();
    include '../includes/dbcon.php';

    //------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
    $Name = $_POST['Name'];
    $emailId = $_POST['emailId'];
    $rollNumber=$_POST['rollNo'];
    $class=$_POST['class'];
    $dateCreated = date("Y-m-d");

    $query=mysqli_query($conn,"SELECT * from tblstudent where rollNo ='$rollNumber'");
    $ret=mysqli_fetch_array($query);

    if($ret > 0){ 

        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>This Email Address Already Exists!</div>";
    }
    else{

    $query=mysqli_query($conn,"INSERT into tblstudent(Name,emailId,rollNo,password,class,dateCreated) 
    value('$Name','$emailAddress','$rollNo','12345','$class','$dateCreated')");

    if ($query) {
        
        $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Created Successfully!</div>";
            
    }
    else
    {
        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
    }
    }
}

//---------------------------------------EDIT-------------------------------------------------------------






//--------------------EDIT------------------------------------------------------------

 if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
	{
        $Id= $_GET['Id'];

        $query=mysqli_query($conn,"select * from tblstudents where Id ='$Id'");
        $row=mysqli_fetch_array($query);

        //------------UPDATE-----------------------------

        if(isset($_POST['update'])){
            $firstName=$_POST['firstName'];
            $lastName=$_POST['lastName'];
            $emailAddress = $_POST['emailAddress'];
            $rollNumber=$_POST['rollNumber'];
            $class=$_POST['class'];
            $dateCreated = date("Y-m-d");

    $query=mysqli_query($conn,"update tblstudents set firstName='$firstName', lastName='$lastName',
    emailAddress='$emailAddress', rollNumber='$admissionNumber',password='12345', class='$class',classArmId='$classArmId'
    where Id='$Id'");
            if ($query) {
                
                echo "<script type = \"text/javascript\">
                window.location = (\"createStudent.php\")
                </script>"; 
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
        }
    }


//--------------------------------DELETE------------------------------------------------------------------

if(isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
    {
        $Id = $_GET['Id'];  
        $query = mysqli_query($conn,"DELETE FROM tblstudents WHERE Id='$Id'");
        
        if($query == TRUE){
            echo "<script type= \"text/javascript\">window.location = (\"createStudent.php\")</script>";
        }
        else {
            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
        }
    }
?>


?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../Admin/Includes/title.php'; ?>
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
            <h3 class="h3">Create Students</h3>
            <ol class="breadcurmb"> 
                <li class="breadcurmb-item"><a href="./">Home</a></li>
                <li class="breadcurmb-item" aria-current="page" >Create Students</li>
            </ol>

            <div class="row">
                <!-- form-basic  -->
                <div class="card">
                    <h6>Create Students</h6>
                    <!-- <?php echo $statusMsg ?> -->
                    <div class="card-body">
                        <form method="post">
                        <div class="input-container">
                    <label class="form-control-label">Name</label>
                    <input type="text"  name="Name" value="<?php echo isset($row['Name']) ? $row['Name'] : ''; ?>" id="exampleInputFirstName" class="formcontrol"><br>
                    <!-- <label class="form-control-label">LastName</label>
                    <input type="text"  name="lastName" value="<?php echo isset($row['lastName']) ? $row['lastName'] : ''; ?>" id="exampleInputFirstName" class="formcontrol"><br> -->
                    <label class="form-control-label">Roll No</label>
                    <input type="text"  name="rollNumber" value="<?php echo isset($row['rollNo']) ? $row['rollNo'] : ''; ?>" id="exampleInputFirstName" class="formcontrol"><br>
                    <label class="form-control-label">Email Address</label>
                    <input type="text"  name="emailAddress" value="<?php echo isset($row['emailId']) ? $row['emailId'] : ''; ?>" id="exampleInputFirstName" class="formcontrol"><br> 
                    <label class="form-control-label">Select Class</label>
                    <?php 
                        $qry = "SELECT * FROM tblclass ORDER BY className ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;

                        if($num > 0) {
                            echo '<select required name="class" class="formcontrol" onchange="classArmDropdown(this.value)" >';
                            echo '<option value="">--Select Class</option>';
                            while ($rows = $result->fetch_assoc()){
                                echo '<option value="'.$rows['class'].'">'.$rows['className'].'</option>';
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
                </div>
            </div>
        </div>

                    <!-- Input Group -->
                    <div class="table-container">
                <h3>All Class Teacher</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead">
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Roll No</th>
                            <th>Email Id</th>
                            <th>Date Created</th>
                            <th>Class</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $query = "SELECT DISTINCT tblclass.className, tblstudent.Name, tblstudent.emailId, tblstudent.rollNo, tblstudent.dateCreated FROM tblstudent INNER JOIN tblclass ON tblstudent.class = tblclass.classId";
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
                                            <td>".$rows['Name']."</td>
                                            <td>".$rows['emailId']."</td>
                                            <td>".$rows['rollNo']."</td>
                                            <td>".$rows['dateCreated']."</td>
                                            <td>".$rows['className']."</td>
                                            <td><a href='?action=edit&Id=".$rows['Id']."'><i class='bx bxs-edit'></i>Edit</a></td>
                                            <td><a href='?action=delete&Id=".$rows['Id']."'><i class='bx bxs-trash-alt'></i>Delete</a></td>
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
</section>
</body>
</html>