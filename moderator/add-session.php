<?php
    session_start();

    // Check if user is logged in as moderator
    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" || $_SESSION['usertype']!='m'){
            header("location: ../login.php");
            exit();
        }
    }else{
        header("location: ../login.php");
        exit();
    }
    
    if($_POST){
        // Import database connection
        include("../connection.php");
        
        // Get form data
        $title = $_POST["title"];
        $modid = $_POST["modid"]; // Changed from docid to modid
        $max_attendees = $_POST["max_attendees"]; // Changed from nop (number of patients)
        $date = $_POST["date"];
        $time = $_POST["time"];
        $meeting_type = $_POST["meeting_type"] ?? 'general'; // Added moderator-specific field
        
        // Validate moderator exists
        $check_mod = $database->query("SELECT * FROM moderator WHERE modid='$modid'");
        if($check_mod->num_rows != 1){
            header("location: schedule.php?action=invalid-mod");
            exit();
        }

        // Insert into schedule table with moderator-specific fields
        $sql = "INSERT INTO mod_schedule 
                (modid, title, scheduledate, scheduletime, max_attendees, meeting_type, status) 
                VALUES ($modid, '$title', '$date', '$time', $max_attendees, '$meeting_type', 'pending')";
                
        $result = $database->query($sql);
        
        if($result){
            header("location: schedule.php?action=session-added&title=$title");
        }else{
            header("location: schedule.php?action=error");
        }
        exit();
    }
?>