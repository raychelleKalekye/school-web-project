<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['PresID'])) {
    $Prescription_ID = $_GET['PresID'];

    
    $sql = "SELECT * FROM prescription WHERE PresID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("I", $Prescription_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Prescription_ID = $row['PresID'];
        $Prescription_Date=$row['PresDate'];
        $Trade_Name=$row['TradeName'];
        $Dosage=$row['Dosage'];
        $Doctors_SSN=$row['DSSN'];
        $Doctors_Name=$row['DName'];
        $Patients_First_Name=$row['Pfname'];
        $Patients_Last_Name=$row['Plname'];
        $Patients_SSN=$row['SSN'];

        ?>
        <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="preupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name="PresID" value="<?php echo $Prescription_ID; ?>">

            <label for="PresDate">Date of the Prescription:</label>
            <input type="date" name="PresDate" value="<?php echo $Prescription_Date; ?>">
            <br><br>
            <label for="TradeName">Trade Name:</label>
            <input type="text" name="TradeName" value="<?php echo $Trade_Name; ?>">
            <br><br>
            <label for="Dosage">Dosage:</label>
            <input type="text" name="Dosage" value="<?php echo $Dosage; ?>">
            <br><br>
            <label for="DSSN">Doctor's SSN:</label>
            <input type="number" name="DSSN" value="<?php echo $Doctors_SSN; ?>">
            <br><br>
            <label for="DName">Doctor's Name:</label>
            <input type="number" name="PharPhoneNo" value="<?php echo $Pharmacys_Phone_Number; ?>">
            <br><br>
            <label for="Pfname">Patients First Name:</label>
            <input type="text" name="Pfname" value="<?php echo $Patients_First_Name; ?>">
            <br><br>
            <label for="Plname">Patients_Last_Name</label>
            <input type="text" name="Plname" value="<?php echo $Patients_Last_Name; ?>">
            <br><br>
            <label for="SSN">Patient's SSN</label>
            <input type="number" name="SSN" value="<?php echo $Patients_SSN; ?>">
            <br><br>
            
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Prescription not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>