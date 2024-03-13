<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['insuranceNo'])) {
    $Insurance_Number = $_GET['insuranceNo'];

    
    $sql = "SELECT * FROM insurance WHERE insuranceNo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Insurance_Number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Insurance_Number = $row['insuranceNo'];
        $Insurance_Company=$row['InsuranceCo'];
        $Patients_First_Name=$row['Pfname'];
        $Patients_Last_Name=$row['Plname'];
        $Percent_Deducted=$row['PercentDeducted'];
        $Patients_SSN=$row['SSN'];
       

        ?>
        <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="insuupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name="insuranceNo" value="<?php echo $Insurance_Number; ?>">

            <label for="InsuranceCo">Insurance Company:</label>
            <input type="text" name="InsuranceCo" value="<?php echo $Insurance_Company; ?>">
            <br><br>
            <label for="Pfname">Patient's First Name:</label>
            <input type="text" name="Pfname" value="<?php echo $Patients_First_Name; ?>">
            <br><br>
            <label for="Plname">Patient's Last Name:</label>
            <input type="text" name="Plname" value="<?php echo $Patients_Last_Name; ?>">
            <br><br>
            <label for="PercentDeducted">Percent Deducted:</label>
            <input type="number" name="PercentDeducted" value="<?php echo $Percent_Deducted; ?>">
            <br><br>
            <label for="SSN">Patients SSN:</label>
            <input type="number" name="SSN" value="<?php echo $Patients_SSN; ?>">
            <br><br>
           
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Insurance  not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
