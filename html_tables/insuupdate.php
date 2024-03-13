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
   
    $Insurance_Number = $_POST['insuranceNo'];
    $Insurance_Company=$_POST['InsuranceCo'];
    $Patients_First_Name=$_POST['Pfname'];
    $Patients_Last_Name=$_POST['Plname'];
    $Percent_Deducted=$_POST['PercentDeducted'];
    $Patients_SSN=$_POST['SSN'];



  
    $sql = "UPDATE insurance SET InsuranceCo=?,Pfname=?,Plname=?,PercentDeducted=?,SSN=? WHERE insuranceNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $Insurance_Company,$Patients_First_Name,$Patients_Last_Name,$Percent_Deducted,$Patients_SSN,$Insurance_Number);

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
