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
    $Name_of_the_company=$_POST["CoName"];
    $Companys_Phone_Number=$_POST["CoPhoneNo"];
    $Email=$_POST["Email"];
}
$sql=("INSERT INTO pharcompany(CoName,CoPhoneNo,Email)VALUES(?,?,?)");
$stmt=$conn->prepare($sql);

$stmt=$conn->prepare($sql);
$stmt->bind_param("sis",$Name_of_the_company,$Companys_Phone_Number,$Email);



$stmt->execute();
if($conn->affected_rows>0){
    echo "Data saved successfully.";
}else{
    echo "Error:Data was not saved successfully";
}
$stmt->close();




































?>