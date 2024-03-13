<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['PresID'])) {
    $Prescription_ID = $_GET['PresID'];

   
    $sql = "SELECT * FROM prescription WHERE PresID = $Prescription_ID";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Prescription_ID = $row['PresID'];
        $Prescription_Date=$row['PresDate'];
        $Trade_Name=$row['TradeName'];
        $Dosage=$row['Dosage'];
        $Doctors_SSN=$row['DSSN'];
        $Doctors_Name=$row['DName'];
        $Patients_First_Name=$row['Pfname'];
        $Patients_Last_Name=$row['Plname'];
        $Patients_SSN=$row['SSN'];
        


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $delete_sql = "DELETE FROM prescription WHERE PresID = $Prescription_ID";
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
            <th>Prescription ID</th>
            <th>Date Of Prescription</th>
            <th>Trade Name</th>
            <th>Dosage</th>
            <th>Doctor's SSN</th>
            <th>Doctor's Name</th>
            <th>Patient's SSN</th>
            <th>Patients First Name</th>
            <th>Patients Last Name</th>
            <th>Patients SSN</th>
        </tr>
        <tr>
            <td><?php echo $Prescription_ID; ?></td>
            <td><?php echo $Prescription_Date; ?></td>
            <td><?php echo $Trade_Name; ?></td>
            <td><?php echo $Dosage; ?></td>
            <td><?php echo $Doctors_SSN; ?></td>
            <td><?php echo $Doctors_Name; ?></td>
            <td><?php echo $Patients_SSN; ?></td>
            <td><?php echo $Patients_First_Name; ?></td>
            <td><?php echo $Patients_Last_Name; ?></td>
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="prescriptiontable.php">Back to Prescription List</button>
</body>
</html>

<?php
    } else {
        echo "Precsription not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
