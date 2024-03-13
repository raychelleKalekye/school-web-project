<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_GET['TradeName'])) {
    $Trade_Name = $_GET['TradeName'];

    $sql = "SELECT * FROM drugs WHERE TradeName = '$Trade_Name'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Trade_Name=$row['TradeName'];
        $Formula=$row['Formula'];
        $Category=$row['Category'];
        $Drug_img=$row['drg_img'];
       

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $delete_sql = "DELETE * FROM drugs WHERE TradeName = $Trade_Name";
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
        <th>Trade Name</th>
         <th>Formula</th>
         <th>Category</th>
         <th>IMAGE OF DRUG</th>
      
        
        </tr>
        <tr>
            <td><?php echo $Trade_Name; ?></td>
            <td><?php echo $Formula; ?></td>
            <td><?php echo $Category?></td>
            <td><?php echo $Drug_img?></td>
      
         
            
        </tr>
    </table>
    <br>
    <form action="" method="POST">
        <input type="submit" value="Delete">
    </form>
    <br>
    <button  href="drugstable.php">Back to Drugs List</button>
</body>
</html>

<?php
    } else {
        echo "Drug not found.";
    }
} else {
    echo "Invalid request.";
}
$conn->close();
?>
