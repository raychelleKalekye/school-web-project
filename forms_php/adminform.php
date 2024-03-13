<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
    $first_name=$_POST["fname"];
    $last_name=$_POST["lname"];
    $Create_Password = $_POST["password"];
   
    $hashedPassword = password_hash($Create_Password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO admin (fname, lname,password) VALUES ( ?, ?, ?)");
    $stmt->bind_param("sss", $first_name, $last_name, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration successful.";
        header("Location: /project_work/loogginngginn/sign_in.html");
        exit;
    } else {
        echo "Error during registration: " . $stmt->error;
    }
    
    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();

?>
