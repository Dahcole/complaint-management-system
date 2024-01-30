<?php
//error_reporting(0);
session_start();
require dirname(__DIR__) . "/project/vendor/autoload.php";
$login= new Functions();

if(!empty($_POST['matric_no']) && !empty($_POST['password'])){
    $matric_no = $_POST['matric_no'];
    $password = $_POST['password'];

    //perform validations for matric no
    if(!$login->loginCheck($matric_no, $password)){

        echo "<script>
              toastr['error']('Incorrect Matric No or Password Combination');
           </script>";

    }else{
        // All checks passed, process login
        $sql = "SELECT * FROM user WHERE matric_no =:matric_no AND account_status =:active";
        $login->query($sql);
        $login->bind(":matric_no", $_POST['matric_no']);
        $login->bind(":active", 'active');
        try{
            $result = $login->fetchSingle();
            $username = $result->username;
            $_SESSION['username'] = $username;

            echo "<script>
              toastr['success']('Login Successful.');
           </script><meta http-equiv='refresh' content='4; index'>";

            echo  "<div class='spinner-border text-info text-center' role='status'>
                    <span class='sr-only'></span>
                </div>";
        }catch (PDOException $err){

            echo "<script>
              toastr['error']('An internal error occurred. Pls try again.');
           </script>";
        }

    }
}else{
    echo "<script>
              toastr['error']('Both fields are required.');
           </script>";
}
