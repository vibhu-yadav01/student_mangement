<?php
$rootpath= $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/PROJECT/student_mangement/DBHandler/DBProfessorDetails.php";
$dbo = new DBProfessorDetails();
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
        session_start();
        session_destroy();
    }
    else
    {
        session_start();
        $_SESSION["professorid"] = $id;
        $status= "OK";
    }

   $rv = array("status" => $status);

   echo json_encode($rv); // Send JSON response
   exit;
}

?>