<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"]; 
require_once $rootpath . "/PROJECT/student_mangement/DBHandler/Databaseconnection.php";


class DBStudentDetails
{
    public function getID($rollno,$password)
    {
        $id="-1";
        $dbo = new Databaseconnection();
        $cmd="select id from student_details where rollno=:rollno and password =:password";
        $templet=$dbo->conn->prepare($cmd);
        
        $templet->execute([":rollno"=> $rollno,":password"=> $password]);

        if($templet->rowCount()> 0)
        {
            $rtable= $templet->fetchAll(PDO::FETCH_ASSOC);
            $id=$rtable[0]["id"];
        }
        return $id;
    }
}
?>