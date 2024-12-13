<?php
// Retrieve POST data for student registration
$student_rollno = $_POST['student_rollno'];
$student_name = $_POST['student_name'];
$mother_name = $_POST['mother_name'];
$father_name = $_POST['father_name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$password = $_POST['password'];
$date = $_POST['date'];

// Database connection
$conn = new mysqli('localhost', 'vaibhav', '#qwerty#001#', 'ourdatabase');
if ($conn->connect_error) {
   die('Connection Failed: ' . $conn->connect_error);
} else {
   // Prepare and bind query for student details
   $stmt = $conn->prepare("INSERT INTO student_detail_info (Rollno, Full_Name, Mothers_Name, Fathers_Name, Mobile_Number, Home_Address, Password, DOB) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
   $stmt->bind_param("isssssss", $student_rollno, $student_name, $mother_name, $father_name, $mobile, $address, $password, $date);
   $stmt->execute(); 

   // Store the Rollno in session for later use (in semester marks form)
   session_start();
   $_SESSION['student_rollno'] = $student_rollno;

   // Redirect to marks form
   header("Location: marks.php");
   $stmt->close();
   $conn->close();   
}
?>
