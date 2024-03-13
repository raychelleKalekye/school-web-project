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
    $Prescription_ID = $row['PresID'];
        $Prescription_Date=$row['PresDate'];
        $Trade_Name=$row['TradeName'];
        $Dosage=$row['Dosage'];
        $Doctors_SSN=$row['DSSN'];
        $Doctors_Name=$row['DName'];
        $Patients_First_Name=$row['Pfname'];
        $Patients_Last_Name=$row['Plname'];
        $Patients_SSN=$row['SSN'];


  
    $sql = "UPDATE pharmcontract SET PresId=?,TradeName=?,Dosage=?,DSSN=?,DName=?,Pfname=?,Plname=,SSN=? WHERE PresID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssii", $Prescription_Date,$Trade_Name,$Dosage,$Doctors_SSN,$Doctors_Name,$Patients_First_Name,$Patients_Last_Name,$Patients_SSN,$Prescription_ID);

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
