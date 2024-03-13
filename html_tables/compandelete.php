<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['CoPhoneNo'])) {
    $Phone_Number = $_GET['CoPhoneNo'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM pharcompany WHERE CoPhoneNo = $Phone_Number";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Companys_Name=$row['CoName'];
        $Phone_Number=$row['CoPhoneNo'];
        $Email=$row['Email'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the diagnosis
            $delete_sql = "DELETE FROM pharcompany WHERE CoPhoneNo = $Phone_Number";
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
        <th>Company's Name</th>
         <th>Phone Number</th>
         <th> Email</th>
        
        </tr>
        <tr>
            <td><?php echo $Companys_Name; ?></td>
            <td><?php echo $Phone_Number; ?></td>
            <td><?php echo $Email; ?></td>
         
            
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="companytable.php">Back to Companies List</button>
</body>
</html>


<?php

    } else {
        echo "Company not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
