<?php
session_start();

echo 'Rollno from session: ' . $_SESSION['student_rollno'];  // Debugging line


if (isset($_SESSION['student_rollno'])) {
    $rollno = $_SESSION['student_rollno']; // Retrieve rollno from session
} else {
    die("Error: Rollno is missing.");
}

// Retrieve POST data for semester 3 marks
$semester3 = $_POST['semester3'];



// Database connection
$conn = new mysqli('localhost', 'vaibhav', '#qwerty#001#', 'ourdatabase');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Prepare and execute SQL query for semester 3 marks insertion
    $stmt = $conn->prepare("INSERT INTO semester_3 (
        Rollno, 
        Mathematics_IV, 
        Technical_Communication, 
        Data_Structure, 
        Computer_Organization_and_Architecture, 
        Discrete_Structures_and_Theory_of_Logic, 
        Cyber_Security, 
        Total_Marks
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters, including the default value for 'Cyber Security'
    $stmt->bind_param(
        "iiiiiiii", 
        $rollno, // Using the Rollno from session
        $semester3['Mathematics-IV'], 
        $semester3['Technical_Communication'], 
        $semester3['Data_Structure'], 
        $semester3['Computer_Organization_and_Architecture'], 
        $semester3['Discrete_Structures_Theory_of_Logic'], 
        $semester3['Cyber_Security'], 
        $semester3['total_marks']
    );

    $stmt->execute();
    session_start();  // Always call session_start() before using session variables
 
     $_SESSION['student_rollno'] = $rollno;  // Store rollno in session
     echo 'Rollno in session: ' . $_SESSION['student_rollno'];  // Debugging line
 
 // Redirect to marks2.php
    header("Location: marks4.php");
    exit();  // Always use exit() after header to stop further execution
    
}
?>
