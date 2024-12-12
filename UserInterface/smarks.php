<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/PROJECT/student_mangement/DBHandler/Databaseconnection.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/PROJECT/student_mangement/DBHandler/DBStudentDetails.php";

$dbo = new Databaseconnection();
$conn = $dbo->conn; // Access the PDO connection

// Initialize marks data
$marksData = ['marks_obtained' => null, 'average_marks' => null, 'highest_marks' => null];

// Retrieve selected semester and subject
$semester = $_POST['semester'] ?? null;
$subject = $_POST['subject'] ?? null;

if ($semester && $subject) {
    try {
        // Build the dynamic query to fetch data from the specific subject column
        $query = "SELECT 
                    $subject AS marks_obtained, 
                    AVG($subject) AS average_marks, 
                    MAX($subject) AS highest_marks 
                  FROM student_master
                  WHERE $subject IS NOT NULL";

        $stmt = $conn->query($query);

        if ($stmt) {
            $marksData = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="../CSS/bootstrap/ppage.css">
    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "../UserInterface/logout.php";
            }
        }

        function updateSubjects() {
            const semester = document.getElementById('semester').value;
            const subjectDropdown = document.getElementById('subject');
            subjectDropdown.innerHTML = ''; // Clear previous options

            const subjects = {
                semester_1: [
                    'Engineering_Physics', 
                    'Engineering_Mathematics_I', 
                    'Fundamentals_of_Electrical_Engineering', 
                    'Programming_for_Problem_Solving', 
                    'Environment_and_Ecology', 
                    'Workshop'
                ],
                semester_2: [
                    'Engineering_Chemistry',
                    'Engineering_Mathematics_II',
                    'Fundamentals_of_Electronics_Engineering',
                    'Fundamentals_of_Mechanical_Engineering',
                    'Soft_Skills',
                    'Sports_and_Yoga'
                ],
                semester_3: [
                    'Mathematics_IV',
                    'Technical_Communication',
                    'Data_Structure',
                    'Computer_Organization_and_Architecture',
                    'Discrete_Structures_and_Theory_of_Logic',
                    'Cyber_Security'
                ],
                semester_4: [
                    'Digital_Electronics',
                    'Universal_Human_Values_and_Professional_Ethics',
                    'Operating_System',
                    'Theory_of_Automata_and_Formal_Languages',
                    'Object_Oriented_Programming_with_Java',
                    'Python_Programming'
                ]
            };

            if (subjects[semester]) {
                subjects[semester].forEach(subject => {
                    const option = document.createElement('option');
                    option.value = subject;
                    option.textContent = subject.replace(/_/g, ' ');
                    subjectDropdown.appendChild(option);
                });
            }
        }
    </script>

    <title>Student Profile</title>
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
            background-color:rgb(57, 57, 249);
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .controls-container {
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .controls-container input[type="text"] {
            width: 300px;
            padding: 10px;
            font-size: 1em;
            border: 2px solid #ddd;
            border-radius: 8px;
        }
        .controls-container input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }
        .controls-container button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .controls-container button:hover {
            background-color: #0056b3;
        }
        .controls-container select {
            padding: 10px;
            font-size: 1em;
            border: 2px solid #ddd;
            border-radius: 8px;
        }
        .controls-container select:focus {
            border-color: #007bff;
            outline: none;
        }
    </style>
</head>
<body>
<div class="container">
    <aside class="sidebar">
        <h2>Student Profile</h2>
        <ul>
            <li><a href="#">User Info</a></li>
            <li><a href="student_lists.php">Student list</a></li>
            <li><a href="smarks.php">Marks</a></li>
            <li><a href="#">Progress</a></li>
            <li><a href="#">Weekly Schedule</a></li>
            <li><a href="#" class="logout" onclick="confirmLogout()">Log out</a></li>
        </ul>
    </aside>

    <main>
        <h1>Marks</h1>
        <form method="POST" action="smarks.php">
            <label for="semester">Select Semester:</label>
            <select id="semester" name="semester" onchange="updateSubjects()">
                <option value="">Select</option>
                <option value="semester_1">Semester 1</option>
                <option value="semester_2">Semester 2</option>
                <option value="semester_3">Semester 3</option>
                <option value="semester_4">Semester 4</option>
            </select>

            <label for="subject">Select Subject:</label>
            <select id="subject" name="subject">
                <option value="">Select</option>
            </select>

            <button type="submit">Show Marks</button>
        </form>

        <?php if ($marksData['marks_obtained'] !== null) : ?>
            <h2>Marks Details for <?= htmlspecialchars($subject) ?> (<?= htmlspecialchars($semester) ?>)</h2>
            <table>
                <thead>
                    <tr>
                        <th>Marks Obtained</th>
                        <th>Average Marks</th>
                        <th>Highest Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($marksData['marks_obtained'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($marksData['average_marks'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($marksData['highest_marks'] ?? 'N/A') ?></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>
