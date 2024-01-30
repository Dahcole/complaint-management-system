<?php
//error_reporting(0);
session_start();
require dirname(__DIR__) . "/project/vendor/autoload.php";
$conn= new Functions();

if(!empty($_POST['matric_no']) && !empty($_POST['password']) && !empty($_POST['username'])){
    $matric_no = $_POST['matric_no'];
    $password = $_POST['password'];
     $username = $_POST['username'];


    $sql = "SELECT * FROM user WHERE username =:username";
    $conn->query($sql);
    $conn->bind(":username", $username);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Username already exists.');
           </script>";
        return false;

    }

     //perform validations for matric no

     $sql = "SELECT * FROM user WHERE matric_no =:no";
    $conn->query($sql);
    $conn->bind(":no", $matric_no);
    if($conn->rowCount() > 0){
        echo "<script>
              toastr['error']('Matric No already exists.');
           </script>";
        return false;
    }


    if(!$conn->Checkpassword($password)){
      echo "<script>
                  toastr['error']('Password must include one uppercase letter, one lowercase letter, one number,and one special character such as $ or % and length should be between 6 and 16.');
               </script>";
            return false;
    }else{
        // All checks passed, process login

         $hashed_password = $conn->Password_Encryption($password);

        $sql = "INSERT INTO user (username, password, matric_no)
          VALUES(:username, :password, :matric_no)";
        $conn->query($sql);
        $conn->bind(":matric_no", $_POST['matric_no']);
        $conn->bind(":username", $username);
        $conn->bind(":password", $hashed_password);
        try{
            $conn->execute();

            echo "<script>
              toastr['success']('Registration Successful.');
           </script><meta http-equiv='refresh' content='4; login'>";

            echo  "<div class='spinner-border text-info text-center' role='status'>
                    <span class='sr-only'></span>
                </div>";
        }catch (PDOException $err){

            $error = $err->getMessage();

            echo "<script>
              toastr['error']('An internal error occurred: $error');
           </script>";
        }

    }
}else{
    echo "<script>
              toastr['error']('All fields are required.');
           </script>";
}
