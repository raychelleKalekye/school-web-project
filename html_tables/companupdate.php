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
    $Companys_Name=$_POST['CoName'];
    $Phone_Number=$_POST['CoPhoneNo'];
    $Email=$_POST['Email'];


   
    $sql = "UPDATE pharcompany SET CoName = ?, Email = ? WHERE CoPhoneNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi",$Companys_Name,$Email,$Phone_Number);
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
