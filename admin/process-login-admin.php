<?php
//error_reporting(0);
session_start();
require dirname(__DIR__) . "/admin/vendor/autoload.php";
$login= new Functions();

if(!empty($_POST['username']) && !empty($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //perform validations for matric no
    if(!$login->loginCheckAdmin($username, $password)){

        echo "<script>
              toastr['error']('Incorrect Username or Password Combination');
           </script>";

    }else{
        // All checks passed, process login
        $sql = "SELECT * FROM admin WHERE username =:username";
        $login->query($sql);
        $login->bind(":username", $_POST['username']);
        try{
            $result = $login->fetchSingle();
            $username = $result->username;
            $_SESSION['admin'] = $username;

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