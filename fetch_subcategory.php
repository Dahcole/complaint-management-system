<?php
//error_reporting(0);
session_start();
require dirname(__DIR__) . "/project/vendor/autoload.php";
$conn = new Functions();

if(!empty($_POST['categoryID'])){
    $categoryID = $_POST['categoryID'];

    //fetch subcategory based on selected category id
    $sql = "SELECT * FROM complaints_subcategory WHERE category_id = :categoryID ORDER BY subcatname";
    $conn->query($sql);
    $conn->bind(":categoryID", $categoryID);
    //generate HTML of subcategory option option
    if($conn->rowCount() > 0){
        $result = $conn->fetchMultiple();

        ?> <option value=''>Select Subcategory</option><?php
        foreach ($result as $subcategory) {
            $subcategory_name = $subcategory->subcatname;
            ?> <option value="<?php echo $subcategory->subcatid; ?>"><?php echo $subcategory_name; ?></option><?php
        }
    }else{
        echo "<option value=''>Subcategory not found.</option>";
    }
}else{
    echo "<option value=''>error occurred.</option>";
}
