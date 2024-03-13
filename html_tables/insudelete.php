<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['insuranceNo'])) {
    $Insurance_Number = $_GET['insuranceNo'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM insurance WHERE insuranceNo = $Insurance_Number";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Insurance_Number = $row['insuranceNo'];
        $Insurance_Company=$row['InsuranceCo'];
        $Patients_First_Name=$row['Pfname'];
        $Patients_Last_Name=$row['Plname'];
        $Percent_Deducted=$row['PercentDeducted'];
        $Patients_SSN=$row['SSN'];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the diagnosis
            $delete_sql = "DELETE FROM insurance WHERE insuranceNo = $Insurance_Number";
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
         <th>Insurance Number</th>
         <th>Insurance Company</th>
         <th>Patient's First Name</th>
         <th>Patient's Last name</th>
         <th>Percent Deducted</th>
         <th>Patient's SSN</th>
        </tr>
        <tr>
            <td><?php echo $Insurance_Number; ?></td>
            <td><?php echo $Insurance_Company; ?></td>
            <td><?php echo $Patients_First_Name; ?></td>
            <td><?php echo $Patients_Last_Name; ?></td>
            <td><?php echo $Percent_Deducted; ?></td>
            <td><?php echo $Patients_SSN; ?></td>
          
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="insurancetable.php">Back to Insurance List</button>
</body>
</html>

<?php
    } else {
        echo "Insurance not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
