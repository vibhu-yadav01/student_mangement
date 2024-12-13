<?php
session_start();

echo 'Rollno from session: ' . $_SESSION['student_rollno'];  // Debugging line


if (isset($_SESSION['student_rollno'])) {
    $rollno = $_SESSION['student_rollno']; // Retrieve rollno from session
} else {
    die("Error: Rollno is missing.");
}


// Retrieve POST data for semester 4 marks
$semester4 = $_POST['semester4'];

$Theory_of_Automata_and_Formal_Languages = isset($semester3['Theory_of_Automata_and_Formal_Languages']) && !empty($semester3['Theory_of_Automata_and_Formal_Languages']) ? $semester3['Theory_of_Automata_and_Formal_Languages'] : 0; // Default to 0 if empty
$Python_Programming = isset($semester3['Python_Programming']) && !empty($semester3['Python_Programming']) ? $semester3['Python_Programming'] : 0; // Default to 0 if empty


// Database connection
$conn = new mysqli('localhost', 'vaibhav', '#qwerty#001#', 'ourdatabase');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Prepare and execute SQL query for semester 4 marks insertion
    $stmt = $conn->prepare("INSERT INTO semester_4 (
        Rollno, 
        Digital_Electronics, 
        Universal_Human_Values_and_Professional_Ethics, 
        Operating_System, 
        Theory_of_Automata_and_Formal_Languages, 
        Object_Oriented_Programming_with_Java, 
        Python_Programming, 
        Total_Marks
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param(
        "iiiiiiii", 
        $rollno, 
        $semester4['Digital_Electronics'], 
        $semester4['Universal_Human_Values_and_Professional_Ethics'], 
        $semester4['Operating_System'], 
        $Theory_of_Automata_and_Formal_Languages, 
        $semester4['Object_Oriented_Programming_with_Java'], 
        $Python_Programming, 
        $semester4['total_marks']
    );

    // Execute and handle success/failure
    $stmt->execute();
    session_start();  // Always call session_start() before using session variables
 
     $_SESSION['student_rollno'] = $rollno;  // Store rollno in session
     echo 'Rollno in session: ' . $_SESSION['student_rollno'];  // Debugging line
 
 // Redirect to marks2.php
    header("Location: student_entry.php?status=completed");
    exit();  // Always use exit() after header to stop further execution
}
?>
