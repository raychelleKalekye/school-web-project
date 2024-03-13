<?php
$servername="localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";

$conn=new mysqli($servername, $username,$password,$database);
if($conn->connect_error){
    die("Connection failed:".$conn->connect_error);
}else{
    echo "Connection successful";
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
$Prescription_Id=$_POST["PresID"];
$Date_Prescribed=$_POST["PresDate"];
$TradeName=$_POST["TradeName"];
$Dosage=$_POST["Dosage"];
$Doctors_SSN=$_POST["DSSN"];
$Doctors_Name=$_POST["DName"];
$Patients_First_Name=$_POST["Pfname"];
$Patients_Last_Name=$_POST["Plname"];
$Patients_SSN=$_POST["SSN"];
}
$sql=("INSERT INTO prescription(PresID,PresDate,TradeName,Dosage,DSSN,DName,Pfname,Plname,SSN)VALUES(?,?,?,?,?,?,?,?,?)");
$stmt=$conn->prepare($sql);

$stmt=$conn->prepare($sql);
$stmt->bind_param("isssisssi",$Prescription_Id,$Date_Prescribed,$TradeName,$Dosage,$Doctors_SSN,$Doctors_Name,$Patients_First_Name,$Patients_Last_Name,$Patients_SSN);
$stmt->execute();
if($conn->affected_rows>0){
    echo "Data saved successfully.";
}else{
    echo "Error:Data was not saved";
}
$stmt->close();