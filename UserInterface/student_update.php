<?php
session_start();
if (isset($_SESSION["professorid"])) {
    // Include database handler
    require_once $_SERVER["DOCUMENT_ROOT"] . "/PROJECT/student_mangement/DBHandler/Databaseconnection.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/PROJECT/student_mangement/DBHandler/DBStudentDetails.php";
    $dbo = new Databaseconnection();

    ?>
    <html lang="en">
    <head>
        <script>
            function confirmLogout() {
                if (confirm("Are you sure you want to log out?")) {
                    window.location.href = "../UserInterface/logout.php";
                }
            }

            function loadSubjects(semester) {
                const semesterSubjects = {
                    'semester1': ['Engineering Physics', 'Engineering Mathematics I', 'Fundamentals of Electrical Engineering', 'Programming for Problem Solving', 'Environment and Ecology', 'Workshop'],
                    'semester2': ['Engineering Chemistry', 'Engineering Mathematics II', 'Fundamentals of Electronics Engineering', 'Fundamentals of Mechanical Engineering', 'Soft Skills', 'Sports and Yoga'],
                    'semester3': ['Mathematics IV', 'Technical Communication', 'Data Structure', 'Computer Organization and Architecture', 'Discrete Structures and Theory of Logic', 'Cyber Security'],
                    'semester4': ['Digital Electronics', 'Universal Human Values and Professional Ethics', 'Operating System', 'Theory of Automata and Formal Languages', 'Object Oriented Programming with Java', 'Python Programming']
                };
                
                let subjects = semesterSubjects[semester];
                let subjectDropdown = document.getElementById("subject");
                subjectDropdown.innerHTML = '<option value="">Select Subject</option>';
                subjects.forEach(subject => {
                    let option = document.createElement("option");
                    option.value = subject;
                    option.text = subject;
                    subjectDropdown.appendChild(option);
                });
            }
        </script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Professor Profile</title>
        <link rel="stylesheet" href="../CSS/bootstrap/ppage.css">
        <style>
body {
    background-color: #f4f6f8;
    font-family: 'Arial', sans-serif;
}

.contain {
    max-width: 800px; /* Wider form */
    margin: 100px auto; /* Centers the form */
    padding: 40px; /* Increased padding for spacious look */
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.content h3 {
    text-align: center;
    margin-bottom: 40px; /* More spacing under heading */
    color: #4CAF50;
    font-size: 24px; /* Larger font size for the title */
}

.form-group label {
    font-weight: bold;
    color: #333;
    font-size: 16px; /* Larger label text */
}

.form-control {
    border-radius: 8px; /* Rounded corners for input fields */
    border: 1px solid #ddd;
    padding: 12px; /* Increased padding for inputs */
    font-size: 18px; /* Bigger text for inputs */
}

.form-control:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
}

.btn-primary {
    background-color: #4CAF50;
    border-color: #4CAF50;
    padding: 14px 20px; /* Larger button */
    font-size: 18px; /* Bigger button text */
    width: 100%; /* Full-width button */
    border-radius: 5px;
    font-weight: bold;
}

.btn-primary:hover {
    background-color: #45a049;
    border-color: #45a049;
}

.alert {
    margin-top: 20px;
    text-align: center;
}

.form-group select,
.form-group input {
    width: 100%;
}

.content form {
    margin: 0 auto; /* Centers the form */
    max-width: 800px; /* Matches the contain width */
}

    </style>
    </head>
    <body>
        <div class="container">
            <aside class="sidebar">
                <h2>Marks Updation</h2>
                <ul>
                    <li><a href="professor.php">User Info</a></li>
                    <li><a href="student_entry.php">Student Entry</a></li>
                    <li><a href="student_list.php">Student list</a></li>
                    <li><a href="student_update.php">Marks Updation</a></li>
                    <li><a href="schedule.php">Schedule</a></li>
                    <li><a href="#" class="logout" onclick="confirmLogout()">Log out</a></li>
                </ul>
            </aside>
        <div class="contain">
        <div class="content">
            <h3>Update Student Marks</h3>
            <form action="student_update.php" method="POST">
                <div class="form-group">
                    <label for="rollno">Roll Number:</label>
                    <input type="text" class="form-control" id="rollno" name="rollno" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="semester">Select Semester:</label>
                    <select class="form-control" id="semester" name="semester" onchange="loadSubjects(this.value)" required>
                        <option value="">Select Semester</option>
                        <option value="semester1">Semester 1</option>
                        <option value="semester2">Semester 2</option>
                        <option value="semester3">Semester 3</option>
                        <option value="semester4">Semester 4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subject">Select Subject:</label>
                    <select class="form-control" id="subject" name="subject" required>
                        <option value="">Select Subject</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="new_marks">New Marks:</label>
                    <input type="number" class="form-control" id="new_marks" name="new_marks" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Marks</button>
            </form>

                <?php
                // Handle form submission
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $rollno = $_POST['rollno'];
                    $password = $_POST['password'];
                    $semester = $_POST['semester'];
                    $subject = $_POST['subject'];
                    $new_marks = $_POST['new_marks'];

                    // Check student ID
                    $studentDB = new DBStudentDetails();
                    $studentId = $studentDB->getID($rollno, $password);

                    if ($studentId != -1) {
                        // Map semester and subject to database column names
                        $subjectColumnMapping = [
                            'semester1' => [
                                'Engineering Physics' => 'Engineering_Physics',
                                'Engineering Mathematics I' => 'Engineering_Mathematics_I',
                                'Fundamentals of Electrical Engineering' => 'Fundamentals_of_Electrical_Engineering',
                                'Programming for Problem Solving' => 'Programming_for_Problem_Solving',
                                'Environment and Ecology' => 'Environment_and_Ecology',
                                'Workshop' => 'Workshop'
                            ],
                            'semester2' => [
                                'Engineering Chemistry' => 'Engineering_Chemistry',
                                'Engineering Mathematics II' => 'Engineering_Mathematics_II',
                                'Fundamentals of Electronics Engineering' => 'Fundamentals_of_Electronics_Engineering',
                                'Fundamentals of Mechanical Engineering' => 'Fundamentals_of_Mechanical_Engineering',
                                'Soft Skills' => 'Soft_Skills',
                                'Sports and Yoga' => 'Sports_and_Yoga'
                            ],
                            'semester3' => [
                                'Mathematics IV' => 'Mathematics_IV',
                                'Technical Communication' => 'Technical_Communication',
                                'Data Structure' => 'Data_Structure',
                                'Computer Organization and Architecture' => 'Computer_Organization_and_Architecture',
                                'Discrete Structures and Theory of Logic' => 'Discrete_Structures_and_Theory_of_Logic',
                                'Cyber Security' => 'Cyber_Security'
                            ],
                            'semester4' => [
                                'Digital Electronics' => 'Digital_Electronics',
                                'Universal Human Values and Professional Ethics' => 'Universal_Human_Values_and_Professional_Ethics',
                                'Operating System' => 'Operating_System',
                                'Theory of Automata and Formal Languages' => 'Theory_of_Automata_and_Formal_Languages',
                                'Object Oriented Programming with Java' => 'Object_Oriented_Programming_with_Java',
                                'Python Programming' => 'Python_Programming'
                            ]
                        ];

                        if (isset($subjectColumnMapping[$semester][$subject])) {
                            $column = $subjectColumnMapping[$semester][$subject];

                            // Update the database with new marks
                            $updateQuery = "UPDATE student_master SET $column = :new_marks WHERE Rollno = :rollno";
                            $stmt = $dbo->conn->prepare($updateQuery);
                            $stmt->execute([':new_marks' => $new_marks, ':rollno' => $rollno]);

                            echo "<p class='alert alert-success'>Marks updated successfully!</p>";
                        } else {
                            echo "<p class='alert alert-danger'>Invalid subject for the selected semester.</p>";
                        }
                    } else {
                        echo "<p class='alert alert-danger'>Invalid Roll Number or Password.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </body>
    </html>
<?php
} else {
    echo "Access Denied: Please log in as a professor.";
}
?>
