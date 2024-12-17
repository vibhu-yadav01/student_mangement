<?php
session_start();
if (isset($_GET['status']) && $_GET['status'] === 'completed') {
    echo "<script>alert('COMPLETED');</script>";
}

if (isset($_SESSION["professorid"])) {
    $rootpath = $_SERVER["DOCUMENT_ROOT"];
    require_once $rootpath . "/PROJECT/student_mangement/DBHandler/DBStudentDetails.php";
    require_once $rootpath . "/PROJECT/student_mangement/DBHandler/DBProfessorDetails.php";

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
        if (isset($_GET['delete'])) {
            $rollnoToDelete = $_GET['delete'];
        
            // Attempt to delete the student
            $isDeleted = $studentDetails->deleteStudentByRollno($rollnoToDelete);
        
            if ($isDeleted) {
                echo "<script>alert('Student with Roll Number $rollnoToDelete deleted successfully.');</script>";
            } else {
                echo "<script>alert('Failed to delete student. Please try again.');</script>";
            }
        
            // Refresh the page to reflect changes
            echo "<script>window.location.href = 'student_list.php';</script>";
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
        
    function confirmDelete(rollno) {
        if (confirm("Are you sure you want to delete the student with Roll Number " + rollno + "?")) {
            window.location.href = "?delete=" + encodeURIComponent(rollno);
        }
    }
</script>

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
            background-color:rgb(109, 159, 239);
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
        button {
        padding: 5px 10px;
        background-color: #dc3545; /* Bootstrap danger color */
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background-color: #c82333;
    </style>
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
                <li><a href="schedule.php">Schedule</a></li>
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
                        <th>Password</th>
                        <th>Action</th>
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
                            echo "<td>" . htmlspecialchars($row['Password']) . "</td>";
                            echo "<td>";
                            echo "<button onclick=\"confirmDelete('" . htmlspecialchars($row['Rollno']) . "')\">Delete</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No students found</td></tr>";
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
