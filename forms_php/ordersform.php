<?php
$servername="localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";
$conn=new mysqli($servername,$username,$password,$database);
if($conn->connect_error){
    die("Connection failed".$conn->connect_error);

}else{
    echo "Connected successfully\n";
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $Order_Id=$_POST["OrderId"];
    $Date_Ordered=$_POST["OrdDate"];
    $Pharmacys_Name=$_POST["PharName"];
    $Pharmacys_Phone_Number=$_POST["PharPhoneNo"];
    $TradeName=$_POST["TradeName"];
    $Formula=$_POST["Formula"];
    $Quantity=$_POST["Quantity"];
    $Companys_Name=$_POST["CoName"];
    $Companys_Phone_Number=$_POST["CoPhoneNo"];
    
}
$sql=("INSERT INTO orders(OrderId,OrdDate,PharName,PharPhoneNo,TradeName,Formula,Quantity,Coname,CoPhoneNo) VALUES(?,?,?,?,?,?,?,?,?)");
$stmt=$conn->prepare($sql);

$stmt=$conn->prepare($sql);
$stmt->bind_param("sssissisi",$Order_Id,$Date_Ordered,$Pharmacys_Name,$Pharmacys_Phone_Number,$TradeName,$Formula,$Quantity,$Companys_Name,$Companys_Phone_Number);
$stmt->execute();
if($conn->affected_rows>0){
    echo "Data saved successfully.";
}else{
    echo "Error:Data was not saved";
}
$stmt->close();























?>