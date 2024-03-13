<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['SupervisorID'])) {
    $Supervisors_ID = $_GET['SupervisorID'];

   
    $sql = "SELECT * FROM supervisor WHERE SupervisorID = $Supervisors_ID";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Supervisors_ID=$row['SupervisorID'];
        $Supervisors_Name=$row['SupName'];
        $Contract_Id=$row['ContractId'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $delete_sql = "DELETE FROM supervisor WHERE SupervisorID = $Supervisors_ID";
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
        <th>Supervisor's Name</th>
         <th>Supervisor's ID</th>
         <th> Contract Id</th>
        
        </tr>
        <tr>
            <td><?php echo $Supervisors_Name; ?></td>
            <td><?php echo $Supervisors_ID; ?></td>
            <td><?php echo $Email; ?></td>
         
            
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="supervisortable.php">Back to Supervisors List</button>
</body>
</html>


<?php

    } else {
        echo "Supervisor not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
