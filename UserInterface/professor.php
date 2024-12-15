<?php
session_start();
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/PROJECT/student_mangement/DBHandler/DBProfessorDetails.php";

if (isset($_SESSION["professorid"])) {
    $professor_id = $_SESSION["professorid"];
    $professorDetailsObj = new DBProfessorDetails();
    $details = $professorDetailsObj->getProfessorDetails($professor_id);

    if ($details) {
        $name= $details['name'];
        $description = $details["description"];
        $phone_number = $details["phone_number"];
        $photo = $details["photo"];
    } else {
        echo "No details found for this professor.";
        exit();
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
    <title>Professor Profile</title>
    <link rel="stylesheet" href="../CSS/bootstrap/ppage.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Professor Profile</h2>
            <ul>
                <li><a href="#">User Info</a></li>
                <li><a href="student_entry.php">Student Entry</a></li>
                <li><a href="student_list.php">Student list</a></li>
                <li><a href="student_update.php">Marks Updation</a></li>
                <li><a href="remove_student.php">Remove Student</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                <li><a href="#" class="logout" onclick="confirmLogout()">Log out</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="profile-header">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($photo); ?>" alt="Profile Picture" class="profile-pic">
                <h2 class="professor-name">Professor - <?php echo htmlspecialchars($name); ?></h2>
                <h2>Institute of Engineering and Rural Technology</h2>
                <p>Department of Computer Science</p>
                <hr>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($description); ?></p>
                <h3>Contact Information</h3>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone_number); ?></p>
      </div>
            </header>
        </main>
    </div>
</body>
</html>
<?php
} else {
    echo "Access Denied: Please log in as a professor.";
}
?>
