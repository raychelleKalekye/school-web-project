<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['InventoryID'])) {
    $Inventory_ID = $_GET['InventoryID'];

    $sql = "SELECT * FROM inventory WHERE InventoryID = '$Inventory_ID'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Inventory_ID = $row['InventoryID'];
        $Trade_Name=$row['TradeName'];
        $Formula=$row['Formula'];
        $Quantity=$row['Quantity'];
        $Pharmacys_Name=$row['PharName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
        $Category=$row['Category'];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $delete_sql = "DELETE FROM inventory WHERE InventoryID = '$Inventory_ID'";
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
         <th>Inventory ID</th>
         <th>Category</th>
         <th>Trade Name</th>
         <th>Formula</th>
         <th>Quantity</th>
         <th>Pharmacy's Name</th>
         <th>Pharmacys's Phone Number</th>

        </tr>
        <tr>
            <td><?php echo $Inventory_ID; ?></td>
            <td><?php echo $Category;?></td>
            <td><?php echo $Trade_Name; ?></td>
            <td><?php echo $Formula; ?></td>
            <td><?php echo $Quantity; ?></td>
            <td><?php echo $Pharmacys_Name; ?></td>
            <td><?php echo $Pharmacys_Phone_Number; ?></td>
          
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="inventorytable.php">Back to Inventory </button>
</body>
</html>

<?php
    } else {
        echo "Inventory not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
