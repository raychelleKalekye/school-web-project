<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['uname'])) {
    // Redirect to the login page or show an error message
    header("Location: /path/to/login_page.php");
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

$sql = "SELECT * FROM sales WHERE PharPhoneNo=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedin_PharPhoneNo);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>SALES TABLE</title>
            <link rel="stylesheet" href="/project_work/html_tables/tables.css">
            <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>
        <body>
            <h1>LIST OF SALES</h1>
            <br><br><hr><br><br>
            <a class="btn btn-primary" href="/project_work/main_menu/pharmacymenu.html">BACK TO MAIN MENU</a>
            <br><br>
            <table class="table1">
                <tr>
                    <th>Sales ID</th>
                    <th>Trade Name</th>
                    <th>Pharmacist's SSN</th>
                    <th>Pharmacist's First Name</th>
                    <th>Pharmacist's Last Name</th>
                    <th>Patient's SSN</th>
                    <th>Patient's First Name</th>
                    <th>Patient's Last Name</th>
                    <th>Dosage</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='active-row'>";
                    echo "<td>" . $row["SalesID"] . "</td>";
                    echo "<td>" . $row["TradeName"] . "</td>";
                    echo "<td>" . $row["PharSSN"] . "</td>";
                    echo "<td>" . $row["Pharfname"] . "</td>";
                    echo "<td>" . $row["Pharlname"] . "</td>";
                    echo "<td>" . $row["SSN"] . "</td>";
                    echo "<td>" . $row["Pfname"] . "</td>";
                    echo "<td>" . $row["Plname"] . "</td>";
                    echo "<td>" . $row["Dosage"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </body>
        </html>
        <?php
    } else {
        echo "No sales available for the logged-in user.";
    }
} else {
    die("Error executing the query: " . $stmt->error);
}

$conn->close();
?>
