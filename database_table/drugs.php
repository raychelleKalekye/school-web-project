<?php
$servername="localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";
$conn=new mysqli($servername,$username,$password,$database);
$sql="CREATE TABLE drugs(TradeName varchar(255) PRIMARY KEY,Formula varchar(10000))";
if($conn->connect_error){
echo"Connection failed".$conn->connect_error;
}else{
    echo "Connection successfully\n";
    if($conn->query($sql)===TRUE){
        echo"Table created succesfully";
    }else{
        echo "Table creation failed :".$conn->connect_error;
    }
}
$conn->close();
?>