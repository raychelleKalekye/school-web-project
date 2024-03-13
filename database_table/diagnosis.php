<?php
$servername="localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";
$conn=new mysqli($servername,$username,$password,$database);
$sql=("CREATE TABLE diagnosis(DiagnosisId varchar(255) PRIMARY KEY,Symptoms varchar(1500),Diagnosis varchar(18000),SSN int,Pfname varchar(255),DSSN int,DName varchar(255))");
if($conn->connect_error){
    echo "connection failed:" . $conn->connect_error;
}else{
    echo "Connection created successfuly\n";
   
    if($conn->query($sql)===TRUE){
        echo "Table created successfully";

    }else{
        echo "error creating the table" .$conn->connect_error;
    }
}
$conn->close();


?>