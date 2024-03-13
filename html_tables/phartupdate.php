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
        $Pharmacist_SSN=$_POST['PharSSN'];
        $Pharmacists_First_Name=$_POST['Pharfname'];
        $Pharmacists_Last_Name=$_POST['Pharlname'];
        $Pharmacys_Name=$_POST['PharName'];
        $Pharmacys_Phone_Number=$_POST['PharPhoneNo'];



  
    $sql = "UPDATE pharmacist SET Pharfname=?,Pharlname=?,PharName=?,PharPhoneNo=? WHERE PharSSN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii",$Pharmacists_First_Name,$Pharmacists_Last_Name,$Pharmacys_Name,$Pharmacys_Phone_Number,$Pharmacist_SSN);

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
