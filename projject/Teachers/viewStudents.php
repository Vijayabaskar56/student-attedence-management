<?php 
    session_start();
    include '../include/dbcon.php';
    include 'include/nav.php';

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
    <style>

.card-body {
    display: flex;
    background-color: azure;
    justify-content: center;
    align-items: center;
    width: 75vw;
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

            <div class="container-fluid">
                <h1 class="h3">Create Student in Class (<?php echo $rrw['className']; ?>)</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">/All Student in Class</li>
                    </ol>
            </div>


                <!-- input class -->
                <div class="card-input">
                <div class="card">
                    <h3>ALL Student in Classes</h3>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Roll Number</th>
                                <th>Email Address</th>
                                <th>class</th>
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
                <!-- <div class="row">
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
                </div> -->
        </div>
    </div>
    </section>
</body>
</html>