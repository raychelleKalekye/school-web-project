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
    $Contract_Id = $_POST['ContractId'];
    $Companys_Phone_Number=$_POST['CoPhoneNo'];
    $Supervisors_ID=$_POST['SupervisorID'];
    $Supervisors_Name=$_POST['SupName'];
    $Companys_Name=$_POST['CoName'];
    $Pharmacys_Phone_Number=$_POST['PharPhoneNo'];
    $Pharmacys_Name=$_POST['PharName'];
    $Start_Date=$_POST['StartDate'];
    $EndDate=$_POST['EndDate'];
    $Contracts_Text=$_POST['ContractText'];


  
    $sql = "UPDATE pharmcontract SET CoPhoneNo=?,SupervisorID=?,SupName=?,CoName=?,PharPPhoneNo=?,PharName=?,StartDate=,EndDate=?,ContractText=? WHERE ContractId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iississss", $Companys_Phone_Number,$Supervisors_ID,$Supervisors_Name,$Companys_Name,$Pharmacys_Phone_Number,$Pharmacys_Name,$Start_Date,$EndDate,$Contracts_Text);

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
