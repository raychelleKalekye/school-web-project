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
    $Doctors_Name=$_POST["DName"];
    $Doctors_SSN=$_POST["DSSN"];
    $Specialty=$_POST["Specialty"];
    $Years_of_Experience=$_POST["YearsofExperience"];
  
    $Create_Password = $_POST["Create_Password"];
    $Confirm_Password = $_POST["Confirm_Password"];
}
 

    // Validate password match
    if ($Create_Password !== $Confirm_Password) {
        echo "Passwords do not match";
        exit;
    }

    // Hash the password for storage
    $hashedPassword = password_hash($Create_Password, PASSWORD_DEFAULT);

    // Prepare and execute the INSERT statement
    $stmt = $conn->prepare("INSERT INTO doctor (DSSN,DName,Specialty,YearsofExperience,password) VALUES(?,?,?,?,?)");
    $stmt->bind_param("issis",$Doctors_SSN,$Doctors_Name,$Specialty,$Years_of_Experience, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration successful.";
        header("Location: /project_work/loogginngginn/sign_in.html");
        exit; 
    } else {
        echo "Error during registration: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();


// Close the database connection
$conn->close();
?>
