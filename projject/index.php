<?php
    include './include/dbcon.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAM</title>
    <style>

        body {
            background-color: aliceblue;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            padding: 20px;
            transform: translate(-50%,-50%);
            background-color: burlywood;
            border: black 2px round;
        }
    </style>
</head>
<body>
    <div class="container">
    <div>
        <h2>STUDENT ATTENDANCE SYSTEM</h2>
    </div>
    <div>
        <h3>Login Panel</h3>
    </div>
    <form class="form" method="POST" action="">
        <div class="form-grp">
            <select name="userType" class="form-control1">
                <option value="">--Select User Role--</option>
                <option value="Admin">Admin</option>
                <option value="Teachers">Teachers</option>
                <!-- <option value="Student">Student</option> -->
            </select>
            <input type="text" class="form-control2" required name="userName" id="exampleInputEmail" placeholder="Enter Email Address">
            <input type="text" class="form-control3" required name="userPass" id="exampleInputPass" placeholder="Enter the Password">
            
            <div class="form-group">
                    <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <!-- <label class="custom-control-label" for="customCheck">Remember Me</label> -->
            </div>
            <div class="form-grp-btn">
                <input  class="btn btn-success btn-block" type="submit" value = "Login" name="login" />
            </div>
        </div>
    </form>
    </div>
    
    <?php

    if(isset($_POST['login'])) {
        $userType = $_POST['userType'];
        $userName = $_POST['userName'];
        $password = $_POST['userPass'];
        

        if($userType == "" || $userName == "" || $password == "") {
            echo "<div class='alert alert-msg' role='alert'>Please fill all fields</div>";
        }else {
            $passsword = md5($password);
            if($userType == "Admin") {
                $query = "SELECT * FROM tbladmin WHERE emailAddress = '$userName' AND password = '$passsword'";
    
                $rs = $conn->query($query);
                $num = $rs->num_rows;
                $rows = $rs->fetch_assoc();
    
                if($num > 0) {
                    $_SESSION['$userID'] = $rows['Id'];
                    $_SESSION['$firstName'] = $rows[ 'firstName'];
                    $_SESSION['$lastName'] = $rows['lastName'];
                    $_SESSION['$emailAddress'] = $rows['emailAddress'];
    
                    header("Location: ./Admin/index.php");
                    exit();
                }
                else {
                    echo "<div class='alert alert-msg' role='alert'>Invalid Username/Password!</div>";
                }
            }
            else if($userType == "Teachers") {
                    $query = "SELECT * FROM tblClassteacher WHERE emailAddress = '$userName' AND password = '$passsword'";
            
                    $rs = $conn->query($query);
                    $num = $rs->num_rows;
                    $rows = $rs->fetch_assoc();
                    echo $rows;
                    if($num > 0) {
                        $_SESSION['$userID'] = $rows['Id'];
                        $_SESSION['$firstName'] = $rows['firstName'];
                        $_SESSION['$lastName'] = $rows['lastName'];
                        $_SESSION['$emailAddress'] = $rows['emailAddress'];
                        $_SESSION['$classId'] = $rows['classId'];
        
                        header("Location: ./Teachers/index.php");
                        exit();
                    }
                    else {
                    echo "<div class='alert alert-msg' role='alert'>
                        Invalid Username/Password!
                        </div>";
                    }
                }
            elseif($userType == "Student") {
                    $query = "SELECT * FROM tblStudents WHERE emailAddress = '$userName' AND password = '$passsword'";

                    $rs = $conn->query($query);
                    $num = $rs->num_rows;
                    echo $num;
                    $rows = $rs->fetch_assoc();

                    if($num > 0) {
                        $_SESSION['$userID'] = $rows['Id'];
                        $_SESSION['$firstName'] = $rows['firstName'];
                        $_SESSION['$secondName'] = $rows['secondName'];
                        $_SESSION['$emailAddress'] = $rows['emailAddress'];
                        $_SESSION['$classId'] = $rows['classId'];

                        header("Location: ./Student/index.php");
                        exit();
                    }
                }
                else {
                    echo "<div class='alert alert-msg' role='alert'>Please select user type</div>";
                }
            }
        }
    ?>
</body>
</html>