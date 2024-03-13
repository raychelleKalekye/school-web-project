<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['DiagnosisId'])) {
    $Diagnosis_Id = $_GET['DiagnosisId'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM diagnosis WHERE DiagnosisId = $Diagnosis_Id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Diagnosis_Id = $row['DiagnosisId'];
        $Symptoms = $row['Symptoms'];
        $Diagnosis = $row['Diagnosis'];
        $Patients_SSN = $row['SSN'];
        $Patients_First_name = $row['Pfname'];
        $patients_last_name = $row['Plname'];
        $Doctors_SSN = $row['DSSN'];
        $Doctors_Name = $row['DName'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the diagnosis
            $delete_sql = "DELETE FROM diagnosis WHERE DiagnosisId = $Diagnosis_Id";
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
    <link rel="stylesheet" href="/project_work/html_tables/tables.css"
</head>
<body>
    <h2>Confirm Delete</h2>
    <p>Are you sure you want to delete this record?</p>
    <table class=table1>
        <tr>
            <th>Diagnosis ID</th>
            <th>Symptoms</th>
            <th>Diagnosis</th>
            <th>Patient SSN</th>
            <th>Patient First Name</th>
            <th>Patient Last Name</th>
            <th>Doctor SSN</th>
            <th>Doctor Name</th>
        </tr>
        <tr>
            <td><?php echo $Diagnosis_Id; ?></td>
            <td><?php echo $Symptoms; ?></td>
            <td><?php echo $Diagnosis; ?></td>
            <td><?php echo $Patients_SSN; ?></td>
            <td><?php echo $Patients_First_name; ?></td>
            <td><?php echo $patients_last_name; ?></td>
            <td><?php echo $Doctors_SSN; ?></td>
            <td><?php echo $Doctors_Name; ?></td>
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="diagnosistable.php">Back to Diagnosis List</button>
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
