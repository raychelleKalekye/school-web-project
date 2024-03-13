<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['ContractId'])) {
    $Contract_Id = $_GET['ContractId'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM pharmcontract WHERE ContractId = $Contract_Id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Contract_Id = $row['ContractId'];
        $Companys_Phone_Number=$row['CoPhoneNo'];
        $Supervisors_ID=$row['SupervisorID'];
        $Supervisors_Name=$row['SupName'];
        $Companys_Name=$row['CoName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
        $Pharmacys_Name=$row['PharName'];
        $Start_Date=$row['StartDate'];
        $EndDate=$row['EndDate'];
        $Contracts_Text=$row['ContractText'];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the diagnosis
            $delete_sql = "DELETE FROM pharmcontract WHERE ContractId = $Contract_Id";
            if ($conn->query($delete_sql) === TRUE) {
                echo "Record deleted successfully.";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <link rel="stylesheet" href="/project_work/html_tables/tables.css">
</head>
<body>
    <h2>Confirm Delete</h2>
    <p>Are you sure you want to delete this record?</p>
    <table class=table1>
        <tr>
            <th>Contract ID</th>
            <th>Company's Name</th>
            <th>Company's Phone Number</th>
            <th>Pharmacy's Name</th>
            <th>Pharmacys's Phone Number</th>
            <th>Supervisor's ID</th>
            <th>Supervisor's Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Contract's Text</th>
        </tr>
        <tr>
            <td><?php echo $Contract_Id; ?></td>
            <td><?php echo $Companys_Name; ?></td>
            <td><?php echo $Companys_Phone_Number; ?></td>
            <td><?php echo $Pharmacys_Name; ?></td>
            <td><?php echo $Pharmacys_Phone_Number; ?></td>
            <td><?php echo $Supervisors_Name; ?></td>
            <td><?php echo $Start_Date; ?></td>
            <td><?php echo $EndDate; ?></td>
            <td><?php echo $Contracts_Text; ?></td>
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="contracttable.php">Back to Contracts' List</button>
</body>
</html>

<?php
    } else {
        echo "Diagnosis not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
