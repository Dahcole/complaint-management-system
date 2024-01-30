<?php
session_start();
?>

<?php
if(isset($_SESSION['admin'])){
    ?>
    <!DOCTYPE html>
    <html dir="ltr" lang="en">

    <head>
            <title> Complaints SubCategories | Complaints Management System - Yaba College of Technology </title>
        <?php include "inc/header.php"; ?>

        <title> Complaints SubCategories | Complaints Management System - Yaba College of Technology </title>

    </head>

    <body>

    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <?php include 'inc/preloader.php'; ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include 'inc/top-bar.php'?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include 'inc/side-bar.php'?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"> Complaints Sub Categories</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>admin">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Complaints Sub Categories</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <a href="javascript:void();" class="btn btn-success" style="display: inline-block; margin-bottom: 3px;" data-toggle="modal" data-target="#add-subcategory"> <i class="fa fa-plus"></i> Add SubCategory</a>
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $sql = "SELECT COUNT(subcatid) FROM complaints_subcategory";
                                $conn->query($sql);
                                $total_subcategories = $conn->fetchColumn();
                                ?>
                                <h5 class="card-title">Total SubCategories Found: <span style="color:  #28b779; font-weight: bold;"><?php echo $total_subcategories;  ?></span></h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead style="background: #ffb848; font-weight: bold; font-size: 16px;">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $sql = "SELECT * FROM complaints_subcategory JOIN complaints_category cc on complaints_subcategory.category_id = cc.id";
                                        $conn->query($sql);
                                        $row_count = $conn->rowCount();
                                        $result = $conn->fetchMultiple();

                                        ?>

                                        <?php
                                        if($row_count > 0){
                                            $count = 1;
                                            foreach ($result as $subcategory){
                                                $category_id = $subcategory->category_id;
                                                $subcategory_id = $subcategory->subcatid;
                                                $category_name = $subcategory->name;
                                                $subcategory_name = $subcategory->subcatname;
                                                $redirect = $conn->base_url()."admin/complaint-subcategories";

                                                ?>
                                                <tr>
                                                    <td><?= $count++; ?></td>
                                                    <td><?= $subcategory_name; ?></td>
                                                    <td><?= $category_name; ?></td>
                                                    <td>
                                                        <a href="javascript:void();" style="cursor:pointer;" data-toggle="modal" data-target="#edit-subcategory<?= $subcategory_id; ?>">
                                                            <i class="fa fa-edit" data-toggle="tooltip" title="Edit SubCategory"></i>
                                                        </a>

                                                        <a href="javascript:void();" style="cursor:pointer;" data-toggle="modal" data-target="#delete-subcategory<?= $subcategory_id; ?>">
                                                            <i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete SubCategory" style="color: #f00;"></i>
                                                        </a>


                                                    </td>

                                                </tr>

                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="4" class="text-center">You have not added any subcategories yet. Click on Add button above.</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                        <tfoot>

                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include 'inc/scripts.php'; ?>
            <script>
                /****************************************
                 *       Basic Table                   *
                 ****************************************/
                $('#zero_config').DataTable();
            </script>
            <?php
            foreach ($result as $subcategory){
                $category_id = $subcategory->category_id;
                $subcategory_id = $subcategory->subcatid;
                $category_name = $subcategory->name;
                $subcategory_name = $subcategory->subcatname;


                ?>
<!--                //update subcategory modal-->
                <div class="modal fade" id="edit-subcategory<?= $subcategory_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">×</span>
                                </button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <p>Edit Sub Category: <span class="text-warning"><?= $subcategory_name; ?></span></p>
                                    <label for="category_name" >Enter New Sub Category Name </label>
                                    <input type="text" name="subcategory_name" id="subcategory_name" value="<?= $subcategory_name; ?>" class="form-control">
                                    <input type="hidden" name="subcategory_id" value="<?= $subcategory_id; ?>">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" name="update_subcategory" value="Update SubCategory" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
<!--                //update subcategory modal-->

<!--                 Add subcategory modal-->
                <div class="modal fade" id="add-subcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add a new subcategory</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">×</span>
                                </button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                        <label for="category">Complaint Category <span style="color: orangered;">*</span></label>
                                        <?php
                                        //fetch all classes
                                        $sql = "SELECT * FROM complaints_category";
                                        $conn->query($sql);
                                        $details = $conn->fetchMultiple();

                                        ?>
                                        <select name="category_id" id="categoryID" class="category form-control is-valid" style="width: 100%; height:36px;" required>
                                            <option value="">Select category</option>
                                            <?php
                                            if ($conn->rowCount() > 0) {
                                                foreach ($details as $category) {
                                                    ?>
                                                <option value="<?php echo $category->id ?>">
                                                    <?php echo $category->name ?> </option><?php
                                                }
                                            } else {
                                                ?>
                                                <option value="">No categories found</option><?php
                                            }
                                            ?>
                                        </select><br>


                                    <label for="category_name" >Enter New SubCategory Name </label>
                                    <input type="text" name="subcategory_name" id="subcategory_name" placeholder="New SubCategory Name" class="form-control" required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" name="add_subcategory" value="Add SubCategory" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--  Add subcategory modal-->

                <!--  Delete category modal -->
                <div class="modal fade" id="delete-subcategory<?= $subcategory_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete SubCategory <?= $subcategory_name; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">×</span>
                                </button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <p>Are you sure you want to delete Subcategory: <span class="text-warning"><?= $subcategory_name; ?></span>?</p>
                                    <input type="hidden" name="subcategory_id" value="<?php echo $subcategory_id; ?>">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" name="delete_subcategory" value="Delete SubCategory" class="btn btn-danger">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--  Delete category modal -->

                <?php

            }

            if(isset($_POST['update_subcategory'])){
                $subcategory_id = $_POST['subcategory_id'];
                $subcategory_name = $_POST['subcategory_name'];
                $redirect = $conn->base_url().'admin/complaint-subcategories';


                $sql = "UPDATE complaints_subcategory SET subcatname =:name WHERE subcatid =:id";
                $conn->query($sql);
                $conn->bind(":id", $subcategory_id);
                $conn->bind(":name", $subcategory_name);
                try {
                    $conn->execute();
                    echo "<script>
              toastr['success']('Sub Category Updated Successfully.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

                }catch (PDOException $err){
                    $error =  $err->getMessage();
                    echo "<script>
              toastr['error']('An error occurred while updating sub category.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";
                }
            }

            if(isset($_POST['add_subcategory'])){
                $subcategory_name = $_POST['subcategory_name'];
                $category_id= $_POST['category_id'];
                $redirect = $conn->base_url().'admin/complaint-subcategories';


                $sql = "INSERT INTO complaints_subcategory (category_id, subcatname) VALUES (:cat_id, :subcatname)";
                $conn->query($sql);
                $conn->bind(":subcatname", $subcategory_name);
                $conn->bind(":cat_id", $category_id);
                try {
                    $conn->execute();
                    echo "<script>
              toastr['success']('SubCategory Inserted Successfully.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

                }catch (PDOException $err){
                    $error =  $err->getMessage();
                    echo "<script>
              toastr['error']('An error occurred while inserting subcategory.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";
                }
            }

            if(isset($_POST['delete_subcategory'])){
                $subcategory_id = $_POST['subcategory_id'];
                $redirect = $conn->base_url().'admin/complaint-subcategories';


                $sql = "DELETE FROM complaints_subcategory WHERE subcatid =:id";
                $conn->query($sql);
                $conn->bind(":id", $subcategory_id);
                try {
                    $conn->execute();
                    echo "<script>
              toastr['success']('SubCategory Deleted Successfully.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

                }catch (PDOException $err){
                    $error =  $err->getMessage();
                    echo "<script>
              toastr['error']('An error occurred while deleting subcategory.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";
                }
            }



            ?>

    </body>

    </html>
<?php }else{

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title> Login to continue |  Complaints Management System - Yaba College of Technology </title>

        <?php include "inc/header.php"; ?>

        <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    </head>
<body style='background: #e0e0e0; '>
<div class="container" style="margin-top: 20%;">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="section-title text-center">
                <h6>Access denied</h6>
                <div class="spinner-border text-info" role="status">
                    <span class="sr-only"></span>
                    <meta http-equiv='refresh' content='4; <?php echo $login_redirect; ?>'>
                </div>
                <p>You need to login to view this page.</p>
            </div>
        </div>
    </div>
</div>

    <?php
}?>
