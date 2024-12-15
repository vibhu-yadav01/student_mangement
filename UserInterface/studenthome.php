<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/PROJECT/student_mangement/DBHandler/Databaseconnection.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/PROJECT/student_mangement/DBHandler/DBStudentDetails.php";

if (isset($_SESSION["studentid"])) {
    $studentId = $_SESSION["studentid"];
    $dbStudentDetails = new DBStudentDetails();

    // Fetch student details from the database
    $dbo = new Databaseconnection();
    $cmd = "
        SELECT Rollno, Full_Name, Mothers_Name, Fathers_Name, Mobile_Number, Home_Address
        FROM student_master
        WHERE Rollno = :rollno
    ";
    $templet = $dbo->conn->prepare($cmd);
    $templet->execute([":rollno" => $studentId]);

    $studentDetails = $templet->fetch(PDO::FETCH_ASSOC);
    if (!$studentDetails) {
        echo "No student data found.";
        exit;
    }
} else {
    echo "<div style='text-align: center; padding: 50px; color: #e74c3c;'><h2>NOT THE VALID STUDENT</h2></div>";
    exit;
}
?>

<!DOCTYPE html>
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
    <title>Student Profile</title>
   <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    display: flex;
    height: 100vh;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
            align-items: center;
            justify-content: center;
        } 

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            flex-shrink: 0; /* Prevent the sidebar from shrinking */
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: #34495e;
        }

        .logout {
            color: #e74c3c;
        }

        .main-content {
            flex: 1; /* Take up the remaining space */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;  /* Align content to the top */
            padding: 40px;
            background-color: #fff;
            overflow-y: auto; /* Ensure scrolling if content overflows */
        }

        .student-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
            max-width: 100%;  /* Ensure content takes up full width */
        }

        .student-info h2 {
            font-size: 24px;
            color: #2c3e50;
            text-align: center;
        }

        .student-info .info-box {
            display: flex;
            justify-content:center;
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .student-info .info-box div {
            width: 45%;
        }

        .student-info .info-box div h4 {
            font-size: 18px;
            color: #34495e;
        }

        .student-info .info-box div p {
            font-size: 16px;
            color: #7f8c8d;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

   </style>
</head>
<body>
    
        <aside class="sidebar">
            <h2>Student Profile</h2>
            <ul>
            <li><a href="studenthome.php">User Info</a></li>
            <li><a href="student_lists.php">Student list</a></li>
            <li><a href="smarks.php">Marks</a></li>
            <li><a href="progress.php">Progress</a></li>
            <li><a href="schedule2.php">Weekly Schedule</a></li>
            <li><a href="#" class="logout" onclick="confirmLogout()">Log out</a></li>
        </ul>
        </aside>
        <div class="container">
        <main class="sections">
            <h1>Welcome, <?php echo htmlspecialchars($studentDetails['Full_Name']); ?>!</h1>

            <section class="student-info">
                <h2>Your Information</h2>
                <div class="info-box">
                    <div>
                        <h4>Roll Number</h4>
                        <p><?php echo htmlspecialchars($studentDetails['Rollno']); ?></p>
                    </div>
                    <div>
                        <h4>Full Name</h4>
                        <p><?php echo htmlspecialchars($studentDetails['Full_Name']); ?></p>
                    </div>
                </div>

                <div class="info-box">
                    <div>
                        <h4>Mother's Name</h4>
                        <p><?php echo htmlspecialchars($studentDetails['Mothers_Name']); ?></p>
                    </div>
                    <div>
                        <h4>Father's Name</h4>
                        <p><?php echo htmlspecialchars($studentDetails['Fathers_Name']); ?></p>
                    </div>
                </div>

                <div class="info-box">
                    <div>
                        <h4>Phone Number</h4>
                        <p><?php echo htmlspecialchars($studentDetails['Mobile_Number']); ?></p>
                    </div>
                    <div>
                        <h4>Address</h4>
                        <p><?php echo htmlspecialchars($studentDetails['Home_Address']); ?></p>
                    </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
