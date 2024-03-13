<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['PharSSN'])) {
    $Pharmacists_SSN = $_GET['PharSSN'];

    
    $sql = "SELECT * FROM pharmacist WHERE PharSSN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Pharmacists_SSN);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Pharmacist_SSN=$row['PharSSN'];
        $Pharmacists_First_Name=$row['Pharfname'];
        $Pharmacists_Last_Name=$row['Pharlname'];
        $Pharmacys_Name=$row['PharName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
        ?>
        <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="phartupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name="PharSSN" value="<?php echo $Pharmacists_SSN; ?>">

            <label for="Pharfname">Pharmacist's First Name:</label>
            <input type="text" name="Pharfname" value="<?php echo $Pharmacists_First_Name; ?>">
            <br><br>
            <label for="Pharlname">Pharmacist's Last Name:</label>
            <input type="text" name="Pharlname" value="<?php echo $Pharmacists_Last_Name; ?>">
            <br><br>
            <label for="PharName">Pharmacy:</label>
            <input type="text" name="PharName" value="<?php echo $Pharmacys_Name; ?>">
            <br><br>
            <label for="PharPhoneNo">Pharmacy's Phone Number:</label>
            <input type="number" name="PharPhoneNo" value="<?php echo $Pharmacys_Phone_Number; ?>">
            <br><br>
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Pharmacist not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
