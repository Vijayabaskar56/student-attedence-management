<?php
    session_start();
    include '../include/dbcon.php';
    // include '../includes/session.php';

    // -----------------------Save------------------------------------------------------------------- 
    if (isset($_POST['save'])) {

        $className = $_POST['className'];

        $query=mysqli_query($conn,"SELECT * from tblclass where className = '$className'");
        
        $row =mysqli_fetch_array($query);

        if ($row > 0) {
            $statusMsg = "<div class='alert' style='margin-right:700px;'>This CLass is Already Exists!</div>";
        }
        else{
            $query=mysqli_query($conn,"INSERT into tblclass(className) value('$className')");

            if ($query == TRUE) {
                $statusMsg = "<div class='alert'  style='margin-right:700px;'>Created Successfully!</div>";
            }
            else {
                $statusMsg = "<div class='alert' style='margin-right:700px'>An error Occurred!</div>";
            }
        }
    }

    // -------------------------EDIT------------------------
    if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit") {
    {
        $Id=$_GET['Id'];
        $query= mysqli_query($conn,"SELECT * from tblclass where Id = '$Id'");
        $row = mysqli_fetch_array($query);

        // -------------UPDATE--------------
        if(isset($_POST['update'])){
            $className=$_POST['className'];
            $query=mysqli_query($conn,"UPDATE tblclass set className='$className' where Id='$Id'");

            if ($query == TRUE) {
                echo "<script type = \"text/javascript\">
                window.location = (\"createClass.php\")
                </script>";
            }
            else{
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
        }
    } 
    }


    // -------------------------DELETE-------------------------
    if(isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
    {
        $Id = $_GET['Id'];
        $query = mysqli_query($conn,"DELETE FROM tblclass WHERE Id='$Id'");
        
        if($query == TRUE) {
            echo "<script type = \"text/javascript\">
            window.location = (\"createClass.php\")
            </script>";
        }
        else {
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
    <?php include 'include/title.php'; ?>
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
<body id="page-top">
    
    <section class="home-section">
    <div class="home-content">
                <i class= 'bx bx-menu' ></i>
                <span class="text">Attandace Management System</span>
            </div>
        <div class="wrapper">
        <!-- sidebar -->
        <?php include 'include/nav.php' ?>
        <!-- container fluid -->
        <div class="container-fluid">
        <h1 class="h3">Create Class</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">/Create Class</li>
        </ol>
        </div>

        <div class="form-basic">
            <!-- form-basic -->
            <div class="card">
                <h3 class="h3">Create Class</h3>
                <!-- <?php echo $statusMsg; ?> -->
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <label for="" class="form-control-label">Class Name</label>
                    <input type="text" name="className" value="<?php echo isset($row['className']) ? $row['className'] : ''; ?>" id="exampleInputFirstName" class="formcontrol" placeholder="Class Name" >
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
                </form>
            </div>
            <?php ?>
            
            <!-- input class -->
            <div class="card-input">
                <div class="card">
                    <h3>ALL Classes</h3>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Class Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $query = "select * from tblclass";
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
                                        <td>".$rows['className']."</td>
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
                <div class="row">
                    <div class="col">
                        <div class="dataTables_info" id="dataTableHover_info" role="status" aria-live="polite">Showing 1 to 4 of 4 entries</div>
                    </div>
                    <div class="col">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTableHover_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="dataTableHover_previous">
                                    <a href="#" aria-controls="dataTableHover" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                </li>
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="dataTableHover" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                </li>
                                <li class="paginate_button page-item next disabled" id="dataTableHover_next">
                                    <a href="#" aria-controls="dataTableHover" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <?php include 'include/footer.php'; ?>
    </section>
</body>
</html>