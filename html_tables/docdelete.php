<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['DSSN'])) {
    $Doctors_SSN = $_GET['DSSN'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM doctor WHERE DSSN = $Doctors_SSN";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Doctors_SSN=$row['DSSN'];
        $Doctors_Name=$row['DName'];
        $Specialty=$row['Specialty'];
        $Years_Of_Experience=$row['YearsOfExperience'];
        $Email=$row['Email'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the diagnosis
            $delete_sql = "DELETE FROM doctor WHERE DSSN = $Doctors_SSN";
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
         <th>Doctors SSN</th>
         <th>Doctors Name</th>
         <th>Specialty</th>
         <th>Years Of Experience</th>
         <th>Email</th>
        
        </tr>
        <tr>
            <td><?php echo $Doctors_SSN; ?></td>
            <td><?php echo $Doctors_Name; ?></td>
            <td><?php echo $Specialty; ?></td>
            <td><?php echo $Years_Of_Experience; ?></td>
            <td><?php echo $Email; ?></td>
         
            
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="/project_work/html_tables/doctortable.php">Back to Doctors' List</button>
</body>
</html>

<?php
    } else {
        echo "Doctor not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
