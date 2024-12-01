<?php
$servername = "localhost:3307"; // Specify the port
$username = "vaibhav";
$password = "#qwerty#001#"; // Replace with your MySQL root password if any
$databaseName = "ourdatabase";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

//execute sql commands on this connection
try {
$cmd = "insert into student_details (rollno,name,password) values('1105','Ritesh','abc123')";
$conn->exec($cmd);
}
catch (PDOException $ee) {
    echo $ee->getMessage();
}

try {
    $cmd = "insert into student_details (rollno,name,password) values(:rollno,:tname,:password)";
    $templet= $conn->prepare($cmd);

    $templet->bindValue(":rollno","1106");
    $templet->bindValue(":tname","Alok Kumar");
    $templet->bindValue(":password","abc123");
    $templet->execute();
}
catch (PDOException $ee) {
}


try {
    $cmd = "insert into student_details (rollno,name,password) values(:rollno,:tname,:password)";
    $templet= $conn->prepare($cmd);
    
    $templet->bindParam(":rollno",$vrollno);
    $templet->bindParam(":tname",$vname);
    $templet->bindParam(":password",$abc);

    $vrollno="1108";
    $vname="Ajay dubey";
    $abc= "admin123";
    $templet->execute();

}
catch (PDOException $ee) {
}


try {
    $cmd = "insert into student_details (rollno,name,password) values(:rollno,:tname,:password)";
    $templet= $conn->prepare($cmd);
    
    
    $templet->execute(array(":rollno"=>"11009",":tname"=>"Swati Mishra",":password"=>"abcd123"));
    $templet->execute([":rollno"=>"11011",":tname"=>"Sakshi Mishra",":password"=>"abcd123"]);

}
catch (PDOException $ee) {
}


try {
    $cmd = "select * from student_details";
    $templet= $conn->prepare($cmd);

    $templet->execute();

    echo("<br>".$templet->rowCount()."<br>");
    $rv=$templet->fetchAll(PDO::FETCH_ASSOC);
    print_r($rv);
}
catch (PDOException $ee) {
}
?>
