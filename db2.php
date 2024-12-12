<?php
try {
    $conn = new PDO("mysql:host=localhost:3307;dbname=ourdatabase;charset=utf8mb4", "vaibhav", "#qwerty#001#");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    $conn->query('SELECT 1');
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Include the Databaseconnection class
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/PROJECT/student_mangement/DBHandler/Databaseconnection.php";

// Instantiate the Databaseconnection class
$dbo = new Databaseconnection();
$conn = $dbo->conn; // Access the PDO connection directly

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Input validation (e.g., ensure required fields are not empty)
    if (empty($_POST['student_name']) || empty($_POST['mother_name']) || empty($_POST['father_name']) || 
        empty($_POST['mobile']) || empty($_POST['address']) || empty($_POST['date'])) {
        die("Error: All fields are required.");
    }

    // Collect and sanitize form data
    $student_rollno = htmlspecialchars(trim($_POST['student_rollno']));
        if (empty($student_rollno)) {
            die("Error: Roll number is required.");
        }
    $full_name = htmlspecialchars(trim($_POST['student_name']));
    $mother_name = htmlspecialchars(trim($_POST['mother_name']));
    $father_name = htmlspecialchars(trim($_POST['father_name']));
    $mobile_number = htmlspecialchars(trim($_POST['mobile']));
    $home_address = htmlspecialchars(trim($_POST['address']));
    $date_of_birth = $_POST['date']; // Capture the Date of Birth
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);


    try {
        // Insert into student_detail_info table using a prepared statement
        $sql = "INSERT INTO student_detail_info (Rollno, Full_Name, Mother_Name, Father_Name, Mobile_Number, Home_Address, Date_Of_Birth, Password) 
                VALUES (:rollno, :full_name, :mother_name, :father_name, :mobile_number, :home_address, :date_of_birth, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':rollno', $student_rollno);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':mother_name', $mother_name);
        $stmt->bindParam(':father_name', $father_name);
        $stmt->bindParam(':mobile_number', $mobile_number);
        $stmt->bindParam(':home_address', $home_address);
        $stmt->bindParam(':date_of_birth', $date_of_birth); // Bind the Date of Birth parameter
        $stmt->bindParam(':password', $password);

        // Execute the query
        if (!$stmt->execute()) {
            error_log("Error inserting data: " . json_encode($stmt->errorInfo())); // Log detailed errors
            print_r($stmt->errorInfo());
            exit;
        }
        
        
    } catch (PDOException $e) {
        // Log error to a file instead of displaying it
        error_log("Error inserting data: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
    }
}
?>


$semesters = ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4'];
$subjects = [
    "Semester 1" => ["Engineering_Physics", "Engineering_Mathematics_I", "Fundamentals_of_Electrical_Engineering", "Programming_for_Problem_Solving", "Environment_and_Ecology", "Workshop"], // Example subjects, replace with real ones
    "Semester 2" => ["Engineering_Chemistry", "Engineering_Mathematics_II", "Fundamentals_of_Electronics_Engineering", "Fundamentals_of_Mechanical_Engineering", "Soft_Skills", "Sports_and_Yoga"],
    "Semester 3" => ["Mathematics_IV", "Technical_Communication", "Data_Structure", "Computer_Organization_and_Architecture", "Discrete_Structures_and_Theory_of_Logic", "Cyber_Security"],
    "Semester 4" => ["Digital_Electronics", "Universal_Human_Values_and_Professional_Ethics", "Operating_System", "Theory_of_Automata_and_Formal_Languages", "Object_Oriented_Programming_with_Java", "Python_Programming"],
];
