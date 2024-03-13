<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['PharPhoneNo'])) {
    $Pharmacys_Phone_Number = $_GET['PharPhoneNo'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM pharmacy WHERE PharPhoneNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Pharmacys_Phone_Number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Pharmacys_Name=$row['PharName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
        $Location_Address=$row['LoAddress'];
        $Email=$row['Email'];;

        // Display the update form
        ?>
         <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="pharupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name=" PharPhoneNo" value="<?php echo $Pharmacys_Phone_Number; ?>">

            <label for="PharName">Pharmacy's Name:</label>
            <input type="text" name="PharName" value="<?php echo $Pharmacys_Name; ?>">
            <br><br>
            <label for="LoAddress">Pharmacy's Location:</label>
            <input type="text" name="LoAddress" value="<?php echo $Location_Address; ?>">
            <br><br>
            <label for="Email">Email:</label>
            <input type="email" name="Email" value="<?php echo $Email; ?>">
            <br><br>
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Pharmacy not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
