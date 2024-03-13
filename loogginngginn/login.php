<?php

session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $ssn = $_POST['uname']; // Assuming the username is the SSN itself
    $pass = $_POST['pass'];
    $user = $_POST['user'];

    switch($user) {
        case 'Patient':
        // Check if the patient with the given SSN exists in the database
        $sql = "SELECT * FROM patient WHERE SSN=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $ssn);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $_SESSION["uname"] = $ssn; // Store the SSN in the session
            header("Location: /project_work/main_menu/patientmenu.html");
            exit;
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Invalid access")';
            echo 'window.location.href="/project_work/loogginngginn/Sign_in.html"';
            echo '</script>';
        }
        break;
        case 'Doctor':
            $sql = "SELECT * FROM doctor WHERE DSSN=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $ssn);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $_SESSION["uname"] = $ssn; // Store the SSN in the session
                header("Location: /project_work/main_menu/doctormenu.html");
                exit;
               
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("Invalid access")';
                echo 'window.location.href="/project_work/loogginngginn/sign_in.html"';
                echo '</script>';
            }
            break;
            case 'Pharmacy':
                // Check if the pharmacist with the given SSN exists in the database
                $sql = "SELECT * FROM pharmacy WHERE PharPhoneNo=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $ssn);
                $stmt->execute();
                $result = $stmt->get_result();
    
                if ($result->num_rows === 1) {
                    $_SESSION["uname"] = $ssn; // Store the SSN in the session
                    header("Location: /project_work/main_menu/pharmacymenu.html");
                    exit;
                } else {
                    echo '<script type="text/javascript">';
                    echo 'alert("Invalid access")';
                    echo 'window.location.href="/project_work/loogginnggin/sign_in.html"';
                    echo '</script>';
                }
                break;
                    case 'Admin':
                        // Check if the admin with the given SSN exists in the database
                        $sql = "SELECT * FROM admin WHERE adminid=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $ssn);
                        $stmt->execute();
                        $result = $stmt->get_result();
            
                        if ($result->num_rows === 1) {
                            $_SESSION["uname"] = $ssn; // Store the SSN in the session
                            header("Location: /project_work/main_menu/adminmenu.html");
                            exit;
                        } else {
                            echo '<script type="text/javascript">';
                            echo 'alert("Invalid access")';
                            echo 'window.location.href="/project_work/main_menu/adminmenu.html"';
                            echo '</script>';
                        }
                        break;
        
                default:
                    echo "Invalid actor selected";
                    break;

    }
}

// Close the database connection
$conn->close();
?>
