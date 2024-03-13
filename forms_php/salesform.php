<?php
$servername="localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";

$conn=new mysqli($servername,$username,$password,$database);
if($conn->connect_error){
    die("Connection failed".$conn->connect_error);

}else{
    echo "Connection was successful";
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $SALES_ID=$_POST["SalesID"];
    $TRADE_NAME=$_POST["TradeName"];
    $PRICE=$_POST["Price"];
    $Dosage=$_POST["Dosage"];
    $Pharmacys_Phone_Number=$_POST["PharPhoneNo"];
    $Pharmacists_SSN=$_POST["PharSSN"];
    $Pharmacists_first_name=$_POST["Pharfname"];
    $Pharmacists_last_name=$_POST["Pharlname"];
    $Patients_SSN=$_POST["SSN"];
    $Patients_first_name=$_POST["Pfname"];
    $Patients_last_name=$_POST["Plname"];
    $DatePurchased=$_POST["DatePurchased"];
 

}
$sql=("INSERT INTO sales(SalesID,TradeName,Price,Dosage,PharPhoneNo,PharSSN,Pharfname,Pharlname,SSN,Pfname,Plname,DatePurchased)VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt=$conn->prepare($sql);

$stmt=$conn->prepare($sql);
$stmt->bind_param("isiiisssisss",$SALES_ID,$TRADE_NAME,$PRICE,$Dosage,$Pharmacys_Phone_Number,$Pharmacists_SSN,$Pharmacists_first_name,$Pharmacists_last_name,$Patients_SSN,$Patients_first_name,$Patients_last_name,$DatePurchased);

$stmt->execute();
if($conn->affected_rows>0){
    echo "Data saved successfully";
}else{
    echo"Error:Data was not saved";
}
$stmt->close();