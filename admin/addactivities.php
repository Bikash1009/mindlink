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
    <title>Manage Self-Help activities</title>

</head>

<?php
@include '../connection.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_link = $_POST['product_link'];
   $product_image = $_FILES['product_image']['name'];   
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = '';
   }else{
      $insert = "INSERT INTO activities(name, price, image, link) VALUES('$product_name', '$product_price', '$product_image','$product_link' )";
      $upload = mysqli_query($database,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = '';
      }else{
         $message[] = '';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($database, "DELETE FROM activities WHERE id = $id");
   header('location:addactivities.php');
};
?>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}
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
                                    <p class="profile-title">Admin</p>
                                    <p class="profile-subtitle">admin@gmail.com</p>
                                </td>
                            </tr>
                    </table>
                    </td>
                
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord" >
                        <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Psychiatrists List</p></a></div>
                    </td>
                <tr class="menu-row" >
                <td class="menu-btn menu-icon-patient">
                    <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients List</p></a></div>
                </td>
                 </tr>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule">
                        <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Schedules</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">Appointments</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-news">
                        <a href="addnews.php" class="non-style-link-menu"><div><p class="menu-text">Events</p></a></div>
                    </td>
                </tr> 
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-activities menu-active menu-icon-activities-active">
                        <a href="addactivities.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Activities</p></a></div>
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
                <td width="5%" >
                <a href="schedule.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Add New activities for the Self-Help Section</p>                          
                </td>  
            </tr>
            
            <tr>
                <td colspan=2>
                    <div  class="dashboard-items search-items"  >
                    
                        <div style="width:100%;">
                        

                        <div class="container">

<div class="admin-product-form-container">

   <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
      <h3>Please Fill in the Required Information</h3>
      <input type="text" placeholder="Enter activities title" name="product_name" class="box">
      <input type="text" placeholder="Add a short description " name="product_price" class="box">
      <input type="file" placeholder="Add a activities image" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
      <input type="text" placeholder="Add a link " name="product_link" class="box">
      <input type="submit" class="btn1" name="add_product" value="Add">
   </form>

</div>

<?php

$select = mysqli_query($database, "SELECT * FROM activities");

?>
<div class="product-display">
   <table class="product-display-table">
      <thead>
      <tr>
         <th>Image</th>
         <th>activities Title</th>
         <th>activities Description</th>
         <th>Link</th>
         <th>Action</th>
      </tr>
      </thead>
      <?php while($row = mysqli_fetch_assoc($select)){ ?>
      <tr>
         <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
         <td><?php echo $row['name']; ?></td>
         <td><?php echo $row['price']; ?></td>
         <td><?php echo $row['link']; ?></td>
         
         <td>
            <a href="updateactivities.php?edit=<?php echo $row['id']; ?>" class="btn2"> <i class="fas fa-edit"></i> Edit </a>
            <a href="addactivities.php?delete=<?php echo $row['id']; ?>" class="btn2"> <i class="fas fa-trash"></i> Delete </a>
         </td>
      </tr>
      
   <?php } ?>
   </table>
</div>

</div>
</div>
</div>
</div>
</div>

</body>


</html>

