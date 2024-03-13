<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connection is successful";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Pharmacist_SSN = $_POST["PharSSN"];
    $Pharmacists_first_name = $_POST["Pharfname"];
    $Pharmacists_last_name = $_POST["Pharlname"];
    $Pharmacys_Name = $_POST["PharName"];
    $Pharmacys_Phone_Number = $_POST["PharPhoneNo"];
}

$sql = "INSERT INTO pharmacist (PharSSN, Pharfname, Pharlname, PharName, PharPhoneNo) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $Pharmacist_SSN, $Pharmacists_first_name, $Pharmacists_last_name, $Pharmacys_Name, $Pharmacys_Phone_Number);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Data was saved successfully";
} else {
    echo "Data was not saved";
}

$stmt->close();
?>
