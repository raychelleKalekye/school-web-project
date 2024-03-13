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
    $Supervisors_ID=$_POST['SupervisorID'];
    $Supervisors_Name=$_POST['SupName'];
    $Contract_Id=$_POST['ContractId'];

   
    $sql = "UPDATE supervisor SET SupName = ?, ContractId = ? WHERE SupervisorID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi",$Supervisors_Name,$Contract_Id,$Supervisors_ID);
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
