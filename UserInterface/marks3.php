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
      <form action="semester3.php" method="POST" id="marksForm" class="profile-form">
        <h1>Marks Entry</h1>
        
        <div id="semester-container">
          <!-- Semester 1 -->
          <div class="semester-section" id="semester-1">
            <h2>Semester 3</h2>
            <!-- Subjects for Semester 1 -->
            <div class="form-group">
              <label for="Mathematics-IV-3">Mathematics-IV:</label>
              <input type="number" id="Mathematics-IV-3" name="semester3[Mathematics-IV]" max="100" required>
            </div>
            <div class="form-group">
              <label for="TC-3">Technical Communication:</label>
              <input type="number" id="TC-3" name="semester3[Technical_Communication]" max="100" required>
            </div>
            <div class="form-group">
              <label for="Data_Structure-3">Data Structure:</label>
              <input type="number" id="Data_Structure-3" name="semester3[Data_Structure]" max="100" required>
            </div>
            <div class="form-group">
              <label for="COA-3">Computer Organization and Architecture:</label>
              <input type="number" id="COA-3" name="semester3[Computer_Organization_and_Architecture]" max="100" required>
            </div>
            <div class="form-group">
              <label for="DSTL-3">Discrete Structures & Theory of Logic:</label>
              <input type="number" id="DSTL-3" name="semester3[Discrete_Structures_Theory_of_Logic]" max="100" required>
            </div>
            <div class="form-group">
              <label for="CS-3">Cyber Security:</label>
              <input type="number" id="CS-3" name="semester3[Cyber_Security]" max="100" required>
            </div>
            <div class="form-group">
              <label for="total-3">Total Marks:</label>
              <input type="number" id="total-3" name="semester3[total_marks]" max="1000" required>
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