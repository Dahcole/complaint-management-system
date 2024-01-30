
<!--Latest Complaints start -->
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Latest Students Complaints </h4>
        </div>
        <div class="comment-widgets scrollable">
            <?php   $redirectAll = $conn->base_url()."admin/complaints"; ?>
            <a class="btn btn-secondary btn-sm" onclick="window.location.href='<?php echo $redirectAll; ?>'" style="cursor:pointer; position:relative; left: 70%; color: beige;">
                View All Complaints
            </a>

            <?php

                $sql = "SELECT * FROM complaints JOIN user u on complaints.studentID = u.studentID ORDER BY id DESC LIMIT 4";
                $conn->query($sql);
                $rowCount = $conn->rowCount();
                if($rowCount > 0){
                $result_set = $conn->fetchMultiple();
                foreach ($result_set as $complaint) {
                    $name = $complaint->name;
                    $message = $complaint->complaint_message;
                    $date_submitted = $complaint->reg_date;
                    $complaint_no = $complaint->complaint_number;
                    $redirect = $conn->base_url()."admin/view-complaint/$complaint_no";
                    $subject = $complaint->title;
                    $image = $complaint->photo;
                    ?>
                    <!-- Comment Row -->
                    <div class="d-flex flex-row comment-row m-t-0">
                        <?php
                         if(!empty($image)){
                             ?>   <div class="p-2"><img src="<?= $conn->base_url();?>assets/images/<?= $image;?>" alt="profile image" style="width: 50px; height: 50px; border-radius: 50%;"></div> <?php
                         }else{
                             ?>   <div class="p-2"><i class="fa fa-user" style="font-size: 2.2em; padding: 2px 15px;"></i></div> <?php
                         }

                        ?>


                        <div class="comment-text w-100">
                            <h6 class="font-medium"><?php echo $name; ?></h6>
                            <span class="m-b-15 d-block"><?php echo $subject; ?> </span>
                            <div class="comment-footer">
                                <span class="text-muted float-right"><?php echo $date_submitted; ?></span>
                                <button type="button" class="btn btn-cyan btn-sm" onclick="window.location.href='<?php echo $redirect; ?>'">View</button>
                            </div>
                        </div>
                    </div>
                    <!-- Comment Row -->


                    <?php
                }


            }else{
                echo "<p>No complaints have been made by any students yet. Pls check back later. </p>";
            }

            ?>



        </div>
    </div>

</div>


<!-- Latest Complaints end -->

