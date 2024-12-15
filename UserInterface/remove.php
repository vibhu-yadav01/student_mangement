<?php
session_start();
if (isset($_SESSION["professorid"])) {
    // Include database handler
    require_once $_SERVER["DOCUMENT_ROOT"] . "/PROJECT/student_mangement/DBHandler/Databaseconnection.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/PROJECT/student_mangement/DBHandler/DBStudentDetails.php";
    $dbo = new Databaseconnection();

    ?>
    <html lang="en">
    <head>
        <script>
            function confirmLogout() {
                if (confirm("Are you sure you want to log out?")) {
                    window.location.href = "../UserInterface/logout.php";
                }
            }
        </script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Professor - Remove Student</title>
        <link rel="stylesheet" href="../CSS/bootstrap/ppage.css">
        <style>
body {
    background-color: #f4f6f8;
    font-family: 'Arial', sans-serif;
}

.contain {
    max-width: 800px; /* Wider form */
    margin: 100px auto; /* Centers the form */
    padding: 40px; /* Increased padding for spacious look */
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.content h3 {
    text-align: center;
    margin-bottom: 40px; /* More spacing under heading */
    color: #E74C3C; /* Red for deletion focus */
    font-size: 24px; /* Larger font size for the title */
}

.form-group label {
    font-weight: bold;
    color: #333;
    font-size: 16px; /* Larger label text */
}

.form-control {
    border-radius: 8px; /* Rounded corners for input fields */
    border: 1px solid #ddd;
    padding: 12px; /* Increased padding for inputs */
    font-size: 18px; /* Bigger text for inputs */
}

.form-control:focus {
    border-color: #E74C3C;
    box-shadow: 0 0 5px rgba(231, 76, 60, 0.3);
}

.btn-danger {
    background-color: #E74C3C;
    border-color: #E74C3C;
    padding: 14px 20px; /* Larger button */
    font-size: 18px; /* Bigger button text */
    width: 100%; /* Full-width button */
    border-radius: 5px;
    font-weight: bold;
}

.btn-danger:hover {
    background-color: #C0392B;
    border-color: #C0392B;
}

.alert {
    margin-top: 20px;
    text-align: center;
}

.content form {
    margin: 0 auto; /* Centers the form */
    max-width: 800px; /* Matches the contain width */
}

        </style>
    </head>
    <body>
        <div class="container">
            <aside class="sidebar">
                <h2>Manage Students</h2>
                <ul>
                    <li><a href="professor.php">User Info</a></li>
                    <li><a href="student_entry.php">Student Entry</a></li>
                    <li><a href="student_list.php">Student list</a></li>
                    <li><a href="student_update.php">Marks Updation</a></li>
                    <li><a href="remove_student.php">Remove Student</a></li>
                    <li><a href="schedule.php">Schedule</a></li>
                    <li><a href="#" class="logout" onclick="confirmLogout()">Log out</a></li>
                </ul>
            </aside>

        <div class="contain">
        <div class="content">
            <h3>Remove Student</h3>
            <form action="remove.php" method="POST">
                <div class="form-group">
                    <label for="rollno">Roll Number:</label>
                    <input type="text" class="form-control" id="rollno" name="rollno" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-danger">Remove Student</button>
            </form>

                <?php
                // Handle form submission
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $rollno = $_POST['rollno'];
                    $password = $_POST['password'];

                    // Check if student exists
                    $studentDB = new DBStudentDetails();
                    $studentId = $studentDB->getID($rollno, $password);

                    if ($studentId != -1) {
                        // Delete the student from the database
                        $deleteQuery = "DELETE FROM student_detail_info WHERE Rollno = :rollno";
                        $stmt = $dbo->conn->prepare($deleteQuery);
                        $stmt->execute([':rollno' => $rollno]);

                        echo "<p class='alert alert-success'>Student removed successfully!</p>";
                    } else {
                        echo "<p class='alert alert-danger'>Invalid Roll Number or Password.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </body>
    </html>
<?php
} else {
    echo "Access Denied: Please log in as a professor.";
}
?>
