<?php
session_start();

// Redirect if user is not logged in or not a moderator
if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION["usertype"] != 'm') {
    header("Location: ../login.php");
    exit();
}

$userEmail = $_SESSION["user"];
$userRole = ucfirst($_SESSION["usertype"]); // 'Moderator'
?>

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
                            <p class="profile-title"><?php echo $userRole; ?></p>
                            <p class="profile-subtitle"><?php echo $userEmail; ?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Menu Items -->
        <tr class="menu-row">
            <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">
                <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                    <div><p class="menu-text">Dashboard</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor">
                <a href="doctors.php" class="non-style-link-menu">
                    <div><p class="menu-text">Psychiatrists List</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-patient">
                <a href="patient.php" class="non-style-link-menu">
                    <div><p class="menu-text">Patients List</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-schedule">
                <a href="schedule.php" class="non-style-link-menu">
                    <div><p class="menu-text">Schedules</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment">
                <a href="appointment.php" class="non-style-link-menu">
                    <div><p class="menu-text">Appointments</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-activities">
                <a href="appointment.php" class="non-style-link-menu">
                    <div><p class="menu-text">Activities</p></div>
                </a>
            </td>
        </tr>

        <!-- Logout -->
        <tr>
            <td colspan="2">
                <a href="../logout.php">
                    <input type="button" value="Log out" class="logout-btn btn-primary-soft btn">
                </a>
            </td>
        </tr>
    </table>
</div>

<!-- CSS Styling -->
<style>
.menu {
    width: 250px;
    background-color: #f9f9f9;
    border-right: 1px solid #ddd;
    height: 100vh;
    overflow-y: auto;
}

.menu-container {
    width: 100%;
}

.profile-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

.profile-subtitle {
    font-size: 14px;
    color: #555;
}

.menu-row {
    border-bottom: 1px solid #eee;
}

.menu-btn {
    padding: 12px 16px;
    cursor: pointer;
}

.menu-btn:hover {
    background-color: #eaeaea;
}

.menu-text {
    margin: 0;
    font-size: 16px;
}

.logout-btn {
    width: 90%;
    margin: 10px;
    padding: 10px;
    border-radius: 5px;
}
</style>

<!-- JavaScript for dropdowns (if needed later) -->
<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    for (var i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
        });
    }
</script>
