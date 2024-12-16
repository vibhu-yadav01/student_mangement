<?php
session_start();

echo 'Rollno from session: ' . $_SESSION['student_rollno'];  // Debugging line


if (isset($_SESSION['student_rollno'])) {
    $rollno = $_SESSION['student_rollno']; // Retrieve rollno from session
} else {
    die("Error: Rollno is missing.");
}


// Retrieve POST data for semester 2 marks
$semester2 = $_POST['semester2'];



// Database connection
$conn = new mysqli('localhost', 'vaibhav', '#qwerty#001#', 'ourdatabase');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Prepare and execute SQL query for semester 2 marks insertion
    $stmt = $conn->prepare("INSERT INTO semester_2 (
        Rollno, 
        Engineering_Chemistry, 
        Engineering_Mathematics_II, 
        Fundamentals_of_Electronics_Engineering, 
        Fundamentals_of_Mechanical_Engineering, 
        Soft_Skills, 
        Sports_and_Yoga, 
        Total_Marks
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters, including the default value for 'Sports and Yoga'
    $stmt->bind_param(
        "iiiiiiii", 
        $rollno, // Using the Rollno from session
        $semester2['engineering_chemistry'], 
        $semester2['engineering_mathematics'], 
        $semester2['fundamentals_of_electronics_engineering'], 
        $semester2['Mechanical'], 
        $semester2['Soft_skills'], 
        $semester2['Sports_and_Yoga'], 
        $semester2['total_marks']
    );

    $stmt->execute();
    session_start();  // Always call session_start() before using session variables
 
     $_SESSION['student_rollno'] = $rollno;  // Store rollno in session
     echo 'Rollno in session: ' . $_SESSION['student_rollno'];  // Debugging line
 
 // Redirect to marks2.php
    header("Location: marks3.php");
    exit();  // Always use exit() after header to stop further execution
    
}
?>
