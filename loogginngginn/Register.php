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
    $first_name=$_POST["Pfname"];
    $last_name=$_POST["Plname"];
    $SSN=$_POST["id"];
    $Gender=$_POST["gender"];
    $Address=$_POST["Address"];
    $YearofBirth=$_POST["YearofBirth"];
    $email=$_POST["email"];
    $Create_Password = $_POST["Create_Password"];
    $Confirm_Password = $_POST["Confirm_Password"];

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
        exit;
    }

    // Validate password match
    if ($Create_Password !== $Confirm_Password) {
        echo "Passwords do not match";
        exit;
    }

    // Hash the password for storage
    $hashedPassword = password_hash($Create_Password, PASSWORD_DEFAULT);

    // Prepare and execute the INSERT statement
    $stmt = $conn->prepare("INSERT INTO patient (Pfname, Plname, SSN, YearofBirth, Gender, Address, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssss", $first_name, $last_name, $SSN, $YearofBirth, $Gender, $Address, $email, $hashedPassword);

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
