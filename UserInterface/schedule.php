<?php
session_start();
if (isset($_SESSION["professorid"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Schedule</title>
<link rel="stylesheet" href="../CSS/bootstrap/ppage.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>Schedule</h2>
      <ul>
        <li><a href="professor.php">User Info</a></li>
        <li><a href="student_entry.php">Student Entry</a></li>
        <li><a href="#">Schedule</a></li>
        <li><a href="#">Notifications</a></li>
        <li><a href="#" class="logout">Log out</a></li>
      </ul>
    </aside>
    <div class="content-section">
        <h2>B.Tech Semester Time-Table (Session: 2024-2025)</h2>
        <p><strong>Semester:</strong> 5th | <strong>Section:</strong> A3 (Computer Science & Engineering) | <strong>Room No.:</strong> 17 (S Block) | <strong>w.e.f:</strong> 26/09/2022</p>
        <table>
            <thead>
                <tr>
                    <th>Period/Days</th>
                    <th>09:00 AM - 09:50 AM</th>
                    <th>09:50 AM - 10:40 AM</th>
                    <th>10:40 AM - 11:30 AM</th>
                    <th>11:30 AM - 12:20 PM</th>
                    <th>12:20 PM - 01:10 PM</th>
                    <th>01:10 PM - 02:20 PM</th>
                    <th>02:20 PM - 03:10 PM</th>
                    <th>03:10 PM - 04:00 PM</th>
                    <th>04:00 PM - 04:50 PM</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Monday</td>
                    <td>MP (IBD)</td>
                    <td>DAA (RG)</td>
                    <td>DAA (RG)</td>
                    <td>DBMS (IBD)</td>
                    <td>MLT (ST)</td>
                    <td rowspan="6" style="writing-mode:  vertical-rl; text-align: center; font-weight: bold; background-color: #e9ecef; color: #333;">R E C E S S</td>
                    <td>WT (SP) LAB-1</td>
                    <td>DBMS LAB (IBD)</td>
                    <td>Activity</td>
                </tr>
                <tr>
                    <td>Tuesday</td>
                    <td>DAA (RG)</td>
                    <td>DAA (RG)</td>
                    <td>CG (DG)</td>
                    <td>MLT (ST)</td>
                    <td>WT (SP) LAB-1</td>
                    <td>DBMS LAB (IBD)</td>
                    <td>Activity</td>
                    <td>Activity</td>
                </tr>
                <tr>
                    <td>Wednesday</td>
                    <td>CG (DG)</td>
                    <td>DAA (RG)</td>
                    <td>DAA (RG)</td>
                    <td>DBMS (IBD)</td>
                    <td>ST (ST)</td>
                    <td>DAA LAB (RG)</td>
                    <td>Activity</td>
                    <td>Activity</td>
                </tr>
                <tr>
                    <td>Thursday</td>
                    <td>WT (SP)</td>
                    <td>WT (SP)</td>
                    <td>IBD (IBD)</td>
                    <td>MP (IBD)</td>
                    <td>MLT (ST)</td>
                    <td>WT (SP)</td>
                    <td>Activity</td>
                    <td>Activity</td>
                </tr>
                <tr>
                    <td>Friday</td>
                    <td>DBMS (IBD)</td>
                    <td>WT (SP)</td>
                    <td>DAA (RG)</td>
                    <td>CG (DG)</td>
                    <td>MLT (ST)</td>
                    <td>CI (PS)</td>
                    <td>Activity</td>
                    <td>Activity</td>
                </tr>
                <tr>
                    <td>Saturday</td>
                    <td>LIBRARY (CL)</td>
                    <td>WT (SP)</td>
                    <td>SP (ST)</td>
                    <td>DBMS (IBD)</td>
                    <td>CG (DG)</td>
                    <td style= " background-color: #e9ecef;"></td>
                    <td style= " background-color: #e9ecef;"></td>
                    <td style= " background-color: #e9ecef;"></td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
</body>
</html>
<?php
} else {
    echo "NOT THE VALID STUDENT";
}
?>