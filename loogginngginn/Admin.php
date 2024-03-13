<?php
$host = "localhost";
$username = ""; // Add your database username
$password = ""; // Add your database password
$database = "drug_dispensing_tool";
$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $ASSN = $_POST["ASSN"];
    $First_Name = $_POST["First_Name"];
    $Last_Name = $_POST["Last_Name"];
    $Email_Address = $_POST["Email_Address"];
    $DateofBirth =$_POST["DateOfBirth"];
    $PhoneNo = $_POST["PhoneNo"];
    $Create_Password = $_POST["Create_Password"];
    $Confirm_Password = $_POST["Confirm_Password"];
    $AdminCode = $_POST["AdminCode"]; // Use a different variable name for input

    if (!filter_var($Email_Address, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
        exit;
    }

    if ($Create_Password !== $Confirm_Password) {
        echo "Passwords do not match";
        exit;
    }

    // Check if the admin code matches the desired value
    $desiredAdminCode = "#BlackLivesMatter"; // Replace with your desired admin code

    // Debug statements to inspect values
    var_dump($AdminCodeInput);
    var_dump($desiredAdminCode);

    if ($AdminCodeInput !== $desiredAdminCode) {
        echo "Invalid admin code";
        exit;
    }

    // Hash the password for storage
    // Note: It is highly recommended to use a secure hashing algorithm like bcrypt
    $hashedPassword = password_hash($Create_Password, PASSWORD_DEFAULT);

    // Store the admin data in the database
    $query = "INSERT INTO admin (ASSN, First_Name, Last_Name, Email_Address, DateOfBirth, PhoneNo, Password) VALUES 
    ('$ASSN', '$First_Name', '$Last_Name', '$Email_Address', '$DateOfBirth','$PhoneNo', '$hashedPassword')";
     $select =mysqli_query($conn, "Select*FROM admin where SSN='$ASSN' AND Password='$hashedPassword'");


    if (mysqli_query($connection, $query)) {
        echo "Admin registered successfully! /n Go back to log in";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
} else {
    // Handle cases where the form is not submitted
    // Redirect the user to the registration form or display an error message
    header("Location: adminForm.html");
    exit();
}

// Close the database connection
mysqli_close($connection);
?>
