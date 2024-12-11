CREATE TABLE student_detail_info (
    Rollno INT PRIMARY KEY,
    Full_Name VARCHAR(255) NOT NULL,
    Mother's_Name VARCHAR(255) NOT NULL,
    Father's_Name VARCHAR(255) NOT NULL,
    Mobile_Number VARCHAR(15) NOT NULL,
    Home_Address TEXT NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE semester_1 (
    Rollno INT,
    Engineering_Physics INT NOT NULL,
    Engineering_Mathematics_I INT NOT NULL,
    Fundamentals_of_Electrical_Engineering INT NOT NULL,
    Programming_for_Problem_Solving INT NOT NULL,
    Environment_and_Ecology INT NOT NULL,
    Workshop INT NOT NULL,
    Total_Marks INT NOT NULL,
    FOREIGN KEY (Rollno) REFERENCES student_detail_info(Rollno) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE semester_2 (
    Rollno INT,
    Engineering_Chemistry INT NOT NULL,
    Engineering_Mathematics_II INT NOT NULL,
    Fundamentals_of_Electronics_Engineering INT NOT NULL,
    Fundamentals_of_Mechanical_Engineering INT NOT NULL,
    Soft_Skills INT NOT NULL,
    Sports_and_Yoga INT NOT NULL,
    Total_Marks INT NOT NULL,
    FOREIGN KEY (Rollno) REFERENCES student_detail_info(Rollno) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE semester_3 (
    Rollno INT,
    Mathematics_IV INT NOT NULL,
    Technical_Communication INT NOT NULL,
    Data_Structure INT NOT NULL,
    Computer_Organization_and_Architecture INT NOT NULL,
    Discrete_Structures_and_Theory_of_Logic INT NOT NULL,
    Cyber_Security INT NOT NULL,
    Total_Marks INT NOT NULL,
    FOREIGN KEY (Rollno) REFERENCES student_detail_info(Rollno) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE semester_4 (
    Rollno INT,
    Digital_Electronics INT NOT NULL,
    Universal_Human_Values_and_Professional_Ethics INT NOT NULL,
    Operating_System INT NOT NULL,
    Theory_of_Automata_and_Formal_Languages INT NOT NULL,
    Object_Oriented_Programming_with_Java INT NOT NULL,
    Python_Programming INT NOT NULL,
    Total_Marks INT NOT NULL,
    FOREIGN KEY (Rollno) REFERENCES student_detail_info(Rollno) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE VIEW student_master AS
SELECT 
    s.Rollno,
    s.Full_Name,
    s.Mother's_Name,
    s.Father's_Name,
    s.Mobile_Number,
    s.Home_Address,
    sm1.Engineering_Physics,
    sm1.Engineering_Mathematics_I,
    sm1.Fundamentals_of_Electrical_Engineering,
    sm1.Programming_for_Problem_Solving,
    sm1.Environment_and_Ecology,
    sm1.Workshop,
    sm1.Total_Marks AS Semester_1_Total,
    sm2.Engineering_Chemistry,
    sm2.Engineering_Mathematics_II,
    sm2.Fundamentals_of_Electronics_Engineering,
    sm2.Fundamentals_of_Mechanical_Engineering,
    sm2.Soft_Skills,
    sm2.Sports_and_Yoga,
    sm2.Total_Marks AS Semester_2_Total,
    sm3.Mathematics_IV,
    sm3.Technical_Communication,
    sm3.Data_Structure,
    sm3.Computer_Organization_and_Architecture,
    sm3.Discrete_Structures_and_Theory_of_Logic,
    sm3.Cyber_Security,
    sm3.Total_Marks AS Semester_3_Total,
    sm4.Digital_Electronics,
    sm4.Universal_Human_Values_and_Professional_Ethics,
    sm4.Operating_System,
    sm4.Theory_of_Automata_and_Formal_Languages,
    sm4.Object_Oriented_Programming_with_Java,
    sm4.Python_Programming,
    sm4.Total_Marks AS Semester_4_Total
FROM student_detail_info s
LEFT JOIN semester_1 sm1 ON s.Rollno = sm1.Rollno
LEFT JOIN semester_2 sm2 ON s.Rollno = sm2.Rollno
LEFT JOIN semester_3 sm3 ON s.Rollno = sm3.Rollno
LEFT JOIN semester_4 sm4 ON s.Rollno = sm4.Rollno;
