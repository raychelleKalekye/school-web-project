<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['DiagnosisId'])) {
    $Diagnosis_Id = $_GET['DiagnosisId'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM diagnosis WHERE DiagnosisId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Diagnosis_Id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Diagnosis_Id = $row['DiagnosisId'];
        $Symptoms = $row['Symptoms'];
        $Diagnosis = $row['Diagnosis'];
        $Patients_SSN = $row['SSN'];
        $Patients_First_name = $row['Pfname'];
        $patients_last_name = $row['Plname'];
        $Doctors_SSN = $row['DSSN'];
        $Doctors_Name = $row['DName'];

        // Display the update form
        ?>
        <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="diagupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name="DiagnosisId" value="<?php echo $Diagnosis_Id; ?>">

            <label for="Symptoms">Symptoms:</label>
            <input type="text" name="Symptoms" value="<?php echo $Symptoms; ?>">
            <br><br>
            <label for="Diagnosis">Diagnosis:</label>
            <input type="text" name="Diagnosis" value="<?php echo $Diagnosis; ?>">
            <br><br>
            <label for="SSN">Patients SSN:</label>
            <input type="number" name="SSN" value="<?php echo $Patients_SSN; ?>">
            <br><br>
            <label for="Pfname">Patients First Name:</label>
            <input type="text" name="Pfname" value="<?php echo $Patients_First_name; ?>">
            <br><br>
            <label for="Plname">Patients Last Name:</label>
            <input type="text" name="Plname" value="<?php echo $patients_last_name; ?>">
            <br><br>
            <label for="DSSN">Doctors SSN:</label>
            <input type="number" name="DSSN" value="<?php echo $Doctors_SSN; ?>">
            <br><br>
            <label for="DName">Doctors Name:</label>
            <input type="text" name="DName" value="<?php echo $Doctors_Name; ?>">
            <br><br>
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Diagnosis not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
