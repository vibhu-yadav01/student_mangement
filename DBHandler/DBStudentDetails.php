<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/PROJECT/student_mangement/DBHandler/Databaseconnection.php";

class DBStudentDetails
{
    
    public function getID($rollno, $password)
    {
        $id = "-1";
        $dbo = new Databaseconnection();
        // Change table from 'student_details' to 'student_master'
        $cmd = "SELECT Rollno FROM student_master WHERE Rollno = :rollno AND password = :password"; 
        $templet = $dbo->conn->prepare($cmd);
        
        $templet->execute([":rollno" => $rollno, ":password" => $password]);

        if ($templet->rowCount() > 0) {
            $rtable = $templet->fetchAll(PDO::FETCH_ASSOC);
            $id = $rtable[0]["Rollno"];
        }
        return $id;
    
}

    public function getStudentList()
    {
        $dbo = new Databaseconnection();
        $cmd = "
            SELECT 
                Rollno,
                Full_Name,
                DOB,
                Password,
                Mobile_Number,
                Semester_1_Total,
                Semester_2_Total,
                Semester_3_Total,
                Semester_4_Total,
                (IFNULL(Semester_1_Total, 0) + 
                 IFNULL(Semester_2_Total, 0) + 
                 IFNULL(Semester_3_Total, 0) + 
                 IFNULL(Semester_4_Total, 0)) AS Total
            FROM student_master
            ORDER BY Full_Name ASC
        ";
        $templet = $dbo->conn->prepare($cmd);
        $templet->execute();

        if ($templet->rowCount() > 0) {
            return $templet->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
    public function getStudentListSortedByRollno()
{
    $dbo = new Databaseconnection();
    $cmd = "
        SELECT 
            Rollno,
            Full_Name,
            Password,
            DOB,
            Semester_1_Total,
            Semester_2_Total,
            Semester_3_Total,
            Semester_4_Total,
            (IFNULL(Semester_1_Total, 0) + 
             IFNULL(Semester_2_Total, 0) + 
             IFNULL(Semester_3_Total, 0) + 
             IFNULL(Semester_4_Total, 0)) AS Total
        FROM student_master
        ORDER BY Rollno ASC
    ";
    $templet = $dbo->conn->prepare($cmd);
    $templet->execute();
    return $templet->fetchAll(PDO::FETCH_ASSOC);
}

public function getStudentListSortedByRank()
{
    $dbo = new Databaseconnection();
    $cmd = "
        SELECT 
            Rollno,
            Full_Name,
            Password,
            DOB,
            Semester_1_Total,
            Semester_2_Total,
            Semester_3_Total,
            Semester_4_Total,
            (IFNULL(Semester_1_Total, 0) + 
             IFNULL(Semester_2_Total, 0) + 
             IFNULL(Semester_3_Total, 0) + 
             IFNULL(Semester_4_Total, 0)) AS Total
        FROM student_master
         ORDER BY Total DESC
    ";
    $templet = $dbo->conn->prepare($cmd);
    $templet->execute();
    return $templet->fetchAll(PDO::FETCH_ASSOC);
}

public function getStudentListSortedByName()
{
    $dbo = new Databaseconnection();
    $cmd = "
         SELECT 
            Rollno,
            Full_Name,
            Password,
            DOB,
            Semester_1_Total,
            Semester_2_Total,
            Semester_3_Total,
            Semester_4_Total,
            (IFNULL(Semester_1_Total, 0) + 
             IFNULL(Semester_2_Total, 0) + 
             IFNULL(Semester_3_Total, 0) + 
             IFNULL(Semester_4_Total, 0)) AS Total
        FROM student_master
        ORDER BY Full_Name ASC
   ";
    $templet = $dbo->conn->prepare($cmd);
    $templet->execute();
    return $templet->fetchAll(PDO::FETCH_ASSOC);
}
public function getStudentListByName($searchTerm)
{
    $dbo = new Databaseconnection();
    $cmd = "
        SELECT 
            Rollno,
            Full_Name,
            Password,
            DOB,
            Semester_1_Total,
            Semester_2_Total,
            Semester_3_Total,
            Semester_4_Total,
            (IFNULL(Semester_1_Total, 0) + 
             IFNULL(Semester_2_Total, 0) + 
             IFNULL(Semester_3_Total, 0) + 
             IFNULL(Semester_4_Total, 0)) AS Total
        FROM student_master
        WHERE Full_Name LIKE :searchTerm
        ORDER BY Full_Name ASC
    ";
    $templet = $dbo->conn->prepare($cmd);
    $templet->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $templet->execute();
    return $templet->fetchAll(PDO::FETCH_ASSOC);
}


public function updateMarks($rollno, $password, $semester, $subject, $newMarks)
{
    // First, validate the student with roll number and password
    $studentID = $this->getID($rollno, $password);

    if ($studentID === null) {
        // Invalid roll number or password
        return "Invalid roll number or password.";
    }

    // Determine the column based on the semester and subject
    $column = $this->getMarksColumn($semester, $subject);
    
    if (!$column) {
        // Invalid semester or subject
        return "Invalid semester or subject.";
    }

    // Update the marks in the database
    try {
        $dbo = new Databaseconnection();
        
        // Prepare the SQL statement for updating the marks
        $cmd = "UPDATE student_master SET $column = :newMarks WHERE Rollno = :rollno";
        $templet = $dbo->conn->prepare($cmd);
        
        // Execute the update query
        $templet->execute([":newMarks" => $newMarks, ":rollno" => $rollno]);
        
        // Check if the update was successful
        if ($templet->rowCount() > 0) {
            return "Marks updated successfully.";
        } else {
            return "No changes made. Please check the details.";
        }
    } catch (PDOException $e) {
        // Log any errors that occur during the query execution
        error_log("Error updating marks: " . $e->getMessage());
        return "An error occurred while updating marks.";
    }
}

// Helper function to map semester and subject to their respective column names
private function getMarksColumn($semester, $subject)
{
    // Map semester and subject to the correct column in the database
    $subjectColumnMapping = [
        1 => [
            "Engineering_Physics" => "Semester_1_Engineering_Physics",
            "Engineering_Mathematics_I" => "Semester_1_Engineering_Mathematics_I",
            "Fundamentals_of_Electrical_Engineering" => "Semester_1_Fundamentals_of_Electrical_Engineering",
            "Programming_for_Problem_Solving" => "Semester_1_Programming_for_Problem_Solving",
            "Environment_and_Ecology" => "Semester_1_Environment_and_Ecology",
            "Workshop" => "Semester_1_Workshop"
        ],
        2 => [
            "Engineering_Chemistry" => "Semester_2_Engineering_Chemistry",
            "Engineering_Mathematics_II" => "Semester_2_Engineering_Mathematics_II",
            "Fundamentals_of_Electronics_Engineering" => "Semester_2_Fundamentals_of_Electronics_Engineering",
            "Fundamentals_of_Mechanical_Engineering" => "Semester_2_Fundamentals_of_Mechanical_Engineering",
            "Soft_Skills" => "Semester_2_Soft_Skills",
            "Sports_and_Yoga" => "Semester_2_Sports_and_Yoga"
        ],
        3 => [
            "Mathematics_IV" => "Semester_3_Mathematics_IV",
            "Technical_Communication" => "Semester_3_Technical_Communication",
            "Data_Structure" => "Semester_3_Data_Structure",
            "Computer_Organization_and_Architecture" => "Semester_3_Computer_Organization_and_Architecture",
            "Discrete_Structures_and_Theory_of_Logic" => "Semester_3_Discrete_Structures_and_Theory_of_Logic",
            "Cyber_Security" => "Semester_3_Cyber_Security"
        ],
        4 => [
            "Digital_Electronics" => "Semester_4_Digital_Electronics",
            "Universal_Human_Values_and_Professional_Ethics" => "Semester_4_Universal_Human_Values_and_Professional_Ethics",
            "Operating_System" => "Semester_4_Operating_System",
            "Theory_of_Automata_and_Formal_Languages" => "Semester_4_Theory_of_Automata_and_Formal_Languages",
            "Object_Oriented_Programming_with_Java" => "Semester_4_Object_Oriented_Programming_with_Java",
            "Python_Programming" => "Semester_4_Python_Programming"
        ]
    ];

    // Check if the semester and subject are valid
    if (isset($subjectColumnMapping[$semester][$subject])) {
        return $subjectColumnMapping[$semester][$subject];
    } else {
        return null; // Invalid semester or subject
    }
}

public function getMarksByStudentId($studentId)
{
    $dbo = new Databaseconnection();
    $cmd = "
        SELECT 
            Rollno,
            Full_Name,
            Mobile_Number,
            Semester_1_Total,
            Semester_2_Total,
            Semester_3_Total,
            Semester_4_Total,
            (IFNULL(Semester_1_Total, 0) + 
             IFNULL(Semester_2_Total, 0) + 
             IFNULL(Semester_3_Total, 0) + 
             IFNULL(Semester_4_Total, 0)) AS Total
        FROM student_master
        WHERE Rollno = :studentId
    ";
    $templet = $dbo->conn->prepare($cmd);
    $templet->execute([":studentId" => $studentId]);

    if ($templet->rowCount() > 0) {
        return $templet->fetch(PDO::FETCH_ASSOC);
    } else {
        return null; // No student found with this ID
    }
}
public function deleteStudentByRollno($rollno) {
    $dbo = new Databaseconnection(); // Assuming this is your PDO connection class
    $query = "DELETE FROM student_detail_info WHERE Rollno = :rollno"; // Named placeholder

    $stmt = $dbo->conn->prepare($query); // Prepare the query
    $stmt->bindValue(':rollno', $rollno, PDO::PARAM_STR); // Bind the parameter
    
    return $stmt->execute(); // Execute the query
}


}

?>
