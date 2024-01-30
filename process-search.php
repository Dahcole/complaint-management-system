<?php
//error_reporting(0);
session_start();
require dirname(__DIR__) . "/project/vendor/autoload.php";
$conn= new Functions();
$main_url = $conn->base_url();


$output = '';

if(isset($_POST['query'])){
    $search = $_POST['query'];
    $sql = "SELECT * FROM modules WHERE name LIKE CONCAT('%', :search, '%')";
    $conn->query($sql);
    $conn->bind(":search", $search);
}else{
    $sql = "SELECT * FROM modules";
}

$result = $conn->fetchMultiple();

//check if query succeeds
if($conn->rowCount() > 0){
    $output = "<div class='row'>
    <div class='col-md-12' style=' height: auto; overflow: auto;'>";
    foreach ($result as $details) {
        $module_icon = $details->icon;
        $module_name = $details->name;
        $module_url = $conn->base_url().$details->link;
        $output .= " <p style='background: #fff;' class='search'>
                          <a href=\"$module_url\"> <i class='$module_icon' width=\"60\" height=\"60\" style='border-radius: 10px; color: #28b779;'></i>
                           <span style=\"margin-top: 8px; display: inline-block;margin-left: 10px; color: #1f262d;\" class='name_title'>$module_name</span>
                          </a>
                      </p>";
    }
    $output .= "</div></div>";
    echo $output;
}else{
    echo '<p style="text-align: center">Sorry we couldn\'t find any module that matches your criteria.</p>';
}
