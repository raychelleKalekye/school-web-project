<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['OrderId'])) {
    $Order_Id = $_GET['OrderId'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM orders WHERE OrderId = '$Order_Id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Order_Id = $row['OrderId'];
        $Order_Date=$row['OrdDate'];
        $Pharmacys_Name=$row['PharName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
        $Trade_Name=$row['TradeName'];
        $Formula=$row['Formula'];
        $Quantity=$row['Quantity'];
        $Companys_Name=$row['CoName'];
        $Companys_Phone_Number=$row['CoPhoneNo'];
       


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Delete the diagnosis
            $delete_sql = "DELETE FROM orders WHERE OrderId = $Order_Id";
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
            <th>Order ID</th>
            <th>Order's Date</th>
            <th>Pharmacy's Name</th>
            <th>Pharmacys's Phone Number</th>
            <th>Trade Name</th>
            <th>Formula</th>
            <th>Quantity</th>
            <th>Company's Name</th>
            <th>Company's Phone Number</th>
          
        </tr>
        <tr>
            <td><?php echo $Order_Id; ?></td>
            <td><?php echo $Order_Date; ?></td>
            <td><?php echo $Pharmacys_Name; ?></td>
            <td><?php echo $Pharmacys_Phone_Number; ?></td>
            <td><?php echo $Trade_Name; ?></td>
            <td><?php echo $Formula; ?></td>
            <td><?php echo $Quantity; ?></td>
            <td><?php echo $Companys_Name; ?></td>
            <td><?php echo $Companys_Phone_Number; ?></td>
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="ordertable.php">Back to Orders' List</button>
</body>
</html>

<?php
    } else {
        echo "Order not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
