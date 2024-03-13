<?php
$servername="localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";

$conn=new mysqli($servername,$username,$password,$database);
if($conn->connect_error){
    die("Connection failed" . $conn->connect_error);
}else{
    echo "Connection is succesful\n";
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $Diagnosis_ID=$_POST["DiagnosisId"];
    $Symptoms=$_POST["Symptoms"];
    $Diagnosis=$_POST["Diagnosis"];
    $Patients_SSN=$_POST["SSN"];
    $Patients_first_name=$_POST["Pfname"];
    $Patients_last_name=$_POST["Plname"];
    $Doctors_SSN=$_POST["DSSN"];
    $Doctors_Name=$_POST["DName"];

 
}

$sql=("INSERT INTO diagnosis(DiagnosisId,Symptoms,Diagnosis,SSN,Pfname,DSSN,DName)VALUES(?,?,?,?,?,?,?)");
$stmt=$conn->prepare($sql);


$stmt=$conn->prepare($sql);
$stmt->bind_param("issisis",$Diagnosis_ID,$Symptoms,$Diagnosis,$Patients_SSN,$Patients_first_name,$Doctors_SSN,$Doctors_Name);

$stmt->execute();

    
       
if($conn->affected_rows>0){
    echo "Diagnosis added";
}else{
    echo "Data has not been saved".$conn->connect_error;
   
}


    $stmt->close();
