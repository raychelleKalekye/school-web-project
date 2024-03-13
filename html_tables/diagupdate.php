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
    $Diagnosis_ID = $_POST['DiagnosisId'];
    $Symptoms = $_POST['Symptoms'];
    $Diagnosis = $_POST['Diagnosis'];
    $Patients_SSN = $_POST['SSN'];
    $Patients_first_Name = $_POST['Pfname'];
    $Patients_Last_Name = $_POST['Plname'];
    $Doctors_SSN = $_POST['DSSN'];
    $Doctors_Name = $_POST['DName'];

    // Update the pharmacist's information using prepared statement
    $sql = "UPDATE diagnosis SET Symptoms = ?, Diagnosis = ?, Pfname = ?, Plname = ?, DSSN = ?, DName = ? WHERE DiagnosisId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssii", $Symptoms, $Diagnosis, $Patients_first_Name, $Patients_Last_Name, $Doctors_SSN, $Doctors_Name, $Diagnosis_ID);

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
