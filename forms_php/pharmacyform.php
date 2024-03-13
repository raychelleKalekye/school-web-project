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
$Pharmacys_Name=$_POST["PharName"];
$Pharmacys_Phone_Number=$_POST["PharPhoneNo"];
$Based_Location=$_POST["Location"];

}
$sql=("INSERT INTO pharmacy(PharPhoneNo,LoAddress,PharName)VALUES(?,?,?)");
$stmt=$conn->prepare($sql);

$stmt->bind_param("isss",$Pharmacys_Phone_Number,$Based_Location,$Pharmacys_Name,$Email);
$stmt->execute();
if($conn->affected_rows>0){
    echo "Data saved successfully.";
}else{
    echo "Error:Data was not saved";
}
$stmt->close();




























































?>