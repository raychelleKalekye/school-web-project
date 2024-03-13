<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed".$conn->connect_error);
}

if (isset($_GET['PharSSN'])) {
    $Pharmacist_SSN = $_GET['PharSSN'];

    $sql = "SELECT * FROM pharmacist WHERE PharSSN = '$Pharmacist_SSN'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Pharmacist_SSN=$row['PharSSN'];
        $Pharmacists_First_Name=$row['Pharfname'];
        $Pharmacists_Last_Name=$row['Pharlname'];
        $Pharmacys_Name=$row['PharName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $delete_sql = "DELETE FROM pharmacist WHERE PharSSN = '$Pharmacist_SSN'";
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
         <th>Pharmacist SSN</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Pharmacy</th>
         <th>Pharmacys' Phone Number</th>
        
        </tr>
        <tr>
            <td><?php echo $Pharmacist_SSN; ?></td>
            <td><?php echo $Pharmacists_First_Name; ?></td>
            <td><?php echo $Pharmacists_Last_Name; ?></td>
            <td><?php echo $Pharmacys_Name; ?></td>
            <td><?php echo $Pharmacys_Phone_Number; ?></td>
         
            
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="/project_work/html_tables/pharmacisttable.php">Back to Pharmacists' List</button>
</body>
</html>

<?php
    } else {
        echo "Pharmacist not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
