<?php
@include '../connection.php';
session_start();

// Check if user is logged in and has appropriate role (admin or moderator)
if(!isset($_SESSION['user_role']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'moderator')) {
    header('location:../login.php');
    exit();
}

// Validate and sanitize the edit ID
$id = filter_var($_GET['edit'] ?? '', FILTER_VALIDATE_INT);
if(!$id) {
    header('location:addnews.php');
    exit();
}

if(isset($_POST['update_product'])){
    // Sanitize inputs
    $product_name = mysqli_real_escape_string($database, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($database, $_POST['product_price']);
    $product_link = mysqli_real_escape_string($database, $_POST['product_link']);
    
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/'.$product_image;

    // Validate file type
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
    $file_type = mime_content_type($product_image_tmp_name);
    
    if(empty($product_name) || empty($product_price)){
        $message[] = 'Please fill out all required fields!';    
    } elseif(!empty($product_image) && !in_array($file_type, $allowed_types)) {
        $message[] = 'Only JPG, JPEG, PNG images are allowed!';
    } else {
        // If no new image uploaded, keep the existing one
        $image_update = !empty($product_image) ? "image='$product_image'" : "";
        
        $update_data = "UPDATE news SET name='$product_name', price='$product_price', link='$product_link'";
        if(!empty($image_update)) {
            $update_data .= ", $image_update";
        }
        $update_data .= " WHERE id = '$id'";
        
        $upload = mysqli_query($database, $update_data);

        if($upload){
            if(!empty($product_image)) {
                move_uploaded_file($product_image_tmp_name, $product_image_folder);
            }
            header('location:addnews.php');
            exit();
        } else {
            $message[] = 'Update failed! Please try again.'; 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/addnews.css">
        
    <title>Manage News and Events</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .message {
            display: block;
            padding: 10px;
            margin: 10px 0;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<span class="message">'.$msg.'</span>';
   }
}
?>

<div class="container">
    <?php require_once(__DIR__.'/navbar.php'); ?>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                <a href="schedule.php"><button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Update News or Event</p>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <div class="dashboard-items search-items">
                        <div style="width:100%;">
                            <div class="container">
                                <div class="admin-product-form-container centered">
                                    <?php
                                        $select = mysqli_query($database, "SELECT * FROM news WHERE id = '$id'");
                                        while($row = mysqli_fetch_assoc($select)){
                                    ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <h3 class="title">Update the Existing Information</h3>
                                        <input type="text" class="box" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>" placeholder="Update news or event title" required>
                                        <input type="text" class="box" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>" placeholder="Update details about the event" required>
                                        <input type="text" class="box" name="product_link" value="<?php echo htmlspecialchars($row['link']); ?>" placeholder="Enter a new link">
                                        <input type="file" class="box" name="product_image" accept="image/png, image/jpeg, image/jpg">
                                        <p>Current image: <?php echo htmlspecialchars($row['image']); ?></p>
                                        <input type="submit" value="Update" name="update_product" class="btn1">
                                        <a href="addnews.php" class="btn1">Cancel</a>
                                    </form>
                                    <?php }; ?>
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