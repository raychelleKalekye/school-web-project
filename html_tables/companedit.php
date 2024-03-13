<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['CoPhoneNo'])) {
    $Phone_Number = $_GET['CoPhoneNo'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM pharcompany WHERE CoPhoneNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Phone_Number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Companys_Name=$row['CoName'];
        $Phone_Number=$row['CoPhoneNo'];
        $Email=$row['Email'];

        // Display the update form
        ?>
         <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="companupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name=" CoPhoneNo" value="<?php echo $Phone_Number; ?>">

            <label for="CoName">Companys Name:</label>
            <input type="text" name="CoName" value="<?php echo $Companys_Name; ?>">
            <br><br>
            <label for="Email">Email:</label>
            <input type="email" name="Email" value="<?php echo $Email; ?>">
            <br><br>
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Company not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
