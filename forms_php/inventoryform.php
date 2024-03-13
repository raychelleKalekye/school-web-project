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
    $Inventory_ID=$_POST["InventoryID"];
    $Trade_Name=$_POST["TradeName"];
    $Formula=$_POST["Formula"];
    $Quantity=$_POST["Quantity"];
    $Pharmacys_Name=$_POST["PharName"];
    $Pharmacys_Phone_Number=$_POST["PharPhoneNo"];
}
$sql=("INSERT INTO inventory(InventoryID,TradeName,Formula,Quantity,PharName,PharPhoneNo)VALUES(?,?,?,?,?,?)");
$stmt=$conn->prepare($sql);

$stmt=$conn->prepare($sql);
$stmt->bind_param("sssisi",$Inventory_ID,$Trade_Name,$Formula,$Quantity,$Pharmacys_Name,$Pharmacys_Phone_Number);

$stmt->execute();
if($conn->affected_rows>0){
    echo "Data saved successfully";
}else{
    echo "Error: Data was not saved";

}
$stmt->close();
