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
    // Rest of the code to handle the registration process
 
    $Pharmacys_Name = $_POST["PharName"];
    $Pharmacys_Phone_Number = $_POST["PharPhoneNo"];
    $Location=$_POST['LoAddress'];

    $Create_Password = $_POST["Create_Password"];
    $Confirm_Password = $_POST["Confirm_Password"];


    // Validate password match
    if ($Create_Password !== $Confirm_Password) {
        echo "Passwords do not match";
        exit;
    }

    // Hash the password for storage
    $hashedPassword = password_hash($Create_Password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO pharmacy (PharPhoneNo,PharName,LoAddress, password) VALUES (?,?,?,?)");
    $stmt->bind_param("isss",$Pharmacys_Phone_Number, $Pharmacys_Name,$Location,$hashedPassword);

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
