<?php
// Start the session (Add this line at the beginning of the file)
session_start();

// Check if the patient is logged in (modify this condition based on your actual authentication logic)

    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: Sign_in.html");
    exit;

?>
