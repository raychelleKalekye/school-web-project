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
    $Trade_Name=$_POST['TradeName'];
    $Formula=$_POST['Formula'];
    $Category=$_POST["Category"];
$Drug_img=$_FILES["drg_img"];
       


   
    $sql = "UPDATE drugs SET  Formula = ?,Category=?,drg_img=? WHERE TradeName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssb",$Formula,$Trade_Name,$Category,$Drug_img);
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
