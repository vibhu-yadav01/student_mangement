<?php
session_start();
if (isset($_SESSION["professorid"])) {
?>
<!-- Save as marks_entry.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Semester Marks Entry</title>
  <link rel="stylesheet" href="../CSS/bootstrap/ppage.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>Student Entry</h2>
      <ul>
        <li><a href="professor.php">User Info</a></li>
        <li><a href="student_entry.html">Student Entry</a></li>
        <li><a href="schedule.php">Schedule</a></li>
        <li><a href="#">Notifications</a></li>
        <li><a href="#" class="logout">Log out</a></li>
      </ul>
    </aside>

    <div class="main-content">
      <form action="semester1.php" method="POST" id="marksForm" class="profile-form">
        <h1>Marks Entry</h1>
        
        <div id="semester-container">
          <!-- Semester 1 -->
          <div class="semester-section" id="semester-1">
            <h2>Semester 1</h2>
            <!-- Subjects for Semester 1 -->
            <div class="form-group">
              <label for="physics-1">Engineering Physics:</label>
              <input type="number" id="physics-1" name="semester1[engineering_physics]" max="100" required>
            </div>
            <div class="form-group">
              <label for="math-1">Engineering Mathematics - I:</label>
              <input type="number" id="math-1" name="semester1[engineering_mathematics]" max="100" required>
            </div>
            <div class="form-group">
              <label for="electrical-1">Fundamentals of Electrical Engineering:</label>
              <input type="number" id="electrical-1" name="semester1[fundamentals_of_electrical_engineering]" max="100" required>
            </div>
            <div class="form-group">
              <label for="programming-1">Programming for Problem Solving:</label>
              <input type="number" id="programming-1" name="semester1[programming_for_problem_solving]" max="100" required>
            </div>
            <div class="form-group">
              <label for="env-1">Environment and Ecology:</label>
              <input type="number" id="env-1" name="semester1[environment_and_ecology]" max="100" required>
            </div>
            <div class="form-group">
              <label for="env-1">Workshop:</label>
              <input type="number" id="env-1" name="semester1[environment_and_ecology]" max="100" required>
            </div>
            <div class="form-group">
              <label for="total-1">Total Marks:</label>
              <input type="number" id="total-1" name="semester1[total_marks]" max="1000" required>
            </div>
          </div>
        </div>

        <!-- Add & Submit Buttons -->
        <div class="button-container">
          <button type="submit" class="save-btn">SUBMIT</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
<?php
} else {
    echo "NOT THE VALID STUDENT";
}
?>