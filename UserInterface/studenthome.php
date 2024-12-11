<?php
session_start();
if (isset($_SESSION["studentid"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        nav {
            background-color: #333;
            padding: 10px 20px;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-size: 16px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .welcome-section {
            text-align: center;
            padding: 50px 20px;
            background-color: #e9ecef;
            border-bottom: 1px solid #ddd;
            flex: 1;
        }
        .welcome-section h1 {
            font-size: 2.5em;
            color: #007BFF;
        }
        .button-container {
            margin: 20px 0;
        }
        .button-container a {
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .button-container a:hover {
            background-color: #0056b3;
        }
        .content-section {
            margin: 20px auto;
            width: 80%;
            text-align: center;
        }
        .info-box {
            display: inline-block;
            margin: 10px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 200px;
        }
        .info-box h3 {
            margin-bottom: 10px;
            color: #007BFF;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #333;
            color: white;
        }
        td:nth-child(1) {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <nav>
        <a href="#students">Students</a>
        <a href="#marks">Marks</a>
        <a href="#progress">Progress</a>
        <a href="#logout">Logout</a>
    </nav>

    <div class="welcome-section">
        <h1>Welcome, Student</h1>
        <div class="button-container">
            <a href="#course-registration">Course Registration</a>
        </div>
    </div>

    <div class="content-section">
        <div class="info-box">
            <h3>View Students</h3>
            <p>Explore the list of students and their profiles.</p>
        </div>
        <div class="info-box">
            <h3>Check Marks</h3>
            <p>View marks and performance analysis for all semesters.</p>
        </div>
        <div class="info-box">
            <h3>Track Progress</h3>
            <p>See detailed progress and improvement trends.</p>
        </div>
    </div>

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

    <footer>
        &copy; 2024 Student Management System. All rights reserved.
    </footer>
</body>
</html>
<?php
} else {
    echo "NOT THE VALID STUDENT";
}
?>