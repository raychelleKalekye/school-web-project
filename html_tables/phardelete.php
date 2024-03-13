<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['PharPhoneNo'])) {
    $Pharmacys_Phone_Number = $_GET['PharPhoneNo'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM pharmacy WHERE PharPhoneNo = $Pharmacys_Phone_Number";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Pharmacys_Name=$row['PharName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
        $Location_Address=$row['LoAddress'];
        $Email=$row['Email'];
    

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the diagnosis
            $delete_sql = "DELETE FROM pharcompany WHERE PharPhoneNo = $Pharmacys_Phone_Number";
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
        <th>Pharmacy's Name</th>
         <th>Phone Number</th>
         <th>Location</th>
         <th> Email</th>
        
        </tr>
        <tr>
            <td><?php echo $Pharmacys_Name; ?></td>
            <td><?php echo $Pharmacys_Phone_Number; ?></td>
            <td><?php echo $Location_Address; ?></td>
            <td><?php echo $Email; ?></td>
         
            
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="pharmacytable.php">Back to Pharmacies List</button>
</body>
</html>


<?php

    } else {
        echo "Pharmacy not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
