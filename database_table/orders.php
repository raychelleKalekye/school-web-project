<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
$sql = "CREATE TABLE orders (
    OrderId varchar(255) PRIMARY KEY,
    OrdDate varchar(255),
    PharName varchar(255),
    PharPhoneNo int,
    TradeName varchar(255),
    Formula varchar(10000),
    Quantity int,
    CoName varchar(255),
    CoPhoneNo int

    
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
