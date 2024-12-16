<?php
session_start();
if (isset($_SESSION["professorid"])) {
?>
<!-- Save as marks_entry.html -->
<!DOCTYPE html>
<html lang="en">
<head>
<script>
    function confirmLogout() {
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = "../UserInterface/logout.php";
        }
    }
    </script>
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
        <li><a href="student_list.php">Student List</a></li>
        <li><a href="student_update.php">Marks Updation</a></li>
        <li><a href="schedule.php">Schedule</a></li>
        <li><a href="#" class="logout" onclick="confirmLogout()">Log out</a></li>
      </ul>
    </aside>

    <div class="main-content">
      <form action="semester2.php" method="POST" id="marksForm" class="profile-form">
        <h1>Marks Entry</h1>
        
        <div id="semester-container">
          <!-- Semester 1 -->
          <div class="semester-section" id="semester-2">
            <h2>Semester 2</h2>
            <!-- Subjects for Semester 1 -->
            <div class="form-group">
              <label for="Engineering Chemistry-1">Engineering Chemistry:</label>
              <input type="number" id="physics-1" name="semester2[engineering_chemistry]" max="100" required>
            </div>
            <div class="form-group">
              <label for="math-2">Engineering Mathematics - II:</label>
              <input type="number" id="math-2" name="semester2[engineering_mathematics]" max="100" required>
            </div>
            <div class="form-group">
              <label for="electronics-2">Fundamentals of Electronics Engineering:</label>
              <input type="number" id="electronics-2" name="semester2[fundamentals_of_electronics_engineering]" max="100" required>
            </div>
            <div class="form-group">
              <label for="Mechanical-2">Fundamentals of Mechanical Engineering:</label>
              <input type="number" id="Mechanical-2" name="semester2[Mechanical]" max="100" required>
            </div>
            <div class="form-group">
              <label for="SS-1">Soft Skills:</label>
              <input type="number" id="SS-1" name="semester2[Soft_skills]" max="100" required>
            </div>
            <div class="form-group">
              <label for="S_Y-2">Sports and Yoga:</label>
              <input type="number" id="env-1" name="semester2[Sports_and_Yoga]" max="100" required>
            </div>
            <div class="form-group">
              <label for="total-2">Total Marks:</label>
              <input type="number" id="total-2" name="semester2[total_marks]" max="1000" required>
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