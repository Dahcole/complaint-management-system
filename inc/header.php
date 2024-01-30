
<?php
require dirname(__DIR__) . "/vendor/autoload.php";
$conn = new Functions();
$base_url = $conn->base_url();
$login_redirect = $conn->base_url() . 'login';

$username = $_SESSION['admin'];
//fetch admin email
$sql = "SELECT * FROM admin WHERE username =:username";
$conn->query($sql);
$conn->bind(":username", $username);
$result = $conn->fetchSingle();
$admin_email = $result->email;
$admin_name = $result->name;

?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $base_url; ?>assets/images/favicon.png">

<!-- Custom CSS -->
<link href="<?php echo $base_url; ?>dist/css/style.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet"  href="<?php echo $base_url; ?>assets/libs/select2/dist/css/select2.min.css">
<script src="<?php echo $base_url; ?>assets/ckeditor/ckeditor.js"></script>

<style>

  body{
    font-size: 12px;
  }

    #sidebarnav li span{
      font-size: 12px;
    }

    table th{
      font-size: 14px;
    }
    table td{
      font-size: 12px;
    }
    #main-wrapper div{
      font-size: 14px;
    }
    
    .sidebar-nav ul .sidebar-item .sidebar-link i{font-size: 17px;}
    .parsley-required, .parsley-pattern{color: #f00 !important;}
    .parsley-error{background: #f0b2b2;}
    .parsley-success{background: #b8eeb8;}
    .fa-trash{
        background:  #ff5b57;
        padding: 5px;
        border-radius: 2px;
        color: white;
        font-size: 11px;
        list-style: none;
    }

    .fa-check-circle{
        background: #49c3a0;
        padding: 5px;
        border-radius: 2px;
        color: white;
        font-size: 14px;
        list-style: none;
    }

     .parsley-pattern{
        color: #ffc107 !important;
        position: relative;
        left: 170px;
        bottom: 30px;
         list-style: none;
    }

    .parsley-type{
        position: relative;
        top: 5px;
        left: 60px;
        list-style: none;
        color: #ffc107 !important;
    }

    .parsley-errors-list, .filled{
        position: relative;
        left: -190px;
        top: 40px;
        display: inline-block;
        list-style: none;
    }

    .create-space{
        margin-bottom: 15px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered{
        border-color: #28b779 !important;
        color: #28b779;
    }
    .select2-container .select2-selection--single{
        height: 35px !important;
    }

    .ql-container{height: auto !important;}

    .fa-eye{
        background:  #28b779;
        padding: 5px;
        border-radius: 2px;
        color: white;
        font-size: 14px;

    }

    .fa-trash{
        background:  #ff5b57;
        padding: 5px;
        border-radius: 2px;
        color: white;
        font-size: 14px;

    }
    .fa-eye:hover, .fa-check-circle:hover, .fa-trash:hover{
        color: black;
        background: #ffb848;
        transition: all 1s;
    }

    .card-header{
        background-color: #d9edf7;
        border-color: #101010 !important;
        color: #31708f !important;
    }
    .chat-list .chat-item .chat-content .box{
        background: #ffffff;
    }

    .chat-list .chat-item .chat-time{
        font-size: 12px;
        margin: -15px 0 15px 65px !important;
    }

    #main-wrapper[data-sidebartype=full] .page-wrapper {
    margin-left: 250px !important;
}


</style>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