<div class="col-lg-6">
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Latest Students' Complaints Replies History</h4>
            <div class="chat-box scrollable" style="height:475px;">

                <ul class="chat-list">
                    <?php

                         $sql = "SELECT * FROM complaints JOIN user u on complaints.studentID = u.studentID
                                 ORDER BY id DESC LIMIT 1";
                         $conn->query($sql);
                         if($rowCount > 0){
                         $result = $conn->fetchSingle();
                         $name = $result->name;
                         $message = $result->complaint_message;
                         $date_submitted = $result->reg_date;
                         $complaint_no = $result->complaint_number;
                         $redirect = $conn->base_url()."admin/view-complaint/$complaint_no";
                         $image = $result->photo;
                         $student_id = $result->studentID;

                    ?>

                         <a class="btn btn-primary btn-sm" onclick="window.location.href='<?php echo $redirect; ?>'" style="cursor:pointer; position:relative; left: 70%;">
                             View Complaint
                         </a>

                    <!--start chat Row -->
                    <li class="chat-item">
                        <div class="chat-img">
                            <?php
                            if(!empty($image)){
                                ?>   <div class="p-2"><img src="<?= $conn->base_url();?>assets/images/<?= $image;?>" alt="profile image" style="width: 30px; height: 30px; border-radius: 50%;"></div> <?php
                            }else{
                                ?>   <div class="p-2"><i class="fa fa-user" style="font-size: 2.2em; padding: 2px 15px;"></i></div> <?php
                            }
                            ?>

                        </div>
                             <div class="chat-content">
                            <h6 class="font-medium"><?php echo $name; ?></h6>
                            <span style="display: block;position: relative;top: -8px; font-size: 11px;font-weight: bold;color: #ffb848;">Student</span>
                            <div class="box bg-light-info"><?= $message; ?></div>
                        </div>
                        <div class="chat-time" style="color: #25b371; font-size: 13px; margin-top: -20px;"><?= $date_submitted; ?></div>
                    </li>

                    <!--end chat Row -->

                    <?php
                    //fetch messages replies
                    $sql = "SELECT * FROM complaint_replies JOIN complaints on complaint_replies.student_id = complaints.studentID 
                                                AND complaint_replies.complaint_no = complaints.complaint_number 
                                                WHERE student_id =:student_id AND complaint_number =:complaint_no ORDER BY complaint_replies.id DESC  LIMIT 1";

                    $conn->query($sql);
                    $conn->bind(":student_id", $student_id);
                    $conn->bind(":complaint_no", $complaint_no);
                    $result_details = $conn->fetchMultiple();

                    $row_count = $conn->rowCount();
                    if($row_count > 0){
                        foreach ($result_details as $replies){
                            $complaint_no = $replies->complaint_number;
                            $student_id = $replies->student_id;
                            $matric_no = $replies->matric_no;
                            $complaint_message = $replies->complaint_message;
                            $complaint_reply_message = $replies->complaint_reply_message;
                            $replied_by = $replies->replied_by;
                            $last_updated = $replies->last_updated;
                            $username = $replies->username;
                            $new_complaint_file = $replies->new_complaint_file;
                            $student_email = $replies->email;

                            //echo $replied_by .'<br>';


                            if($replied_by === $name){
                                ?>
                                <li class="chat-item">
                                    <div class="chat-img">
                                        <?php
                                        if(!empty($image)){
                                            ?>   <div class="p-2"><img src="<?= $conn->base_url();?>assets/images/<?= $image;?>" alt="profile image" style="width: 30px; height: 30px; border-radius: 50%;"></div> <?php
                                        }else{
                                            ?>   <div class="p-2"><i class="fa fa-user" style="font-size: 2.2em; padding: 2px 15px;"></i></div> <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="chat-content">
                                        <h6 class="font-medium"><?php echo $replied_by; ?></h6>
                                        <span style="display: block;position: relative;top: -8px; font-size: 11px;font-weight: bold;color: #ffb848;">Student</span>
                                        <div class="box bg-light-info"><?= $complaint_reply_message; ?></div>
                                    </div>
                                    <div class="chat-time" style="color: #25b371; font-size: 13px; margin-top: -40px;"><?= $last_updated ; ?></div>
                                </li>

                                <?php

                            }else{
                                ?>
                                <li class="chat-item" style="margin-left: 30px;">

                                    <?php
                                    //fetch admin profile image if it exists
                                    $sql = "SELECT photo FROM admin WHERE username =:username";
                                    $conn->query($sql);
                                    $conn->bind(":username", $_SESSION['admin']);
                                    $admin_image = $conn->fetchColumn();


                                    ?>

                                    <div class="chat-img">
                                        <?php
                                        if(!empty($admin_image)){
                                            ?>   <div class="p-2"><img src="<?= $conn->base_url();?>assets/images/<?= $admin_image;?>" alt="profile image" style="width: 30px; height: 30px; border-radius: 50%;"></div> <?php
                                        }else{
                                            ?>   <div class="p-2"><i class="fa fa-user" style="font-size: 2.2em; padding: 2px 15px; color:#27a9e3;"></i></div> <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="chat-content">
                                        <h6 class="font-medium"><?php echo $replied_by; ?></h6>
                                        <span style="display: block;position: relative;top: -8px; font-size: 11px;font-weight: bold;color: #ffb848;">Admin</span>
                                        <div class="box bg-light-info"><?= $complaint_reply_message; ?></div>
                                    </div>
                                    <div class="chat-time" style="color: #25b371; font-size: 13px; margin-top: -40px;"><?= $last_updated ; ?></div>
                                </li>

                                <?php
                            }


                        }

                    }
                     }else{
                         echo "<p> No new complaints replies yet. </p>";
                     }
                    ?>



                </ul>
            </div>
            </div>
        </div>
    </div>
    <!-- card -->
</div>