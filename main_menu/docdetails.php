<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['uname'])) {
  
    header("Location:/project_work/loogginngginn/sign_in.html");
    exit;
}

$loggedin_DSSN = $_SESSION['uname'];

$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT  * FROM doctor WHERE DSSN=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedin_DSSN);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $stmt->bind_param("s", $loggedin_DSSN);

    if ($result->num_rows > 0) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title> DOCTORS' DETAILS</title>
            <link rel="stylesheet" href="/project_work/html_tables/tables.css">
            <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>
        <body>
            <h1>DOCTOR'S DETAILS</h1>
            <br><br><hr><br><br>
            <a class="btn btn-primary" href="/project_work/main_menu/doctormenu.html">BACK TO MAIN MENU</a>
            <br><br>
            <table class="table1">
                <tr>
                    <th>Doctor's SSN</th>
                    <th>Doctor's Name</th>
                    <th>Specialty</th>
                    <th>Years Of Experience</th>
                   
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='active-row'>";
                    echo "<td>" . $row["DSSN"] . "</td>";
                    echo "<td>" . $row["DName"] . "</td>";
                    echo "<td>" . $row["Specialty"] . "</td>";
                    echo "<td>" . $row["YearsOfExperience"] . "</td>";
                
                    echo "</tr>";
                }
                ?>
            </table>
        </body>
        </html>
        <?php
    } else {
        echo "No doctor's details available for the logged-in doctor.";
    }
} else {
    die("Error executing the query: " . $stmt->error);
}

$conn->close();
?>
