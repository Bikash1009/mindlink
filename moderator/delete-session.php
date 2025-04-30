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

    // Delete schedule by ID
    $database->query("DELETE FROM schedule WHERE scheduleid = '$id';");

    header("location: schedule.php");
    exit();
}
?>
