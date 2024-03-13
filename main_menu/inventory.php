<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['uname'])) {
    // Redirect to the login page or show an error message
    header("Location: /project_work/loogginngginn/sign_in.html");
    exit;
}

$loggedin_PharPhoneNo = $_SESSION['uname'];

$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT InventoryID, TradeName, Formula, Quantity FROM inventory WHERE PharPhoneNo=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedin_PharPhoneNo);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>INVENTORY TABLE</title>
            <link rel="stylesheet" href="/project_work/html_tables/tables.css">
            <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>
        <body>
            <h1>LIST OF INVENTORY</h1>
            <br><br><hr><br><br>
            <a class="btn btn-primary" href="/project_work/main_menu/pharmarcymenu.html">BACK TO MAIN MENU</a>
            <br><br>
            <a class="btn btn-primary" href="/project_work/html_forms/inventory.html">Add INVENTORY</a>
            <br><br>
            <table class="table1">
                <tr>
                    <th>Inventory ID</th>
                    <th>Trade Name</th>
                    <th>Formula</th>
                    <th>Quantity</th>
                    <th>Pharmacy's Name</th>
                    <th>Pharmacys's Phone Number</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='active-row'>";
                    echo "<td>" . $row["InventoryID"] . "</td>";
                    echo "<td>" . $row["TradeName"] . "</td>";
                    echo "<td>" . $row["Formula"] . "</td>";
                    echo "<td>" . $row["Quantity"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </body>
        </html>
        <?php
    } else {
        echo "No inventory available for the logged-in user.";
    }
} else {
    die("Error executing the query: " . $stmt->error);
}

$conn->close();
?>
