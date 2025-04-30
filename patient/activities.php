<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Activites</title>

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
                    <a href="news.php" class="non-style-link-menu"><div><p class="menu-text">Events</p></a></div>
                </td>
            </tr> 
            <tr class="menu-row">
                <td class="menu-btn menu-icon-activities menu-active menu-icon-activities-active">
                    <a href="activities.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Activities</p></a></div>
                </td>
            </tr>  
            <tr class="menu-row">
                <td class="menu-btn menu-icon-reviews">
                    <a href="reviews.php" class="non-style-link-menu"><div><p class="menu-text">Reviews</p></a></div>
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
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600; color: black">Activities</p>
                    <p style="font-size: 15px;padding-left:12px;font-weight: 600; color: black  ">Here are some activities you can practice to get better mental health. Practice regularly to get faster result.</p>
                    
                                       
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
                
                <td width="10%">
                    
                </td>
            </tr>
            
            <tr>
                <td>

                </td>
                <td colspan=2>
                    <div  class="dashboard-items search-items"  >
                    
<div class = "card-container" style="width:100%;">

                        
    <?php
    @include '../connection.php';
        $query = "SELECT * FROM activities";
        $result = mysqli_query($database, $query);
        while($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="card">
            <img src="../admin/uploaded_img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
            <h2><?php echo $row['name']; ?></h2>
            <p style="color: black; font-size: 14px;"><?php echo $row['price']; ?></p>
            <a href="<?php echo $row['link']; ?> ">Check it out</a>
        </div>
    <?php } ?>
</div>
                        
                        </div>
                                
                    </div>
                </td>
            </tr>
            </table>
            
    </div>
        
    
</div>

</body>

<style>
.card-container {
    display: flex;
    flex-wrap: wrap;
    

}

.card {
    width: 265px;
    margin: 30px;
    padding: 8px;
    box-shadow: 2px 2px 8px #ccc;
    text-align: left;
    
}

.card img {
    width: 100%;
    height: 200px;

}
a {
    text-decoration: none;
    color: #4169e1;
}
a:hover {
  color: #28DE83;
}

</style>