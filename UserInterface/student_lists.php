<?php
session_start();
if (isset($_SESSION["studentid"])) {
    $rootpath = $_SERVER["DOCUMENT_ROOT"];
    require_once $rootpath . "/PROJECT/student_mangement/DBHandler/DBStudentDetails.php";

    $studentDetails = new DBStudentDetails();

    // Handle search query
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // Determine the sorting order based on the query parameter
    $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'name';

    // Fetch students based on search and sorting
    if (!empty($searchTerm)) {
        $students = $studentDetails->getStudentListByName($searchTerm);
    } else {
        switch ($sortOrder) {
            case 'rollno':
                $students = $studentDetails->getStudentListSortedByRollno();
                break;
            case 'rank':
                $students = $studentDetails->getStudentListSortedByRank();
                break;
            case 'name':
            default:
                $students = $studentDetails->getStudentListSortedByName();
                break;
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

        function handleSortChange() {
            const sort = document.getElementById("sort").value;
            const search = document.getElementById("searchInput").value;
            window.location.href = "?sort=" + sort + "&search=" + encodeURIComponent(search);
        }
    </script>
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
            background-color:rgb(57, 74, 188);
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
            <h2>Student list</h2>
            <ul>
            <li><a href="studenthome.php">User Info</a></li>
            <li><a href="student_lists.php">Student list</a></li>
            <li><a href="smarks.php">Marks</a></li>
            <li><a href="progress.php">Progress</a></li>
            <li><a href="schedule2.php">Weekly Schedule</a></li>
            <li><a href="#" class="logout" onclick="confirmLogout()">Log out</a></li>
        </ul>
        </aside>
        <main>
            <h1>Student List</h1>
            <div class="controls-container">
                <form method="GET" action="">
                    <input type="text" id="searchInput" name="search" placeholder="Search by name" value="<?= htmlspecialchars($searchTerm) ?>">
                    <button type="submit">Search</button>
                </form>
                <div>
                    <label for="sort">Sort By:</label>
                    <select id="sort" onchange="handleSortChange()">
                        <option value="name" <?= $sortOrder === 'name' ? 'selected' : '' ?>>Name (Alphabetical Order)</option>
                        <option value="rollno" <?= $sortOrder === 'rollno' ? 'selected' : '' ?>>Roll Number</option>
                        <option value="rank" <?= $sortOrder === 'rank' ? 'selected' : '' ?>>Rank (Highest Total Marks)</option>
                    </select>
                </div>
            </div>
            <table>
                <thead>
                <tr>
                        <th>Roll Number</th>
                        <th>Name</th>
                        <Th>Date Of Birth</Th>
                        <th>Semester 1 Total</th>
                        <th>Semester 2 Total</th>
                        <th>Semester 3 Total</th>
                        <th>Semester 4 Total</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($students)) {
                        foreach ($students as $row) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['Rollno']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Full_Name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['DOB']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Semester_1_Total']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Semester_2_Total']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Semester_3_Total']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Semester_4_Total']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Total']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No students found</td></tr>";
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
    echo "NOT THE VALID STUDENT";
}
?>
