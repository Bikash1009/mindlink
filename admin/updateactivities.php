<?php

@include '../connection.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_link = $_POST['product_link'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE activities SET name='$product_name', price='$product_price', image='$product_image', link = '$product_link'  WHERE id = '$id'";
      $upload = mysqli_query($database, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:addactivities.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

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
        
    <title>Manage Self-Help Music</title>
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
    </style>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>

<div class="container">
    <?php require_once(__DIR__.'/navbar.php'); ?>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr >
                <td width="13%" >
                <a href="schedule.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Update Music Details</p>
                                       
                </td>
                
                
            </tr>
            
            <tr>
                
                <td colspan=2>
                    <div  class="dashboard-items search-items"  >
                    
                        <div style="width:100%;">
                        

                        <div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($database, "SELECT * FROM activities WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update the Existing Information</h3>
      <input type="text" class="box" name="product_name" value="<?php echo $row['name']; ?>" placeholder="Enter a new music title">
      <input type="text" min="0" class="box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="Write something about the music">
      <input type="text" class="box" name="product_link" value="<?php echo $row['link']; ?>" placeholder="Enter a new link">
      <input type="file" class="box" name="product_image"  accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="Update" name="update_product" class="btn1">
      <a href="addactivities.php" class="btn1">Cancel</a>
   </form>
   


   <?php }; ?>



                        </div>

                        </div>
                                
                    </div>
                </td>
            </tr>
    </div>
        
    
</div>  