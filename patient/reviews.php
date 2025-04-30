<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
	
    <title>Reviews</title>
     
    <?php
    @include '../connection.php';

    
    ?>   
</head>
<body>

<?php

//learn from w3schools.com

session_start();

if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
        header("location: ../login.php");
    }else{
        $useremail=$_SESSION["user"];
    }

}else{
    header("location: ../login.php");
}


//import database
include("../connection.php");
$sqlmain= "select * from patient where pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s",$useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch=$userrow->fetch_assoc();
$userid= $userfetch["pid"];
$username=$userfetch["pname"];


//echo $userid;
//echo $username;


//TODO
$sqlmain= "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where  patient.pid=$userid ";

if($_POST){
    //print_r($_POST);
    


    
    if(!empty($_POST["sheduledate"])){
        $sheduledate=$_POST["sheduledate"];
        $sqlmain.=" and schedule.scheduledate='$sheduledate' ";
    };



    //echo $sqlmain;

}

$sqlmain.="order by appointment.appodate  asc";
$result= $database->query($sqlmain);
?>
<div class="container">
    <div class="menu">
    <table class="menu-container" border="0">
            <tr>
                <td style="padding:10px" colspan="2">
                    <table border="0" class="profile-container">
                        <tr>
                            <td width="30%" style="padding-left:20px" >
                                <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                            </td>
                            <td style="padding:0px;margin:0px;">
                                <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                            </td>
                        </tr>
                </table>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-home" >
                    <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Home</p></a></div></a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-doctor">
                    <a href="doctors.php" class="non-style-link-menu"><div><p class="menu-text">Psychiatrists List</p></a></div>
                </td>
            </tr>
            
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-session">
                    <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Available Sessions</p></div></a>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-appoinment">
                    <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Appointments</p></a></div>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-chat">
                    <a href="chat/index.php" class="non-style-link-menu"><div><p class="menu-text">My chat</p></a></div>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-news">
                    <a href="news.php" class="non-style-link-menu "><div><p class="menu-text">Events</p></a></div>
                </td>
            </tr> 
            <tr class="menu-row">
                <td class="menu-btn menu-icon-activities">
                    <a href="activities.php" class="non-style-link-menu"><div><p class="menu-text">Activities</p></a></div>
                </td>
            </tr>  
            <tr class="menu-row">
                <td class="menu-btn menu-icon-reviews menu-active menu-icon-reviews-active">
                    <a href="reviews.php" class="non-style-link-menu  non-style-link-menu-active"><div><p class="menu-text">Reviews</p></a></div>
                </td>
            </tr>
            <tr class="menu-row" >
                    <td class="menu-btn menu-icon-chat">
                        <a href="https://app.engati.com/static/standalone/standalone.html?bot_key=48f7d12cdf544aa4&launch_flow=welcome_97101&env=p" class="non-style-link-menu"><div><p class="menu-text">Talk to Charlix</p></a></div>
                    </td>
                </tr> 
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-settings">
                    <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                </td>
            </tr>       
            <tr>
            <td colspan="2">
                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
            </td>
        </tr>
        </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr >
                <td width="13%" >
                <a href="schedule.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Reviews</p>
                                       
                </td>
                
                <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Today's Date
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Asia/Dhaka');

                                $today = date('d-m-Y (h:i:sa)');
                                echo $today;

                                $patientrow = $database->query("select  * from  patient;");
                                $doctorrow = $database->query("select  * from  doctor;");
                                $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                                $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                                ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
            </tr>
            
            <tr>
                <td>

                </td>
                <td colspan=2>
                <div class="dashboard-items search-items" style="width:95%; background-image: url('../images/abc.jpg'); background-size:cover; height: 600px; margin-top: 40px;">
                <p style="font-size:45px; color:black; margin-top: 200px; margin-left: 120px; font-family: 'Helvetica' font-weight: bold;"> <b> Welcome to The Review Forum </b></p>

                <a href="forum.php" >
    <input type="button" value="Share your review" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px; background-color: black; border-color: transparent; margin-top: 280px; margin-left: -400px;">
                </a>
            </div>
</div>
    </div>
               
                    </div>
                </td>
            </tr>

</table>
    </div>
        
    
</div>

</body>
