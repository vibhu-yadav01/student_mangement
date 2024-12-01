<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"]; // This points to 

require_once $rootpath . "/PROJECT/student_mangement/DBHandler/DBStudentDetails.php"; // Adjust the path
$dbo = new DBStudentDetails();
$action = $_POST["action"];

if ($action == "loginHandler")
{

 // Response for login handler
    $un=$_POST["username"];
    $pwd=$_POST["pwd"];
    $status="";
    $id=$dbo->getID($un,$pwd);

    if($id==-1)
    {
        $status="ERROR";
    }
    else
    {
        $status= "OK";
    }

   $rv = array("status" => $status);

   echo json_encode($rv); // Send JSON response
   exit;
}
if ($action == "otherHandler"){

}

?>