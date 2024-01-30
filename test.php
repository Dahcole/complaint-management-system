<?php
$complaint_id = '#'.rand(1000000,9999999);
//echo $complaint_id;
//date_default_timezone_set("Africa/Lagos");
//$date = date('M d, Y').' at ' .date('h:ia');
//echo $date;
//include "inc/header.php";
//$sql = "SELECT "

$msg = "<div style='width: 55%; margin: 40px auto;'>
                    <div style='margin: 0 auto;'>
                    <div style='padding: 15px; background-color: #d9edf7; '>
                    <h2 style='text-align: center;'> New reply to Complaint #$complaint_no by $name</h2>
                   </div>
                   
                   <div style='border: 2px solid #d9edf7;'>
                   <p style='text-align: center; font-size: 16px;'>Hello Admin, <br> 
                   Please find below the details of the new reply message on the complaint #$complaint_no sent by $name.
                 
                   <br> 
                        
                     <div class='card-header'>
                       <h3 style='text-decoration: underline; text-align: center; font-size: 30px;'>Complaint Details </h3>
                 </div>
                 
                 <div>
                    <p style='text-align: center; font-size: 18px; color: #000;'>Student's Name: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $name</span></p>
                    <p style='text-align: center; font-size: 18px; color: #000;'>Matric No: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $matric_no</span></p>
                    <p  style='text-align: center; font-size: 18px; color: #000;'>Complaint Title: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $subject</span></p>
                    <p  style='text-align: center; font-size: 18px; color: #000;'>Complaint Reply Message: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $new_message</span></p>
                    <p  style='text-align: center; font-size: 18px; color: #000;'>Date Sent: <span style=' color: #428bca; font-size: 15px; font-weight: 400;'> $date</span></p>
                  </div>
                  
                   <div style='padding: 10px;  background-color: #d9edf7;'>
                   <p style='text-align: center;'>Please login to your account area to reply to this complaint message. Thanks.</p>
                    <h2 style='font-size: 14px; text-align: center;'>&copy; $year | Matryx Networks Limited  | All Rights Reserved </h2>
                     <p style='font-size: 14px; text-align: center;'>
                      <a href='#'  style='color: white; margin: 5px; background-color: #5cb85c; border-color: #4cae4c; padding: 10px; -webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;'>Matryx Network Home </a>
                     </p>
                   </div>
                 
                 
              </div>
                    
        </div>
     </div>";

echo $msg;


?>


