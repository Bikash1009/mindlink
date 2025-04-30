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
    <title>Edit Activity</title>
</head>

<?php
session_start();
@include '../connection.php';

if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='m'){  // 'm' for moderator
            header("location: ../login.php");
            exit();
        }
    }else{
        header("location: ../login.php");
        exit();
    }
$id = $_GET['edit'];
$query = mysqli_query($database, "SELECT * FROM activities WHERE id = '$id' AND added_by = '".$_SESSION['user']."'");

if(mysqli_num_rows($query) == 0){
    echo "<script>alert('Unauthorized or invalid access!'); window.location.href='moderator_activities.php';</script>";
    exit();
}

$activity = mysqli_fetch_assoc($query);

if (isset($_POST['update_activity'])) {
    $name = $_POST['product_name'];
    $desc = $_POST['product_desc'];
    $link = $_POST['product_link'];

    $image = $_FILES['product_image']['name'];
    $tmp_name = $_FILES['product_image']['tmp_name'];
    $upload_folder = 'uploaded_img/'.$image;

    if (!empty($image)) {
        move_uploaded_file($tmp_name, $upload_folder);
        $update = "UPDATE activities SET name='$name', description='$desc', link='$link', image='$image' WHERE id='$id' AND added_by='".$_SESSION['user']."'";
    } else {
        $update = "UPDATE activities SET name='$name', description='$desc', link='$link' WHERE id='$id' AND added_by='".$_SESSION['user']."'";
    }

    $run_update = mysqli_query($database, $update);

    if ($run_update) {
        echo "<script>alert('Activity updated successfully'); window.location.href='moderator_activities.php';</script>";
    } else {
        echo "<script>alert('Update failed');</script>";
    }
}
?>

<body>

<div class="container">
    <div class="menu">
        <!-- Reuse moderator sidebar from previous page -->
        <table class="menu-container" border="0">
            <tr>
                <td style="padding:10px" colspan="2">
                    <table border="0" class="profile-container">
                        <tr>
                            <td width="30%" style="padding-left:20px">
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
            <tr class="menu-row"><td class="menu-btn"><a href="moderator_index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></td></tr>
            <tr class="menu-row"><td class="menu-btn"><a href="moderator_patients.php" class="non-style-link-menu"><div><p class="menu-text">Patients List</p></a></div></td></tr>
            <tr class="menu-row"><td class="menu-btn"><a href="moderator_schedule.php" class="non-style-link-menu"><div><p class="menu-text">Group Sessions</p></div></a></td></tr>
            <tr class="menu-row"><td class="menu-btn"><a href="moderator_events.php" class="non-style-link-menu"><div><p class="menu-text">Community Events</p></a></div></td></tr>
            <tr class="menu-row"><td class="menu-btn menu-active"><a href="moderator_activities.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Self-Help Activities</p></a></div></td></tr>
            <tr><td colspan="2"><a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a></td></tr>
        </table>
    </div>

    <div class="dash-body">
        <table border="0" width="100%" style="margin-top:25px;">
            <tr>
                <td width="5%">
                    <a href="moderator_activities.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="width:125px;">Back</button></a>
                </td>
                <td><p style="font-size: 23px; padding-left:12px; font-weight: 600;">Edit Self-Help Activity</p></td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="dashboard-items search-items">
                        <div class="container">
                            <div class="admin-product-form-container">
                                <form method="POST" enctype="multipart/form-data">
                                    <h3>Update Activity</h3>
                                    <input type="text" name="product_name" class="box" value="<?php echo $activity['name']; ?>" required>
                                    <input type="text" name="product_desc" class="box" value="<?php echo $activity['description']; ?>" required>
                                    <input type="text" name="product_link" class="box" value="<?php echo $activity['link']; ?>">
                                    <p>Current Image:</p>
                                    <img src="uploaded_img/<?php echo $activity['image']; ?>" height="100" alt=""><br><br>
                                    <input type="file" name="product_image" accept="image/*" class="box">
                                    <input type="submit" name="update_activity" value="Update Activity" class="btn1">
                                </form>
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
