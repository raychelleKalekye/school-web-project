<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
$sql = "CREATE TABLE prescription (
    PresID int PRIMARY KEY,
    PresDate varchar(255),
    TradeName varchar(255),
    Dosage varchar(200),
    DSSN int,
    DName varchar(255),
    Pfname varchar(255),
    Plname varchar(255),
    SSN int
    )";
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . "\n";
} else {
    echo "Connection successful \n";
    if ($conn->query($sql) === TRUE) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}
$conn->close();
?>
