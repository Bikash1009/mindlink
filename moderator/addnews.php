<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/moderator.css">
    <link rel="stylesheet" href="../css/addnews.css">
    <title>Manage Community Events</title>
</head>

<?php
session_start();
@include '../connection.php';

// Check moderator permissions
if(!isset($_SESSION["user"]) {
    header("location: ../login.php");
    exit();
}

if($_SESSION['usertype'] != 'm') {
    header("location: ../login.php");
    exit();
}

if(isset($_POST['add_event'])){
   $event_name = $_POST['event_name'];
   $event_details = $_POST['event_details'];
   $event_link = $_POST['event_link'];
   $event_date = $_POST['event_date']; // Added event date field
   $event_image = $_FILES['event_image']['name'];   
   $event_image_tmp_name = $_FILES['event_image']['tmp_name'];
   $event_image_folder = 'uploaded_img/'.$event_image;

   if(empty($event_name) || empty($event_details) || empty($event_image)){
      $message[] = 'Please fill all required fields';
   }else{
      $insert = "INSERT INTO events(name, details, image, link, event_date, posted_by) 
                VALUES('$event_name', '$event_details', '$event_image','$event_link', '$event_date', '".$_SESSION['user']."')";
      $upload = mysqli_query($database,$insert);
      if($upload){
         move_uploaded_file($event_image_tmp_name, $event_image_folder);
         $message[] = 'New event added successfully!';
      }else{
         $message[] = 'Could not add the event';
      }
   }
};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   // Verify moderator owns this event before deleting
   $verify = mysqli_query($database, "SELECT * FROM events WHERE id = $id AND posted_by = '".$_SESSION['user']."'");
   if(mysqli_num_rows($verify) > 0){
      mysqli_query($database, "DELETE FROM events WHERE id = $id");
      header('location:moderator_events.php');
   }else{
      header('location:moderator_events.php?error=unauthorized');
   }
   exit();
};
?>

<body>

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
                                    <p class="profile-title">Moderator</p>
                                    <p class="profile-subtitle"><?php echo $_SESSION['user']; ?></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="moderator_index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-patient">
                        <a href="moderator_patients.php" class="non-style-link-menu"><div><p class="menu-text">Community Members</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-schedule">
                        <a href="moderator_schedule.php" class="non-style-link-menu"><div><p class="menu-text">Group Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-news menu-active menu-icon-news-active">
                        <a href="moderator_events.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Community Events</p></a></div>
                    </td>
                </tr> 
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-activities">
                        <a href="moderator_activities.php" class="non-style-link-menu"><div><p class="menu-text">Resources</p></a></div>
                    </td>
                </tr>      
                <tr>
                    <td colspan="2">
                        <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                    </td>
                </tr>
            </table>
        </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="5%">
                <a href="moderator_schedule.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Manage Community Events</p>                          
                </td>  
            </tr>
            
            <tr>
                <td colspan=2>
                    <div class="dashboard-items search-items">
                        <div style="width:100%;">
                            <div class="container">
                                <div class="admin-product-form-container">
                                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                                        <h3>Add New Community Event</h3>
                                        <input type="text" placeholder="Event name" name="event_name" class="box" required>
                                        <textarea placeholder="Event details" name="event_details" class="box" required></textarea>
                                        <input type="date" name="event_date" class="box" required>
                                        <input type="text" placeholder="Registration link (optional)" name="event_link" class="box">
                                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="event_image" class="box" required>
                                        <input type="submit" class="btn1" name="add_event" value="Add Event">
                                    </form>
                                </div>

                                <?php
                                if(isset($message)){
                                    foreach($message as $message){
                                        echo '<span class="message">'.$message.'</span>';
                                    }
                                }
                                ?>

                                <div class="product-display">
                                    <table class="product-display-table">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Event Name</th>
                                            <th>Details</th>
                                            <th>Date</th>
                                            <th>Link</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <?php 
                                        $select = mysqli_query($database, "SELECT * FROM events WHERE posted_by = '".$_SESSION['user']."' ORDER BY event_date DESC");
                                        while($row = mysqli_fetch_assoc($select)){ 
                                        ?>
                                        <tr>
                                            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo substr($row['details'], 0, 50); ?>...</td>
                                            <td><?php echo date('M j, Y', strtotime($row['event_date'])); ?></td>
                                            <td><?php echo $row['link'] ? '<a href="'.$row['link'].'" target="_blank">Register</a>' : 'N/A'; ?></td>
                                            <td>
                                                <a href="moderator_update_event.php?edit=<?php echo $row['id']; ?>" class="btn2">Edit</a>
                                                <a href="moderator_events.php?delete=<?php echo $row['id']; ?>" class="btn2" onclick="return confirm('Delete this event?')">Delete</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </table>
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
</html>