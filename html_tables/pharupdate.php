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
    $Pharmacys_Name=$_POST['PharName'];
    $Pharmacys_Phone_Number=$_POST['PharPhoneNo'];
    $Location_Address=$_POST['LoAddress'];
    $Email=$_POST['Email'];


   
    $sql = "UPDATE pharmacy SET PharName = ?,LoAddress=?, Email = ? WHERE PharPhoneNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi",$Pharmacys_Name,$Location_Address,$Email,$Pharmacys_Phone_Number);
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