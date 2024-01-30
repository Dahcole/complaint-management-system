<?php
//error_reporting(0);
session_start();
require dirname(__DIR__) . "/vendor/autoload.php";
$conn = new Functions();

$error = '';
$old_password = '';
$new_password = '';
$user = $_POST['username'];
$redirect = $conn->base_url().'admin/login';


if (empty($_POST["old_password"])) {
    $error .= '<p style="padding: 30px;color: red;">Old password is required.</p>';
} else {
    $old_password = $_POST["old_password"];
}

if (empty($_POST["new_password"])) {
    $error .= '<p style="padding: 30px;color: red;">New password is required.</p>';
} else {
    $new_password = $_POST["new_password"];
}
if ($_POST['confirm_new_password'] != $_POST["new_password"]){
    $error .= '<p style="padding: 30px;color: red;">New password must match with confirm password</p>';
} else {
    $confirm_new_password = $_POST["confirm_new_password"];
}

if ($error == '') {
//check if old password is correct
//    $old_password = $course->Password_Encryption($_POST['old_password']);
//    $error.= $old_password;
    $sql = "SELECT * FROM admin WHERE username =:user";
    $conn->query($sql);
    //bind param
    $conn->bind(":user", $user);
    //fetch data
    $result = $conn->fetchSingle();
    $db_password = $result->password;
    $existing_password = $conn->password_check($old_password, $db_password);
    $crypt_new_password = $conn->password_check($new_password, $db_password);
    //check if entered password matches with db
    if (!$existing_password) {
        $error .= '<p style="padding: 30px;color: red;">Old password is wrong</p>';
    } elseif ($crypt_new_password == $new_password) {
        $error .= '<p style="padding: 30px;color: red;">You cannot use the same password.</p>';
    } else {
        //all checks passed, update users password
        $sql = "UPDATE admin SET password =:password WHERE username =:user";
        $conn->query($sql);
        $conn->bind(":password", $conn->Password_Encryption($new_password));
        $conn->bind(":user", $user);
        try {
            //execute
            $conn->execute();
            $error .= '<p style="padding: 30px;color: #23a768;"">Password Updated Successfully. <button class="btn btn-info" onclick="window.location.reload()" >Back to login</button>';
             session_destroy();
        } catch (PDOException $err) {
            $error .= $err->getMessage();
        }
    }

}

$data = array(
    'error' => $error
);

echo json_encode($data);


