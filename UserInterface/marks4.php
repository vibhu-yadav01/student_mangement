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
      <form action="semester4.php" method="POST" id="marksForm" class="profile-form">
        <h1>Marks Entry</h1>
        
        <div id="semester-container">
          <div class="semester-section" id="semester-1">
            <h2>Semester 4</h2>
            <!-- Subjects for Semester 1 -->
            <div class="form-group">
              <label for="DE-4">Digital Electronics:</label>
              <input type="number" id="DE-4" name="semester4[Digital_Electronics]" max="100" required>
            </div>
            <div class="form-group">
              <label for="UHV-4"> Universal Human Values and Professional Ethics:</label>
              <input type="number" id="UHV-4" name="semester4[Universal_Human_Values_and_Professional_Ethics]" max="100" required>
            </div>
            <div class="form-group">
              <label for="OS-4">Operating System:</label>
              <input type="number" id="OS-4" name="semester4[Operating_System]" max="100" required>
            </div>
            <div class="form-group">
              <label for="TOC-4">Theory of Automata and Formal Languages:</label>
              <input type="number" id="TOC-4" name="semester4[Theory_of Automata_and_Formal_Languages]" max="100" required>
            </div>
            <div class="form-group">
              <label for="OOPS-4">Object Oriented Programming with Java:</label>
              <input type="number" id="OOPS-4" name="semester4[Object_Oriented_Programming_with_Java]" max="100" required>
            </div>
            <div class="form-group">
              <label for="Python-4">Python Programming:</label>
              <input type="number" id="Python-4" name="semester4[Python Programming]" max="100" required>
            </div>
            <div class="form-group">
              <label for="total-4">Total Marks:</label>
              <input type="number" id="total-4" name="semester4[total_marks]" max="1000" required>
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