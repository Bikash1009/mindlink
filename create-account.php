<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
    <title>Create Account</title>
</head>
<body>
<?php
session_start();
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";
date_default_timezone_set('Asia/Kolkata');
$_SESSION["date"] = date('Y-m-d');
include("connection.php");

if ($_POST) {
    $result = $database->query("SELECT * FROM webuser");

    $fname = $_SESSION['personal']['fname'];
    $lname = $_SESSION['personal']['lname'];
    $name = $fname . " " . $lname;
    $address = $_SESSION['personal']['address'];
    $nic = $_SESSION['personal']['nic'];
    $dob = $_SESSION['personal']['dob'];
    $email = $_POST['newemail'];
    $tele = $_POST['tele'];
    $newpassword = $_POST['newpassword'];
    $cpassword = $_POST['cpassword'];
    $role = $_POST['usertype'];

    if ($newpassword == $cpassword) {
        $stmt = $database->prepare("SELECT * FROM webuser WHERE email=?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $error = '<label class="form-label" style="color:red;text-align:center;">Account already exists with this email.</label>';
        } else {
            $uname = $fname;
            $pass = $newpassword;
            $crypt = password_hash($pass, PASSWORD_DEFAULT);
            $unique_id = rand(time(), 10000);
            $status = "Offline";

            $uploaded_image = "images/aa1.jpg";
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $permited = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                $uploaded_image = "images/" . $unique_image;
                move_uploaded_file($file_temp, $uploaded_image);
            }

            if ($role == 'p') {
                $database->query("INSERT INTO patient(pemail, pname, ppassword, paddress, pnic, pdob, ptel) 
                                  VALUES('$email', '$name', '$newpassword', '$address', '$nic', '$dob', '$tele');");
            } elseif ($role == 'm') {
                $database->query("INSERT INTO moderator(memail, mname, mpassword, maddress, mnic, mdob, mtel) 
                                  VALUES('$email', '$name', '$newpassword', '$address', '$nic', '$dob', '$tele');");
            }

            $database->query("INSERT INTO webuser VALUES('$email', '$role');");
            $database->query("INSERT INTO user(unique_id, img, username, email, pass, status) 
                              VALUES('$unique_id', '$uploaded_image', '$uname', '$email', '$crypt', '$status')");

            $_SESSION["user"] = $email;
            $_SESSION["usertype"] = $role;
            $_SESSION["username"] = $fname;

            $redirect_url = ($role == 'm') ? "moderator/index.php" : "patient/index.php";
            header("Location: $redirect_url");
            exit();
        }
    } else {
        $error = '<label class="form-label" style="color:red;text-align:center;">Passwords do not match.</label>';
    }
} else {
    $error = '<label class="form-label"></label>';
}
?>

<center>
<div class="container">
    <table border="0" style="width: 70%;">
        <tr>
            <td colspan="2">
                <p class="header-text">Let's Get Started</p>
                <p class="sub-text">Create your account by filling the information below.</p>
            </td>
        </tr>
        <form action="" method="POST" enctype="multipart/form-data">
            <tr>
                <td class="label-td" colspan="2"><label class="form-label">Role: </label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <select name="usertype" class="input-text" required>
                        <option value="p">Patient</option>
                        <option value="m">Moderator</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2"><label class="form-label">Email:</label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2"><label class="form-label">Mobile Number:</label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                <input type="tel" name="tele" id="tele" class="input-text" placeholder="+977 9812345678" 
                pattern="^\+?[1-9]\d{9,14}$" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2"><label class="form-label">Profile Image (optional):</label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="2"><input type="file" name="image" class="input-text"></td>
            </tr>
            <tr>
                <td class="label-td" colspan="2"><label class="form-label">Create New Password:</label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="2"><input type="password" name="newpassword" class="input-text" required></td>
            </tr>
            <tr>
                <td class="label-td" colspan="2"><label class="form-label">Confirm Password:</label></td>
            </tr>
            <tr>
                <td class="label-td" colspan="2"><input type="password" name="cpassword" class="input-text" required></td>
            </tr>
            <tr><td colspan="2"><?php echo $error ?></td></tr>
            <tr>
                <td><input type="reset" value="Reset" class="login-btn btn-primary-soft btn"></td>
                <td><input type="submit" value="Sign Up" class="login-btn btn-primary btn"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <br><label class="sub-text" style="font-weight: 280;">Already have an account? </label>
                    <a href="login.php" class="hover-link1 non-style-link">Login</a><br><br><br>
                </td>
            </tr>
        </form>
    </table>
</div>
</center>
</body>
</html>
