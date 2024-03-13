<?php
$servername="localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";
$conn=new mysqli($servername,$username,$password,$database);
if($conn->connect_error){
    die("Connection failed" .$conn->connect_error);

}else{
    echo"Connection successful";
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $Doctors_Name=$_POST["DName"];
    $Doctors_SSN=$_POST["DSSN"];
    $Specialty=$_POST["Specialty"];
    $Years_of_Experience=$_POST["YearsofExperience"];
    $Email=$_POST["Email"];

}
$sql=("INSERT INTO doctor(DSSN,DName,Specialty,YearsofExperience,Email)VALUES(?,?,?,?,?)");
$stmt=$conn->prepare($sql);

$stmt=$conn->prepare($sql);
$stmt->bind_param("issis",$Doctors_SSN,$Doctors_Name,$Specialty,$Years_of_Experience,$Email);

$stmt->execute();
if($conn->affected_rows>0){
    echo "Data saved successfully";
}else{
    echo "Error: Data was not saved";

}
$stmt->close();



























?>