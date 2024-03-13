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
    $Inventory_ID = $_POST['InventoryID'];
    $Category=$_POST['Category'];
    $Trade_Name=$_POST['TradeName'];
    $Formula=$_POST['Formula'];
    $Quantity=$_POST['Quantity'];
    $Pharmacys_Name=$_POST['PharName'];
    $Pharmacys_Phone_Number=$_POST['PharPhoneNo'];
   



  
    $sql = "UPDATE inventory SET TradeName=?,Formula=?,Quantity=?,PharName=?,PharPhoneNo=?,Category=? WHERE InventoryID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisis", $Trade_Name,$Formula,$Quantity,$Pharmacys_Name,$Pharmacys_Phone_Number,$Inventory_ID);

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
