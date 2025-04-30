<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Management</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        
        .profile-container {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #34495e;
        }
        
        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 3px solid #3498db;
        }
        
        .profile-title {
            font-weight: 600;
            margin: 5px 0;
        }
        
        .profile-subtitle {
            font-size: 0.8rem;
            color: #bdc3c7;
            margin: 0;
        }
        
        .menu-item {
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .menu-item:hover {
            background-color: #34495e;
        }
        
        .menu-item.active {
            background-color: #3498db;
        }
        
        .menu-icon {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .logout-btn {
            display: block;
            width: 80%;
            margin: 20px auto;
            padding: 10px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .logout-btn:hover {
            background-color: #c0392b;
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .date-info {
            text-align: right;
        }
        
        .date-label {
            font-size: 0.9rem;
            color: #7f8c8d;
        }
        
        .current-date {
            font-weight: 600;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        .btn-secondary {
            background-color: #95a5a6;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #7f8c8d;
        }
        
        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
        }
        
        /* Filter Section */
        .filter-container {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .filter-row {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .filter-label {
            font-weight: 500;
        }
        
        .filter-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            flex: 1;
        }
        
        .filter-select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            flex: 1;
            background-color: white;
        }
        
        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 5px;
            overflow: hidden;
        }
        
        .data-table th {
            background-color: #3498db;
            color: white;
            padding: 12px 15px;
            text-align: left;
        }
        
        .data-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .data-table tr:last-child td {
            border-bottom: none;
        }
        
        .data-table tr:hover {
            background-color: #f8f9fa;
        }
        
        .action-cell {
            display: flex;
            gap: 10px;
        }
        
        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        
        .modal-content {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            width: 80%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            padding: 20px;
            position: relative;
        }
        
        .modal-close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #7f8c8d;
        }
        
        .modal-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .form-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        .form-select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
            }
            
            .filter-row {
                flex-direction: column;
                align-items: stretch;
            }
            
            .action-cell {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <div class="profile-container">
                <img src="user.png" alt="Profile" class="profile-img">
                <h3 class="profile-title">Moderator</h3>
                <p class="profile-subtitle">moderator@example.com</p>
            </div>
            
            <div class="menu-item">
                <span class="menu-icon">📊</span>
                Dashboard
            </div>
            
            <div class="menu-item">
                <span class="menu-icon">👨‍⚕️</span>
                Psychiatrists
            </div>
            
            <div class="menu-item">
                <span class="menu-icon">👥</span>
                Patients
            </div>
            
            <div class="menu-item active">
                <span class="menu-icon">📅</span>
                Schedules
            </div>
            
            <div class="menu-item">
                <span class="menu-icon">🕒</span>
                Appointments
            </div>
            
            <button class="logout-btn">Log Out</button>
        </div>
        
        <!-- Main Content Area -->
        <div class="main-content">
            <div class="header">
                <h1 class="page-title">Schedule Management</h1>
                <div class="date-info">
                    <div class="date-label">Today's Date</div>
                    <div class="current-date"><?php echo date('d-m-Y (h:i:sa)'); ?></div>
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="btn btn-secondary">Back</button>
                <button class="btn btn-primary" id="addSessionBtn">+ Add Session</button>
            </div>
            
            <!-- Filter Section -->
            <div class="filter-container">
                <form action="" method="post">
                    <div class="filter-row">
                        <span class="filter-label">Date:</span>
                        <input type="date" name="sheduledate" class="filter-input">
                        
                        <span class="filter-label">Doctor:</span>
                        <select name="docid" class="filter-select">
                            <option value="" disabled selected>Select Doctor</option>
                            <?php
                            // Sample PHP code to fetch doctors
                            $doctors = [
                                ["id" => 1, "name" => "Dr. Smith"],
                                ["id" => 2, "name" => "Dr. Johnson"],
                                ["id" => 3, "name" => "Dr. Williams"]
                            ];
                            
                            foreach ($doctors as $doctor) {
                                echo "<option value='{$doctor['id']}'>{$doctor['name']}</option>";
                            }
                            ?>
                        </select>
                        
                        <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
            
            <!-- Sessions Table -->
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Session Title</th>
                        <th>Doctor</th>
                        <th>Scheduled Date & Time</th>
                        <th>Max Appointments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Sample PHP code to fetch schedules
                    $schedules = [
                        [
                            "id" => 1,
                            "title" => "Morning Therapy Session",
                            "doctor" => "Dr. Smith",
                            "date" => "2023-06-15",
                            "time" => "09:00",
                            "max" => 5
                        ],
                        [
                            "id" => 2,
                            "title" => "Afternoon Counseling",
                            "doctor" => "Dr. Johnson",
                            "date" => "2023-06-15",
                            "time" => "14:00",
                            "max" => 3
                        ],
                        [
                            "id" => 3,
                            "title" => "Evening Group Therapy",
                            "doctor" => "Dr. Williams",
                            "date" => "2023-06-16",
                            "time" => "18:00",
                            "max" => 8
                        ]
                    ];
                    
                    foreach ($schedules as $schedule) {
                        echo "<tr>
                            <td>{$schedule['title']}</td>
                            <td>{$schedule['doctor']}</td>
                            <td>{$schedule['date']} {$schedule['time']}</td>
                            <td>{$schedule['max']}</td>
                            <td class='action-cell'>
                                <button class='btn btn-primary view-btn' data-id='{$schedule['id']}'>View</button>
                                <button class='btn btn-danger delete-btn' data-id='{$schedule['id']}' data-title='{$schedule['title']}'>Delete</button>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Add Session Modal -->
    <div id="addSessionModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h2 class="modal-title">Add New Session</h2>
            
            <form action="add-session.php" method="POST">
                <div class="form-group">
                    <label class="form-label">Session Title:</label>
                    <input type="text" name="title" class="form-input" placeholder="Session name" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Doctor:</label>
                    <select name="docid" class="form-select" required>
                        <option value="" disabled selected>Select Doctor</option>
                        <?php
                        foreach ($doctors as $doctor) {
                            echo "<option value='{$doctor['id']}'>{$doctor['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Max Appointments:</label>
                    <input type="number" name="nop" class="form-input" min="1" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Date:</label>
                    <input type="date" name="date" class="form-input" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Time:</label>
                    <input type="time" name="time" class="form-input" required>
                </div>
                
                <div class="form-actions">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Save Session</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- View Session Modal -->
    <div id="viewSessionModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h2 class="modal-title">Session Details</h2>
            
            <div class="form-group">
                <label class="form-label">Session Title:</label>
                <p id="view-title">Morning Therapy Session</p>
            </div>
            
            <div class="form-group">
                <label class="form-label">Doctor:</label>
                <p id="view-doctor">Dr. Smith</p>
            </div>
            
            <div class="form-group">
                <label class="form-label">Date:</label>
                <p id="view-date">2023-06-15</p>
            </div>
            
            <div class="form-group">
                <label class="form-label">Time:</label>
                <p id="view-time">09:00 AM</p>
            </div>
            
            <div class="form-group">
                <label class="form-label">Max Appointments:</label>
                <p id="view-max">5</p>
            </div>
            
            <div class="form-group">
                <label class="form-label"><b>Registered Patients (3/5):</b></label>
                <div style="max-height: 200px; overflow-y: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f2f2f2;">
                                <th style="padding: 8px; text-align: left;">Patient ID</th>
                                <th style="padding: 8px; text-align: left;">Name</th>
                                <th style="padding: 8px; text-align: left;">Appointment #</th>
                                <th style="padding: 8px; text-align: left;">Phone</th>
                            </tr>
                        </thead>
                        <tbody id="view-patients">
                            <!-- Patients will be populated here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal-overlay" style="display: none;">
        <div class="modal-content" style="text-align: center;">
            <span class="modal-close">&times;</span>
            <h2 class="modal-title">Confirm Deletion</h2>
            
            <p>Are you sure you want to delete the session "<span id="delete-session-title"></span>"?</p>
            
            <div style="display: flex; justify-content: center; gap: 15px; margin-top: 25px;">
                <button class="btn btn-secondary cancel-delete">Cancel</button>
                <button class="btn btn-danger confirm-delete">Delete</button>
            </div>
        </div>
    </div>
    
    <script>
        // Modal handling
        const addSessionBtn = document.getElementById('addSessionBtn');
        const addSessionModal = document.getElementById('addSessionModal');
        const viewSessionModal = document.getElementById('viewSessionModal');
        const deleteModal = document.getElementById('deleteModal');
        
        const closeButtons = document.querySelectorAll('.modal-close');
        
        // Show add session modal
        addSessionBtn.addEventListener('click', () => {
            addSessionModal.style.display = 'flex';
        });
        
        // Show view session modal (sample data)
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                // In a real app, you would fetch this data from the server
                document.getElementById('view-title').textContent = "Morning Therapy Session";
                document.getElementById('view-doctor').textContent = "Dr. Smith";
                document.getElementById('view-date').textContent = "2023-06-15";
                document.getElementById('view-time').textContent = "09:00 AM";
                document.getElementById('view-max').textContent = "5";
                
                // Sample patients data
                const patients = [
                    {id: "P1001", name: "John Doe", appnum: 1, phone: "555-0101"},
                    {id: "P1002", name: "Jane Smith", appnum: 2, phone: "555-0102"},
                    {id: "P1003", name: "Robert Johnson", appnum: 3, phone: "555-0103"}
                ];
                
                const patientsTable = document.getElementById('view-patients');
                patientsTable.innerHTML = '';
                
                patients.forEach(patient => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td style="padding: 8px; border-bottom: 1px solid #eee;">${patient.id}</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee;">${patient.name}</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee;">${patient.appnum}</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eee;">${patient.phone}</td>
                    `;
                    patientsTable.appendChild(row);
                });
                
                viewSessionModal.style.display = 'flex';
            });
        });
        
        // Show delete confirmation modal
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const sessionTitle = btn.getAttribute('data-title');
                document.getElementById('delete-session-title').textContent = sessionTitle;
                deleteModal.style.display = 'flex';
            });
        });
        
        // Close modals
        closeButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                addSessionModal.style.display = 'none';
                viewSessionModal.style.display = 'none';
                deleteModal.style.display = 'none';
            });
        });
        
        // Cancel delete
        document.querySelector('.cancel-delete').addEventListener('click', () => {
            deleteModal.style.display = 'none';
        });
        
        // Confirm delete (in a real app, this would submit a form or make an AJAX request)
        document.querySelector('.confirm-delete').addEventListener('click', () => {
            alert('Session deleted successfully!');
            deleteModal.style.display = 'none';
            // In a real app, you would also remove the row from the table
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === addSessionModal) {
                addSessionModal.style.display = 'none';
            }
            if (e.target === viewSessionModal) {
                viewSessionModal.style.display = 'none';
            }
            if (e.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
        });
    </script>
</body>
</html>