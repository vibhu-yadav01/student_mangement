<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"]; // This points to 

require_once $rootpath . "/PROJECT/student_mangement/DBHandler/DBStudentDetails.php"; // Adjust the path
$dbo = new DBStudentDetails();
$rv = $dbo->getID("110", "abc123");
echo ($rv)
?>
