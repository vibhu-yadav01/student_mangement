<?php
session_start();
if (isset($_SESSION["professorid"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Schedule</title>
    <link rel="stylesheet" href="../CSS/bootstrap/ppage.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f6fa;
        }

        .container {
            display: flex;
        }

        .content-section {
            flex: 1;
            padding: 30px;
            background-color: #f5f6fa;
        }

        .content-section h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
        }

        .info-bar {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        thead {
            background-color: #3498db;
            color: white;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        td {
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .recess-row {
            font-weight: bold;
            background-color: #e9ecef;
        }

        @media (max-width: 768px) {
            .content-section {
                padding: 15px;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "../UserInterface/logout.php";
            }
        }
    </script>
</head>
<body>
    <div class="container">
    <aside class="sidebar">
            <h2>Student List</h2>
            <ul>
                <li><a href="professor.php">User Info</a></li>
                <li><a href="student_entry.php" >Student Entry</a></li>
                <li><a href="student_list.php">Student List</a></li>
                <li><a href="student_update.php">Marks Updation</a></li>
                <li><a href="remove_student.php">Remove Student</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                <li><a href="#" class="logout" onclick="confirmLogout()">Log out</a></li>
            </ul>
        </aside>
        <div class="content-section">
            <?php
            $currentDay = date('l');
            // $currentDay = 'Monday'; // Get the current day (e.g., Monday)
            $schedule = [
                'Monday' => ['MP (IBD)', 'DAA (RG)', 'DAA (RG)', 'DBMS (IBD)', 'MLT (ST)', 'RECESS', 'WT (SP) LAB-1', 'DBMS LAB (IBD)', 'Activity'],
                'Tuesday' => ['DAA (RG)', 'DAA (RG)', 'CG (DG)', 'MLT (ST)', 'WT (SP) LAB-1', 'RECESS', 'DBMS LAB (IBD)', 'Activity', 'Activity'],
                'Wednesday' => ['CG (DG)', 'DAA (RG)', 'DAA (RG)', 'DBMS (IBD)', 'ST (ST)', 'RECESS', 'DAA LAB (RG)', 'Activity', 'Activity'],
                'Thursday' => ['WT (SP)', 'WT (SP)', 'IBD (IBD)', 'MP (IBD)', 'MLT (ST)', 'RECESS', 'WT (SP)', 'Activity', 'Activity'],
                'Friday' => ['DBMS (IBD)', 'WT (SP)', 'DAA (RG)', 'CG (DG)', 'MLT (ST)', 'RECESS', 'CI (PS)', 'Activity', 'Activity'],
                'Saturday' => ['LIBRARY (CL)', 'WT (SP)', 'SP (ST)', 'DBMS (IBD)', 'CG (DG)', 'RECESS', '', '', '']
            ];
            ?>
            <h2>B.Tech Semester Time-Table (Session: 2024-2025)</h2>
            <div class="info-bar">
                <strong>Semester:</strong> 5th | <strong>Section:</strong> A3 (Computer Science & Engineering) | <strong>Room No.:</strong> 17 (S Block)
            </div>
            <h3>Today's Schedule (<?php echo $currentDay; ?>)</h3>

            <?php if (isset($schedule[$currentDay])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Subject</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Time slots for the schedule
                    $timeSlots = [
                        '09:00 AM - 09:50 AM',
                        '09:50 AM - 10:40 AM',
                        '10:40 AM - 11:30 AM',
                        '11:30 AM - 12:20 PM',
                        '12:20 PM - 01:10 PM',
                        '01:10 PM - 02:20 PM',
                        '02:20 PM - 03:10 PM',
                        '03:10 PM - 04:00 PM',
                        '04:00 PM - 04:50 PM'
                    ];

                    // Display the schedule for the current day
                    foreach ($schedule[$currentDay] as $index => $subject) {
                        $isRecess = ($subject === 'RECESS');
                        echo "<tr" . ($isRecess ? " class='recess-row'" : "") . ">";
                        echo "<td>{$timeSlots[$index]}</td>";
                        echo "<td>{$subject}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="info-bar">
                <p>No schedule available for today.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php
} else {
    echo "<div style='text-align: center; padding: 50px; color: #e74c3c;'><h2>NOT THE VALID STUDENT</h2></div>";
}
?>