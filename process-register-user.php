<?php
//error_reporting(0);
session_start();
require dirname(__DIR__) . "/complaint_system/vendor/autoload.php";
$conn= new Functions();

if(!empty($_POST['email']) && !empty($_POST['username'])
    && !empty($_POST['full_name']) && !empty($_POST['password'])
    && !empty($_POST['matric_no'])){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $username = ($_POST['username']);
    $password = ($_POST['password']);
    $matric_no = $_POST['matric_no'];


    //perform validations for email
    //check for email availability
    $sql = "SELECT * FROM user WHERE email =:email";
    $conn->query($sql);
    $conn->bind(":email", $email);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Email already exists.');
           </script>";
        return false;
    }
    $sql = "SELECT * FROM user WHERE name =:name";
    $conn->query($sql);
    $conn->bind(":name", $full_name);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Please choose a different name.');
           </script>";
        return false;
    }

    //check if matric no already exists

    $sql = "SELECT * FROM user WHERE matric_no =:no";
    $conn->query($sql);
    $conn->bind(":no", $matric_no);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Matric No already exists.');
           </script>";
        return false;
    }

    //check for username availability
    $sql = "SELECT * FROM user WHERE username =:username";
    $conn->query($sql);
    $conn->bind(":username", $username);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Username already exists.');
           </script>";
        return false;
    }else {

        //process  inserting of data into database
        $hashed_password = $conn->Password_Encryption($password);
        $sql = "INSERT INTO user (name, email, username, password, matric_no)
          VALUES(:full_name, :email, :username, :password, :matric_no)";
        $conn->query($sql);
        $conn->bind(":full_name", $full_name);
        $conn->bind(":email", $email);
        $conn->bind(":username", $username);
        $conn->bind(":password", $hashed_password);
        $conn->bind(":matric_no", $matric_no);

        $send = $conn->execute();
        if ($send) {
            $_SESSION['just_registered'] = $full_name;
            echo "<script>
              toastr['success']('Your registration was successful. Pls login to continue');
           </script><meta http-equiv='refresh' content='3; login'>";

        } else {
            echo "<script>
              toastr['error']('An error occurred.');
           </script><meta http-equiv='refresh' content='3; register'>";
        }
    }


}else{
    echo "<script>
              toastr['error']('All fields are required.');
           </script>";
}
