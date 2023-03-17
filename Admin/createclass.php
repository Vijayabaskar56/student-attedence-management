<?php
    include '../includes/dbcon.php';
    include '../includes/session.php';
?>

<!-- Save -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './Admin/Includes/title.php' ?>
</head>
<body id="page-top">
    <div class="wrapper">
        <!-- sidebar -->
        <?php include './Admin/Includes/nav.php' ?>
        <!-- container fluid -->
        <div class="container-fluid">
        <h1 class="h3">Create Class</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Class</li>
        </ol>
        </div>

        <div class="row">
            <!-- form-basic -->
            <div class="card">
                <h6 class="h3">Create Class</h6>
                <?php echo $statusMsg; ?>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <label for="" class="form-control-label">Class Name</label>
                    <input type="text" name="className" id="exampleInputFirstName" class="form0control" placeholder="Class Name" value="<?php echo $row['className']; ?>">
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
        </div>
    </div>
</body>
</html>