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
    $Insurance_number=$_POST["insuranceNo"];
    $Insurance_Company=$_POST["InsuranceCo"];
    $Patients_first_name=$_POST["Pfname"];
    $Patients_last_name=$_POST["Plname"];
    $Patients_SSN=$_POST["SSN"];
    $Percentage_Deducted=$_POST["PercentDeducted"];
}
$sql=("INSERT INTO insurance(insuranceNo,InsuranceCo,Pfname,Plname,SSN,PercentDeducted)VALUES(?,?,?,?,?,?)");
$stmt=$conn->prepare($sql);

$stmt=$conn->prepare($sql);
$stmt->bind_param("isssii",$Insurance_number,$Insurance_Company,$Patients_first_name,$Patients_last_name,$Patients_SSN,$Percentage_Deducted);

$stmt->execute();
if($conn->affected_rows>0){
    echo "Data saved successfully";
}else{
    echo "Error: Data was not saved";

}
$stmt->close();
