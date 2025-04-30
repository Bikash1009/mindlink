<?php
// Import database
include("../connection.php");

if ($_POST) {
    // Extract and sanitize inputs
    $name      = $_POST['name'] ?? '';
    $nic       = $_POST['nic'] ?? '';
    $oldemail  = $_POST['oldemail'] ?? '';
    $spec      = $_POST['spec'] ?? '';
    $email     = $_POST['email'] ?? '';
    $tele      = $_POST['Tele'] ?? '';
    $password  = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';
    $id        = $_POST['id00'] ?? '';
    
    if ($password === $cpassword) {
        // Check if the email is already used by another doctor
        $checkQuery = "SELECT doctor.docid FROM doctor 
                       INNER JOIN webuser ON doctor.docemail = webuser.email 
                       WHERE webuser.email = '$email';";
        $result = $database->query($checkQuery);

        if ($result->num_rows == 1) {
            $existingId = $result->fetch_assoc()["docid"];
        } else {
            $existingId = $id;
        }

        if ($existingId != $id) {
            // Email is already in use by another doctor
            $error = '1';
        } else {
            // Update doctor info
            $updateDoctor = "UPDATE doctor 
                             SET docemail='$email', docname='$name', docpassword='$password', 
                                 docnic='$nic', doctel='$tele', specialties=$spec 
                             WHERE docid=$id;";
            $database->query($updateDoctor);

            // Update webuser email
            $updateWebUser = "UPDATE webuser SET email='$email' WHERE email='$oldemail';";
            $database->query($updateWebUser);

            $error = '4'; // Success
        }
    } else {
        $error = '2'; // Password mismatch
    }
} else {
    $error = '3'; // No POST data
}

header("Location: doctors.php?action=edit&error=$error&id=$id");
exit();
?>
