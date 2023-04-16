<?php
    include './includes/dbcon.php';
    session_start();
    include 'index.html'
?>

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
            $query = "SELECT * FROM tbladmin WHERE emailId = '$userName' AND password = '$passsword'";

            $rs = $conn->query($query);
            $num = $rs->num_rows;
            $rows = $rs->fetch_assoc();

            if($num >= 0) {
                // $_SESSION['userID'] = $rows['adminId'];
                $_SESSION['Name'] = $rows['Name'];
                // $_SESSION['$lastName'] = $rows['lastName'];
                $_SESSION['emailId'] = $rows['emailId'];

                header("Location: Admin/index.php");
                exit();
            }
            else {
                echo "<div class='alert alert-msg' role='alert'>Invalid Username/Password!</div>";
            }
        }
        else if($userType == "Teachers") {
                $query = "SELECT * FROM tblprofessor WHERE emailId = '$userName' AND password = '$passsword'";
        
                $rs = $conn->query($query);
                $num = $rs->num_rows;
                $rows = $rs->fetch_assoc();
                echo $rows;
                if($num > 0) {
                    $_SESSION['userID'] = $rows['staffID'];
                    $_SESSION['Name'] = $rows['name'];
                    // $_SESSION['$lastName'] = $rows['lastName'];
                    $_SESSION['emailId'] = $rows['emailId'];
                    // $_SESSION['$classId'] = $rows['classId'];
    
                    header("Location: Professor/index.php");
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