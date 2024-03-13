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
    $Patients_SSN=$_POST['SSN'];
    $Patients_First_Name=$_POST['Pfname'];
    $Patients_Last_Name=$_POST['Plname'];
    $YearofBirth = $_POST['YearofBirth'];
    $Gender = $_POST['Gender'];
    $Email=$_POST['email'];
        $Location_Address=$_POST['Address'];
        $Password = $_POST['password'];



  
    $sql = "UPDATE patient SET Pfname=?,Plname=?,YearofBirth=?,Address=?,email=?,password=?,Gender=? WHERE SSN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi",$Patients_First_Name,$Patients_Last_Name,$YearofBirth,$Location_Address,$Gender,$Email,$password,$Patients_SSN);

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
