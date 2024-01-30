<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="index.php">
                <!-- Logo icon -->
                <b class="logo-icon p-l-10">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="<?php echo $base_url; ?>assets/images/site-icon.png" alt="homepage" class="light-logo" width="0" />

                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="<?php echo $base_url; ?>assets/images/site-logo.png" alt="homepage" class="light-logo" width="40" height="40"/>

                        </span>
                <!-- Logo icon -->
                <!-- <b class="logo-icon"> -->
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                <!-- </b> -->
                <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search position-absolute">
                        <input type="text" class="form-control" placeholder="Search for modules e.g edit profile, all complaints..." id="search"> <a class="srh-btn"><i class="ti-close"></i></a>
                       <div id="search-data" style="background: white; padding: 20px; height: auto; border-bottom: 3px solid #27a9e3; display: none;">

                       </div>
                    </form>

            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- Messages -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <?php
                    $sql = "SELECT * FROM messages JOIN user u on messages.user = u.username
                                 WHERE messages.user = :username AND is_read =:no ORDER BY id DESC LIMIT 3";
                    $conn->query($sql);
                    $conn->bind(":username", $_SESSION['username']);
                    $conn->bind(":no", "no");
                    $rowCount = $conn->rowCount();
                    $result_set = $conn->fetchMultiple();





                    ?>
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
<!--                     show number of new messages here-->
                        <span style="color: #cb372b; font-weight: bolder; font-size: 17px;"><?php echo $rowCount; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                        <ul class="list-style-none">
                            <li>
                                <div class="">
                                    <!-- Message -->

                                           <?php
                                           if($rowCount > 0 ){
                                               foreach ($result_set as $messages){
                                               $message_sender = $messages->message_sender;
                                               $message_content = $messages->message_content;
                                               $date_received = $messages->date_received;
                                               $complaint_no = $messages->complaint_no;
                                               $is_read = $messages->is_read;
                                               $image = $messages->photo;
                                               $redirect = $conn->base_url()."messages";
                                               $msg_id = $messages->id;

                                               ?>
                                                <a href="<?php echo $redirect; ?>" class="link border-top">
                                                    <div class="d-flex no-block align-items-center p-10">
                                                        <span class="btn btn-success btn-circle"><i class="ti-comment"></i></span>
                                                               <div class="m-l-10">
                                                                   <h5 class="m-b-0">#<?php echo $complaint_no; ?></h5>
                                                                   <span class="mail-desc" title="click to open messages page."><?php echo $conn->short_text($message_content, 50); ?></span>

                                                               </div>
                                                    </div>
                                                </a>

                                                <?php
                                               }
                                               ?>   <a href="<?php echo $redirect; ?>" style="display: block; text-align: center;"> View All Messages </a> <?php

                                           }else{
                                               echo "<p class='text-center'>You have not received any new notifications yet. </p>";
                                           }

                                           ?>


                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <?php
                    $sql = "SELECT photo FROM user WHERE username =:username";
                    $conn->query($sql);
                    $conn->bind(":username", $_SESSION['username']);
                    $image = $conn->fetchColumn();
                    $image_link = $conn->base_url()."assets/images/$image";

                    ?>
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <?php
                        if(empty($image)){
                            ?>
                            <img src="<?php echo $base_url; ?>assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31">
                            <?php
                        }else{
                            ?>
                            <img src="<?= $image_link; ?>" alt="user" class="rounded-circle" width="31">
                            <?php
                        }

                       ?>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="<?php echo $base_url; ?>profile"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo $base_url; ?>change-password"><i class="ti-lock m-r-5 m-l-5"></i>Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo $base_url; ?>logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>

                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>