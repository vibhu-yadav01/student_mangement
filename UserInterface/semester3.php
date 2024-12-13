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

// Check if 'Cyber Security' is empty and set a default value if needed
$cyber_security_marks = isset($semester3['Cyber_Security']) && !empty($semester3['Cyber_Security']) ? $semester3['Cyber_Security'] : 0; // Default to 0 if empty
$Data_Structure = isset($semester3['Data_Structure']) && !empty($semester3['Data_Structure']) ? $semester3['Data_Structure'] : 0; // Default to 0 if empty

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
        $Data_Structure,
        $semester3['Computer_Organization_and_Architecture'], 
        $semester3['Discrete_Structures_Theory_of_Logic'], 
        $cyber_security_marks,  // Using the validated value
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
