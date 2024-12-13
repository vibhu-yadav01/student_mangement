<?php
session_start();

// Retrieve Rollno from session
if (isset($_SESSION['student_rollno'])) {
    $rollno = $_SESSION['student_rollno']; // Rollno stored in session after registration
} else {
    die("Rollno is missing.");
}

// Retrieve POST data for semester 1 marks
$semester1 = $_POST['semester1'];



// Database connection
$conn = new mysqli('localhost', 'vaibhav', '#qwerty#001#', 'ourdatabase');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Prepare and execute SQL query for semester marks insertion
    $stmt = $conn->prepare("INSERT INTO semester_1 (
        Rollno, 
        Engineering_Physics, 
        Engineering_Mathematics_I, 
        Fundamentals_of_Electrical_Engineering, 
        Programming_for_Problem_Solving, 
        Environment_and_Ecology, 
        Workshop, 
        Total_Marks
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters, including the default value for 'Workshop'
    $stmt->bind_param(
        "iiiiiiii", 
        $rollno, // Using the Rollno from session
        $semester1['engineering_physics'], 
        $semester1['engineering_mathematics'], 
        $semester1['fundamentals_of_electrical_engineering'], 
        $semester1['programming_for_problem_solving'], 
        $semester1['environment_and_ecology'], 
        $semester1['Workshop'], 
        $semester1['total_marks']
    );

    // Execute and handle success/failure
   $stmt->execute();
   session_start();  // Always call session_start() before using session variables

    $_SESSION['student_rollno'] = $rollno;  // Store rollno in session
    echo 'Rollno in session: ' . $_SESSION['student_rollno'];  // Debugging line

// Redirect to marks2.php
   header("Location: marks2.php");
   exit();  // Always use exit() after header to stop further execution
   
   
}
?>
