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
$Contract_ID=$_POST["ContractID"];
$Supervisor_ID=$_POST["SupervisorID"];
$Supervisors_Name=$_POST["SupName"];
$Companys_Name=$_POST["CoName"];
$Companys_Phone_Number=$_POST["CoPhoneNo"];
$Pharmacys_Name=$_POST["PharName"];
$Pharmacys_Phone_Number=$_POST["PharPhoneNo"];
$Starting_Date=$_POST["StartDate"];
$Ending_Date=$_POST["EndDate"];
$Text_oftheContract=$_POST["ContractText"];
}
$sql=("INSERT INTO pharmcontract(ContractID,SupervisorID,SupName,CoName,CoPhoneNo,PharName,PharPhoneNo,StartDate,EndDate,ContractText)VALUES(?,?,?,?,?,?,?,?,?,?)");
$stmt=$conn->prepare($sql);

$stmt=$conn->prepare($sql);
$stmt->bind_param("sissisisss",$Contract_ID,$Supervisor_ID,$Supervisors_Name,$Companys_Name,$Companys_Phone_Number,$Pharmacys_Name,$Pharmacys_Phone_Number,$Starting_Date,$Ending_Date,$Text_oftheContract);
$stmt->execute();
if($conn->affected_rows>0){
    echo "Data saved successfully.";
}else{
    echo "Error:Data was not saved";
}
$stmt->close();