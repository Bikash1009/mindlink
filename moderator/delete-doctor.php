<?php
session_start();

if (isset($_SESSION["user"])) {
    if ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'm') {
        header("location: ../login.php");
        exit();
    }
} else {
    header("location: ../login.php");
    exit();
}

if ($_GET) {
    // Import database
    include("../connection.php");
    $id = $_GET["id"];

    // Fetch doctor's email
    $result001 = $database->query("SELECT * FROM doctor WHERE docid=$id;");
    if ($row = $result001->fetch_assoc()) {
        $email = $row["docemail"];

        // Delete user and doctor records
        $database->query("DELETE FROM webuser WHERE email='$email';");
        $database->query("DELETE FROM doctor WHERE docemail='$email';");
    }

    header("location: doctors.php");
    exit();
}
?>
