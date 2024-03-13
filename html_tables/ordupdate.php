<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Order_Id = $_POST['OrderId'];
    $Order_Date=$_POST['OrdDate'];
    $Pharmacys_Name=$_POST['PharName'];
    $Pharmacys_Phone_Number=$_POST['PharPhoneNo'];
    $Trade_Name=$_POST['TradeName'];
    $Formula=$_POST['Formula'];
    $Quantity=$_POST['Quantity'];
    $Companys_Name=$_POST['CoName'];
    $Companys_Phone_Number=$_POST['CoPhoneNo'];
   

  
    $sql = "UPDATE orders SET OrdDate=?,PharName=?,PharPhoneNo=?,TradeName=?,Formula=?,Quantity=?,CoName=?,CoPhoneNo=? WHERE OrderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissisis", $Order_Date,$Pharmacys_Name,$Pharmacys_Phone_Number,$Trade_Name,$Formula,$Quantity,$Companys_Name,$Companys_Phone_Number,$Order_Id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
