<?php
session_start();
if (isset($_SESSION["studentid"])) {
    $rootpath = $_SERVER["DOCUMENT_ROOT"];
    require_once $rootpath . "/PROJECT/student_mangement/DBHandler/DBStudentDetails.php";

    $studentDetails = new DBStudentDetails();

    // Fetch marks for the logged-in student
    $studentId = $_SESSION["studentid"];
    $studentMarks = $studentDetails->getMarksByStudentId($studentId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marks</title>
    <link rel="stylesheet" href="../CSS/bootstrap/ppage.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: rgb(57, 57, 249);
            color: white;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Student Dashboard</h2>
            <ul>
                <li><a href="studenthome.php">User Info</a></li>
                <li><a href="student_lists.php">Student List</a></li>
                <li><a href="smarks.php">Marks</a></li>
                <li><a href="progress.php">Progress</a></li>
                <li><a href="schedule2.php">Weekly Schedule</a></li>
                <li><a href="#" class="logout" onclick="confirmLogout()">Log out</a></li>
            </ul>
        </aside>
        <main>
            <h1>Your Marks</h1>
            <table>
                <thead>
                    <tr>
                        <th>Semester 1</th>
                        <th>Semester 2</th>
                        <th>Semester 3</th>
                        <th>Semester 4</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($studentMarks)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($studentMarks['Semester_1_Total']) . "</td>";
                        echo "<td>" . htmlspecialchars($studentMarks['Semester_2_Total']) . "</td>";
                        echo "<td>" . htmlspecialchars($studentMarks['Semester_3_Total']) . "</td>";
                        echo "<td>" . htmlspecialchars($studentMarks['Semester_4_Total']) . "</td>";
                        echo "</tr>";
                    } else {
                        echo "<tr><td colspan='4'>No marks available</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>

<?php
} else {
    echo "NOT A VALID STUDENT";
}
?>
