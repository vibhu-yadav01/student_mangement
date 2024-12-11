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

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $result["id"];
        }
        return $id;
    }

    public function getProfessorDetails($id)
    {
        $details = null;
        $dbo = new Databaseconnection();
        $cmd = "SELECT name, description, phone_number, photo FROM professor_details WHERE id = :id"; // Added 'name' in the SELECT statement
        $stmt = $dbo->conn->prepare($cmd);
        $stmt->execute([":id" => $id]);
    
        if ($stmt->rowCount() > 0) {
            $details = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $details;
    }
    
}
?>
