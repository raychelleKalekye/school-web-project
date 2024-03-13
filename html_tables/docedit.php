<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['DSSN'])) {
    $Doctors_SSN = $_GET['DSSN'];

    
    $sql = "SELECT * FROM doctor WHERE DSSN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Doctors_SSN);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Doctors_SSN=$row['DSSN'];
        $Doctors_Name=$row['DName'];
        $Specialty=$row['Specialty'];
        $Years_Of_Experience=$row['YearsOfExperience'];
        $Email=$row['Email'];
        ?>
        <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="docupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name="DSSN" value="<?php echo $Doctors_SSN; ?>">

            <label for="DName">Doctor's Name:</label>
            <input type="text" name="DName" value="<?php echo $Doctors_Name; ?>">
            <br><br>
            <label for="Specialty">Specialty:</label>
            <select id="Specialty" name="Specialty" value="<?php echo $Specialty; ?>">
            <option value="Internal medicine">Internal Medicine</option>
            <option value="General Practicioner">General Practicioner</option>
            <option value="Opthamology">Opthamology</option>
            <option value="Emergency medicine">Emergency medicine</option>
            <option value="Otorhinolaryngology">Otorhinolaryngology</option>
            <option value="Anesthesiology">Anesthesiology</option>
            <option value="Oncology">Oncology</option>
            <option value="Rheumatology">Rheumatology</option>
            <option value="Neurology">Neurology</option>
            <option value="Obstetrics and gynaecology">Obstetrics and Gynaecology</option>
            <option value="Dermatology">Dermartology</option>
            <option value="Cardiology">Cardiology</option>
            <option value="Endocrinology">Endocrinology</option>
            <option value="Radiology">Radiology</option>
            <option value="Family Medicine">Family Medicine</option>       
        </select>
            <br><br>
            <label for="YearsOfExperience">Years Of Experience:</label>
            <input type="number" name="YearsOfExperience" value="<?php echo $Years_Of_Experience; ?>">
            <br><br>
            <label for="Email">Email:</label>
            <input type="email" name="Email" value="<?php echo $Email; ?>">
            <br><br>
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Doctor not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
