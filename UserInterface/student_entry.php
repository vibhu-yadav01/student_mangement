<?php
session_start();
if (isset($_GET['status']) && $_GET['status'] === 'completed') {
  echo "<script>alert('COMPLETED');</script>";
}
if (isset($_SESSION["professorid"])) {
  ?>
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Entry</title>
  <link rel="stylesheet" href="../CSS/bootstrap/ppage.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2>Student entry</h2>
      <ul>
        <li><a href="professor.php">User Info</a></li>
        <li><a href="#" class="active">Student Entry</a></li>
        <li><a href="student_list.php">Student list</a></li>
        <li><a href="student_update.php">Marks Updation</a></li>
        <li><a href="schedule.php">Schedule</a></li>
        <li><a href="#" class="logout" onclick="confirmLogout()">Log out</a></li>
      </ul>
    </aside>

    <div class="main-content">
      <form action="entry.php" method="POST" class="profile-form">
        <h1>Student Entry</h1>
        <div class="form-group">
          <label for="student-rollno">Roll Name:</label>
          <input type="number" id="student-rollno" name="student_rollno" required>
        </div>
        <div class="form-group">
          <label for="student-name">Full Name:</label>
          <input type="text" id="student-name" name="student_name" required>
        </div>
        <div class="form-group">
          <label for="mother-name">Mother's Name:</label>
          <input type="text" id="mother-name" name="mother_name" required>
        </div>
        <div class="form-group">
          <label for="father-name">Father's Name:</label>
          <input type="text" id="father-name" name="father_name" required>
        </div>
        <div class="form-group">
          <label for="mobile">Mobile Number:</label>
          <input type="tel" id="mobile" name="mobile" required>
        </div>
        <div class="form-group">
          <label for="address">Home Address:</label>
          <textarea id="address" name="address" rows="3" required></textarea>
        </div>
        <div class="form-group">
        <label for="address">Password:</label>
          <input type="password" id="passwordInput" name="password" required>
          <span class="password-toggle" onclick="togglePasswordVisibility()">👁</span>
        </div>
        <div class="form-group">
          <label for="date">Date Of Birth:</label>
          <input type="date" id="date" name="date" required>
        </div>
        <button type="submit" name="submit" class="save-btn">Next</button>
      </form>
    </div>
  </div>
  <script>
    function togglePasswordVisibility() {
  const passwordInput = document.getElementById("passwordInput");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
}

  </script>
</body>
</html>
<?php
} else {
    echo "NOT THE VALID STUDENT";
}