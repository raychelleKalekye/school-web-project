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
    $Doctors_SSN=$_POST['DSSN'];
    $Doctors_Name=$_POST['DName'];
    $Specialty=$_POST['Specialty'];
    $Years_Of_Experience=$_POST['YearsOfExperience'];
    $Email=$_POST['Email'];



  
    $sql = "UPDATE doctor SET DName=?,Specialty=?,YearsOfExperience=?,Email=? WHERE DSSN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi",$Doctors_Name,$Specialty,$Years_Of_Experience,$Email,$Doctors_SSN);

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
