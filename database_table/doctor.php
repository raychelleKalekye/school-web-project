<?php
$servername="localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";
$conn=new mysqli($servername,$username,$password,$database);
$sql="CREATE TABLE doctor(DSSN int PRIMARY KEY,DName varchar(255),Specialty varchar(255),YearsOfExperience int)";
if ($conn->connect_error){
    echo"Connection failed".$conn->$connect_error;
    
}else{
    echo "Connection successful";
    
    if ($conn->query($sql)===TRUE){
        echo"Table cretated succesfully";
    }else{
    echo "Error creating table" .$conn->connect_error;
    }

$conn->close();
}
?>