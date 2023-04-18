
<?php 
error_reporting(0);
include '../include/dbcon.php';
include '../include/session.php';

//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
    $batchName=$_POST['batchName'];
    $semId=$_POST['semId'];
    $dateCreated = date("Y-m-d");

    $query=mysqli_query($conn,"select * from tblsemterm where batchName ='$batchName' and semId = '$semId'");
    $ret=mysqli_fetch_array($query);

    if($ret > 0){ 

        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>This Session and Term Already Exists!</div>";
    }
    else{

        $query=mysqli_query($conn,"insert into tblsemterm(batchName,semId,isActive,dateCreated) value('$batchName','$semId','0','$dateCreated')");

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

        $query=mysqli_query($conn,"select * from tblsemterm where Id ='$Id'");
        $row=mysqli_fetch_array($query);

        //------------UPDATE-----------------------------

        if(isset($_POST['update'])){
    
          $batchName=$_POST['batchName'];
          $semId=$_POST['semId'];
          $dateCreated = date("Y-m-d");
        
            $query=mysqli_query($conn,"update tblsessionterm set batchName='$batchName',termId='$semId',isActive='0' where Id='$Id'");

            if ($query) {
                
                echo "<script type = \"text/javascript\">
                window.location = (\"createTerm.php\")
                </script>"; 
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
        }
    }


//--------------------------------DELETE------------------------------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
        $Id= $_GET['Id'];

        $query = mysqli_query($conn,"DELETE FROM tblsemterm WHERE Id='$Id'");

        if ($query == TRUE) {

                echo "<script type = \"text/javascript\">
                window.location = (\"createTerm.php\")
                </script>";  
        }
        else{

            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>"; 
        }
      
  }


  //--------------------------------ACTIVATE------------------------------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "activate")
	{
        $Id= $_GET['Id'];

        $query=mysqli_query($conn,"update tblsemterm set isActive='0' where isActive='1'");

            if ($query) {
                
                $que=mysqli_query($conn,"update tblsemterm set isActive='1' where Id='$Id'");

                if ($que) {
                    
                    echo "<script type = \"text/javascript\">
                    window.location = (\"createTerm.php\")
                    </script>";  
                }
                else
                {
                    $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
                }
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
      
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include '../Admin/Includes/title.php' ?>
  <style>

.card-body {
    display: flex;
    background-color: azure;
    justify-content: center;
    align-items: center;
    width: 82vw;
    height: 25vh;
}

.breadcrumb-item {
    list-style-type:none;
    display: inline;
    margin: 0%;
}

table {
    border: none;
    width: 100%;
}

thead {
    background-color: darkgray;
}

tbody {
    background-color: whitesmoke;
}

</style>
</head>
<body>
<section class="home-section">
    <div class="home-content">
                <i class= 'bx bx-menu' ></i>
                <span class="text">Attandace Management System</span>
            </div>
        <div class="wrapper">
        <!-- sidebar -->
        <?php include 'include/nav.php' ?>
        <!-- Container Fluid  -->
        <div class="container-fluid">
          <h3 class="h3">Create Sem and Term</h3>
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">/Create Session and Term<</li>
          </ol>

          <div class="row">
            <!-- Form Basic  -->
            <div class="card">
              <h6>Create Sem and Term</h6>
              <!-- <?php echo $statusMsg; ?> -->
              <div class="card-body">
                <form method="post">
                <label for="" class="form-control-label">Batch</label>
                <input type="text" name="batchName" value="<?php echo isset($row['batchName']) ? $row['batchName'] : ''; ?>" id="exampleInputFirstName" class="formcontrol" placeholder="Batch" >
                <label for="" class="form-control-label">Semester</label>
                <?php
                        $qry= "SELECT * FROM tblsem ORDER BY semName ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;		
                        if ($num > 0){
                          echo ' <select required name="semId" class="form-control">';
                          echo'<option value="">--Select Sem--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['Id'].'" >'.$rows['semName'].'</option>';
                              }
                                  echo '</select>';
                              }
                            ?>
                               <?php
                    if (isset($Id))
                    {
                    ?>
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    } else {           
                    ?>
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php
                    }         
                    ?>
                        </div>
                        
                    </div>
                </form>
              </div>
            </div>
            <!-- input class -->
            <div class="card-input">
                <div class="card">
                    <h6>Create Batch and Semester</h6>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Session</th>
                                <th>Term</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Activate</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $query = "SELECT DISTINCT tblsemterm.Id,tblsemterm.batchName,tblsemterm.isActive,tblsemterm.dateCreated, tblsem.semName FROM tblsemterm INNER JOIN tblsem ON tblsem.Id = tblsemterm.semId";
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
                                        <td>".$rows['batchName']."</td>
                                        <td>".$rows['semName']."</td>
                                        <td>".$rows['isActive']."</td>
                                        <td>".$rows['dateCreated']."</td>
                                        <td><a href='?action=activate&Id=".$rows['Id']."'><center><i class='bx bx-check'></i></center></a></td>
                                        <td><a href='?action=edit&Id=".$rows['Id']."'><i class='bx bxs-edit'></i>Edit</a></td>
                                        <td><a href='?action=delete&Id=".$rows['Id']."'><i class='bx bxs-trash-alt'></i>Delete</a></td>
                                        </tr>
                                        ";
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
          </div>
        </div>
        <?php include 'include/footer.php'; ?>
</section>
</body>
</html>