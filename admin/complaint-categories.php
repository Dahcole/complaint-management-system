<?php
session_start();
?>

<?php
if(isset($_SESSION['admin'])){
    ?>
    <!DOCTYPE html>
    <html dir="ltr" lang="en">

    <head>
            <title> Complaints Categories | Complaints Management System - Yaba College of Technology </title>
        <?php include "inc/header.php"; ?>



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
                        <h4 class="page-title"> Complaints Categories</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $base_url; ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Complaints Categories</li>
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
                        <a href="javascript:void();" class="btn btn-success" style="display: inline-block; margin-bottom: 3px;" data-toggle="modal" data-target="#add-category"> <i class="fa fa-plus"></i> Add Category</a>
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $sql = "SELECT COUNT(id) FROM complaints_category";
                                $conn->query($sql);
                                $total_categories = $conn->fetchColumn();
                                ?>
                                <h5 class="card-title">Total Categories Found: <span style="color:  #28b779; font-weight: bold;"><?php echo $total_categories;  ?></span></h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead style="background: #ffb848; font-weight: bold; font-size: 16px;">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $sql = "SELECT * FROM complaints_category";
                                        $conn->query($sql);
                                        $row_count = $conn->rowCount();
                                        $result = $conn->fetchMultiple();


                                        ?>

                                        <?php
                                        if($row_count > 0){
                                            $count = 1;
                                            foreach ($result as $category){
                                                $category_id = $category->id;
                                                $category_name = $category->name;
                                                $redirect = $conn->base_url()."admin/complaint-categories";

                                                ?>
                                                <tr>
                                                    <td><?= $count++; ?></td>
                                                    <td><?= $category_name; ?></td>
                                                    <td>
                                                        <a href="javascript:void();" style="cursor:pointer;" data-toggle="modal" data-target="#edit-category<?= $category_id; ?>">
                                                            <i class="fa fa-edit" data-toggle="tooltip" title="Edit Category"></i>
                                                        </a>

                                                        <a href="javascript:void();" style="cursor:pointer;" data-toggle="modal" data-target="#delete-category<?= $category_id; ?>">
                                                            <i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete Category" style="color: #f00;"></i>
                                                        </a>


                                                    </td>

                                                </tr>

                                                <?php
                                            }
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="3" class="text-center">You have not added any categories yet. Click on Add button above.</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                        <tfoot>

                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
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
            foreach ($result as $category){
                $category_id = $category->id;
                $category_name = $category->name;


                ?>
<!--                //update category modal-->
                <div class="modal fade" id="edit-category<?= $category_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">×</span>
                                </button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <p>Edit Category: <span class="text-warning"><?= $category_name; ?></span></p>
                                    <label for="category_name" >Enter New Category Name </label>
                                    <input type="text" name="category_name" id="category_name" value="<?= $category_name; ?>" class="form-control">
                                    <input type="hidden" name="category_id" value="<?= $category_id; ?>">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" name="update_category" value="Update Category" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
<!--                //update category modal-->

<!--                 Add category modal-->
                <div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add a new category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">×</span>
                                </button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <label for="category_name" >Enter New Category Name </label>
                                    <input type="text" name="category_name" id="category_name" placeholder="New Category Name" class="form-control">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" name="add_category" value="Add Category" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--  Add category modal-->

                <!--                 Delete category modal-->
                <div class="modal fade" id="delete-category<?= $category_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Category <?= $category_name; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">×</span>
                                </button>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <p>Are you sure you want to delete category: <span class="text-warning"><?= $category_name; ?></span>?</p>
                                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" name="delete_category" value="Delete Category" class="btn btn-danger">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--  Delete category modal-->

                <?php

            }

            if(isset($_POST['update_category'])){
                $category_id = $_POST['category_id'];
                $category_name = $_POST['category_name'];
                $redirect = $conn->base_url().'admin/complaint-categories';


                $sql = "UPDATE complaints_category SET name =:name WHERE id =:id";
                $conn->query($sql);
                $conn->bind(":id", $category_id);
                $conn->bind(":name", $category_name);
                try {
                    $conn->execute();
                    echo "<script>
              toastr['success']('Category Updated Successfully.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

                }catch (PDOException $err){
                    $error =  $err->getMessage();
                    echo "<script>
              toastr['error']('An error occurred while updating category.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";
                }
            }

            if(isset($_POST['add_category'])){
                $category_name = $_POST['category_name'];
                $redirect = $conn->base_url().'admin/complaint-categories';


                $sql = "INSERT INTO complaints_category(name) VALUES (:name)";
                $conn->query($sql);
                $conn->bind(":name", $category_name);
                try {
                    $conn->execute();
                    echo "<script>
              toastr['success']('Category Inserted Successfully.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

                }catch (PDOException $err){
                    $error =  $err->getMessage();
                    echo "<script>
              toastr['error']('An error occurred while inserting category.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";
                }
            }

            if(isset($_POST['delete_category'])){
                $category_id = $_POST['category_id'];
                $redirect = $conn->base_url().'admin/complaint-categories';


                $sql = "DELETE FROM complaints_category WHERE id =:id";
                $conn->query($sql);
                $conn->bind(":id", $category_id);
                try {
                    $conn->execute();
                    echo "<script>
              toastr['success']('Category Deleted Successfully.');
           </script><meta http-equiv='refresh' content='3; $redirect'>";

                }catch (PDOException $err){
                    $error =  $err->getMessage();
                    echo "<script>
              toastr['error']('An error occurred while deleting category.');
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
