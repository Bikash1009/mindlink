<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <title>Moderator Dashboard</title>
</head>
<body>
    <?php
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='m'){  // 'm' for moderator
            header("location: ../login.php");
            exit();
        }
    }else{
        header("location: ../login.php");
        exit();
    }
    
    include("../connection.php");
    
 // Get moderator details
$modemail = $_SESSION["user"];
$modstmt = $database->prepare("SELECT * FROM moderator WHERE memail = ?");
$modstmt->bind_param("s", $modemail);
$modstmt->execute();
$modresult = $modstmt->get_result();
$modrow = $modresult->fetch_assoc();
$modname = $modrow["mname"] ?? "Moderator";

    ?>
    
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo $modname; ?></p>
                                    <p class="profile-subtitle"><?php echo $modemail; ?></p>
                                </td>
                            </tr>
                            </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="doctors.php" class="non-style-link-menu "><div><p class="menu-text">Psychiatrists List</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="patient.php" class="non-style-link-menu"><div><p class="menu-text">Patients List</p></a></div>
                    </td>
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
                    <td class="menu-btn menu-icon-activities">
                        <a href="addactivities.php" class="non-style-link-menu"><div><p class="menu-text">Activities</p></a></div>
                    </td>
                </tr>         
            <tr>
                <td colspan="2">
                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                </td>
            </tr>
            </table>
        </div>
        
        <div class="dash-body" style="margin-top: 0px">
            <table border="0" width="100%" style="border-spacing: 0;margin:0;padding:0;">
                <tr>
                    <td colspan="2" class="nav-bar">
                        <form action="doctors.php" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Psychiatrist or Patient" list="doctors-patients">
                            <?php
                                echo '<datalist id="doctors-patients">';
                                // Doctors
                                $list11 = $database->query("SELECT docname, docemail FROM doctor");
                                for ($y=0; $y<$list11->num_rows; $y++) {
                                    $row00 = $list11->fetch_assoc();
                                    echo "<option value='".$row00["docname"]."'></option>";
                                    echo "<option value='".$row00["docemail"]."'></option>";
                                }
                                // Patients
                                $list12 = $database->query("SELECT pname, pemail FROM patient");
                                for ($y=0; $y<$list12->num_rows; $y++) {
                                    $row00 = $list12->fetch_assoc();
                                    echo "<option value='".$row00["pname"]."'></option>";
                                    echo "<option value='".$row00["pemail"]."'></option>";
                                }
                                echo '</datalist>';
                            ?>
                            <input type="Submit" value="Search" class="login-btn btn-primary-soft btn">
                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                            date_default_timezone_set('Asia/Kathmandu');
                            echo date('d-m-Y (h:i:sa)');
                            ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display: flex;justify-content: center;align-items: center;">
                            <img src="../img/calendar.svg" width="100%">
                        </button>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="4">
                        <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Current Status</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex">
                                        <div>
                                            <div class="h1-dashboard">
                                                <?php echo $database->query("SELECT * FROM doctor")->num_rows; ?>
                                            </div><br>
                                            <div class="h3-dashboard">
                                                Psychiatrists
                                            </div>
                                        </div>
                                        <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;">
                                        <div>
                                            <div class="h1-dashboard">
                                                <?php echo $database->query("SELECT * FROM patient")->num_rows; ?>
                                            </div><br>
                                            <div class="h3-dashboard">
                                                Patients
                                            </div>
                                        </div>
                                        <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex; ">
                                        <div>
                                            <div class="h1-dashboard">
                                                <?php 
                                                $today = date("Y-m-d");
                                                echo $database->query("SELECT * FROM appointment WHERE appodate >= '$today'")->num_rows; 
                                                ?>
                                            </div><br>
                                            <div class="h3-dashboard">
                                                Upcoming Appointments
                                            </div>
                                        </div>
                                        <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;padding-top:26px;padding-bottom:26px;">
                                        <div>
                                            <div class="h1-dashboard">
                                                <?php 
                                                echo $database->query("SELECT * FROM schedule WHERE scheduledate = '$today'")->num_rows; 
                                                ?>
                                            </div><br>
                                            <div class="h3-dashboard" style="font-size: 15px">
                                                Today's Sessions
                                            </div>
                                        </div>
                                        <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        </center>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="4">
                        <table width="100%" border="0" class="dashbord-tables">
                            <tr>
                                <td>
                                    <p style="padding:10px;padding-left:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                        Upcoming Appointments (Next 7 Days)
                                    </p>
                                </td>
                                <td>
                                    <p style="text-align:right;padding:10px;padding-right:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                        Upcoming Sessions (Next 7 Days)
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;">
                                            <table width="85%" class="sub-table scrolldown" border="0">
                                                <thead>
                                                    <tr>    
                                                        <th class="table-headin" style="font-size: 12px;">Appointment #</th>
                                                        <th class="table-headin">Patient</th>
                                                        <th class="table-headin">Psychiatrist</th>
                                                        <th class="table-headin">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $nextweek = date("Y-m-d", strtotime("+1 week"));
                                                    $sqlmain = "SELECT 
                                                                    a.apponum, 
                                                                    p.pname, 
                                                                    d.docname, 
                                                                    a.appodate 
                                                                FROM appointment a
                                                                JOIN patient p ON a.pid = p.pid
                                                                JOIN schedule s ON a.scheduleid = s.scheduleid
                                                                JOIN doctor d ON s.docid = d.docid
                                                                WHERE a.appodate >= '$today' AND a.appodate <= '$nextweek'
                                                                ORDER BY a.appodate ASC
                                                                LIMIT 10";
                                                    $result = $database->query($sqlmain);
                                                    
                                                    if($result->num_rows == 0) {
                                                        echo '<tr>
                                                                <td colspan="4">
                                                                <br><br><br><br>
                                                                <center>
                                                                <img src="../img/notfound.svg" width="25%">
                                                                <br>
                                                                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">
                                                                No upcoming appointments found!
                                                                </p>
                                                                </center>
                                                                <br><br><br><br>
                                                                </td>
                                                            </tr>';
                                                    } else {
                                                        while($row = $result->fetch_assoc()) {
                                                            echo '<tr>
                                                                    <td style="text-align:center;">'.$row["apponum"].'</td>
                                                                    <td>'.substr($row["pname"],0,20).'</td>
                                                                    <td>'.substr($row["docname"],0,20).'</td>
                                                                    <td style="text-align:center;">'.date("d M", strtotime($row["appodate"])).'</td>
                                                                </tr>';
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </center>
                                </td>
                                <td width="50%" style="padding: 0;">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;padding: 0;margin: 0;">
                                            <table width="85%" class="sub-table scrolldown" border="0">
                                                <thead>
                                                    <tr>
                                                        <th class="table-headin">Session Title</th>
                                                        <th class="table-headin">Psychiatrist</th>
                                                        <th class="table-headin">Date & Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sqlmain = "SELECT 
                                                                    s.title, 
                                                                    d.docname, 
                                                                    s.scheduledate, 
                                                                    s.scheduletime 
                                                                FROM schedule s
                                                                JOIN doctor d ON s.docid = d.docid
                                                                WHERE s.scheduledate >= '$today' AND s.scheduledate <= '$nextweek'
                                                                ORDER BY s.scheduledate ASC
                                                                LIMIT 10";
                                                    $result = $database->query($sqlmain);
                                                    
                                                    if($result->num_rows == 0) {
                                                        echo '<tr>
                                                                <td colspan="3">
                                                                <br><br><br><br>
                                                                <center>
                                                                <img src="../img/notfound.svg" width="25%">
                                                                <br>
                                                                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">
                                                                No upcoming sessions found!
                                                                </p>
                                                                </center>
                                                                <br><br><br><br>
                                                                </td>
                                                            </tr>';
                                                    } else {
                                                        while($row = $result->fetch_assoc()) {
                                                            echo '<tr>
                                                                    <td>'.substr($row["title"],0,20).'</td>
                                                                    <td>'.substr($row["docname"],0,20).'</td>
                                                                    <td style="text-align:center;">'.date("d M", strtotime($row["scheduledate"])).' '.substr($row["scheduletime"],0,5).'</td>
                                                                </tr>';
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <!-- <td>
                                    <center>
                                        <a href="appointment.php" class="non-style-link">
                                            <button class="btn-primary btn" style="width:85%">View All Appointments</button>
                                        </a>
                                    </center>
                                </td> -->
                                <td>
                                    <!-- <center>
                                        <a href="schedule.php" class="non-style-link">
                                            <button class="btn-primary btn" style="width:85%">View All Sessions</button>
                                        </a>
                                    </center> -->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>