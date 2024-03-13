<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['SalesID'])) {
    $Sales_Id = $_GET['SalesID'];


    $sql = "SELECT * FROM sales WHERE SalesID = $Sales_Id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Sales_ID= $row['SalesID'];
        $Trade_Name=$row['TradeName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
        $Pharmacys_Name=$row['PharName'];
        $Pharmacist_SSN=$row['PharSSN'];
        $Pharmacist_First_Name=$row['Pharfname'];
        $Pharmacist_Last_Name=$row['Pharlname'];
        $Patients_SSN=$row['SSN'];
        $Patients_First_Name=$row['Pfname'];
        $Patients_Last_Name=$row['Plname'];
        $Dosage=$row['Dosage'];
        $DatePurchased=$_POST["DatePurchased"];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $delete_sql = "DELETE FROM sales WHERE SalesID = $Sales_ID";
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
            <th>Sales ID</th>
            <th>Date Pruchased</th>
            <th>Trade Name</th>
            <th>Pharmacys Phone Number</th>
            <th>Pharmacys Name</th>
            <th>Pharmacist's SSN</th>
            <th>Pharmacist's First Name</th>
            <th>Pharmacist's Last Name</th>
            <th>Patient's SSN</th>
            <th>Patient's First Name</th>
            <th>Patient's Last Name</th>
            <th>Dosage</th>
            
        </tr>
        <tr>
            <td><?php echo $Sales_Id; ?></td>
            <td><?php echo $DatePurchased; ?></td>
            <td><?php echo $Trade_Name; ?></td>
            <td><?php echo $Pharmacys_Phone_Number; ?></td>
            <td><?php echo $Pharmacys_Name; ?></td>
            <td><?php echo $Pharmacist_SSN; ?></td>
            <td><?php echo $Pharmacist_First_Name; ?></td>
            <td><?php echo $Patients_Last_Name; ?></td>
            <td><?php echo $Patients_SSN; ?></td>
            <td><?php echo $Patients_First_Name; ?></td>
            <td><?php echo $Patients_Last_Name; ?></td>
            <td><?php echo $Dosage; ?></td>

        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="salestable.php">Back to Sales' List</button>
</body>
</html>

<?php
    } else {
        echo "Sales not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
