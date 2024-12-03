<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/PROJECT/student_mangement/DBHandler/Databaseconnection.php";

class DBProfessorDetails {
    public function getID($email, $password)
     {
        $id = "-1";
        $dbo = new Databaseconnection();
        $cmd = "select id from professor_details where email=:email and password =:password";
        $stmt = $dbo->conn->prepare($cmd);
        $stmt->execute([":email" => $email, ":password" => $password]);

        if ($stmt->rowCount() > 0)
         {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $result["id"];
        }
        return $id;
    }
}
?>
