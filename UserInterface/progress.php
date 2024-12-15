<?php
session_start();
if (isset($_SESSION["studentid"])) {
    $rootpath = $_SERVER["DOCUMENT_ROOT"];
    require_once $rootpath . "/PROJECT/student_mangement/DBHandler/DBStudentDetails.php";

    $studentDetails = new DBStudentDetails();

    // Fetch marks for the logged-in student
    $studentId = $_SESSION["studentid"];
    $studentMarks = $studentDetails->getMarksByStudentId($studentId);

    // Prepare dataPoints array for CanvasJS
    $dataPoints = array();
    if (!empty($studentMarks)) {
        $dataPoints = array(
            array("y" => $studentMarks['Semester_1_Total'], "label" => "Semester 1"),
            array("y" => $studentMarks['Semester_2_Total'], "label" => "Semester 2"),
            array("y" => $studentMarks['Semester_3_Total'], "label" => "Semester 3"),
            array("y" => $studentMarks['Semester_4_Total'], "label" => "Semester 4")
        );
    } else {
        echo "No marks available.";
        exit;
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress</title>
    <link rel="stylesheet" href="../CSS/bootstrap/ppage.css">
<script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title: {
        text: "Student Progress"
    },
    axisY: {
        title: "Total Marks"
    },
    data: [{
        type: "line",
        yValueFormatString: "#,##0",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();

}
</script>
<style>
    body {
        display: flex;
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .sidebar {
        width: 250px;
        background-color: #2c3e50;
        color: white;
        padding: 15px;
        height: 100vh;
        position: fixed;
    }
    .sidebar h2 {
        text-align: center;
    }
    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }
    .sidebar ul li {
        margin: 20px 0;
    }
    .sidebar ul li a {
        color: white;
        text-decoration: none;
    }
    .sidebar ul li a:hover {
        text-decoration: underline;
    }
    .content {
        margin-left: 260px;
        padding: 20px;
        width: calc(100% - 260px);
    }
</style>
</head>
<body>
<div class="sidebar">
    <h2>Student Progress</h2>
    <ul>
        <li><a href="studenthome.php">User Info</a></li>
        <li><a href="student_lists.php">Student List</a></li>
        <li><a href="smarks.php">Marks</a></li>
        <li><a href="progress.php">Progress</a></li>
        <li><a href="schedule2.php">Weekly Schedule</a></li>
        <li><a href="#" onclick="if (confirm('Are you sure you want to log out?')) { window.location.href = '../UserInterface/logout.php'; }">Log out</a></li>
    </ul>
</div>
<div class="content">
    <div id="chartContainer" style="height: 370px; width: 100%;">
    </div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</div>
</body>
</html>
<?php
} else {
    echo "NOT A VALID STUDENT";
}
?>
