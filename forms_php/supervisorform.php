<?php
$servername="Localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";

$conn=new mysqli($servername,$username,$password,$database);
if($conn->connect_error){
    die("Connection error failed:" .$conn->connect_error);
}else{
    echo "Connection successfuly";
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $Supervisor_ID=$_POST["SupervisorID"];
    $Supervisors_Name=$_POST["SupName"];
    $Contract_ID=$_POST["ContractID"];
}
$sql=("INSERT INTO supervisor(SupervisorID,SupName,ContractID)VALUES(?,?,?)");
$stmt=$conn->prepare($sql);

$stmt=$conn->prepare($sql);
$stmt->bind_param("isi",$Supervisor_ID,$Supervisors_Name,$Contract_ID);



$stmt->execute();
if($conn->affected_rows>0){
    echo "Data saved successfully.";
}else{
    echo "Error:Data was not saved successfully";
}
$stmt->close();









