<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['SSN'])) {
    $Patients_SSN = $_GET['SSN'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM patient WHERE SSN = $Patients_SSN";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Patients_SSN=$row['SSN'];
        $Patients_First_Name=$row['Pfname'];
        $Patients_Last_Name=$row['Plname'];
        $Age=$row['Age'];
        $Email=$row['Email'];
        $Location_Address=$row['LAddress'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the diagnosis
            $delete_sql = "DELETE FROM patient WHERE SSN = $Patients_SSN";
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
         <th>Patients SSN</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Age</th>
         <th>Location</th>
    
         <th>Email</th>
        
        </tr>
        <tr>
            <td><?php echo $Patients_SSN; ?></td>
            <td><?php echo $Patients_First_Name; ?></td>
            <td><?php echo $Patients_Last_Name; ?></td>
            <td><?php echo $Age; ?></td>
            <td><?php echo $Location_Address; ?></td>
            <td><?php echo $Email; ?></td>
         
            
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="/project_work/html_tables/patienttable.php">Back to Patients' List</button>
</body>
</html>

<?php
    } else {
        echo "Patient not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
