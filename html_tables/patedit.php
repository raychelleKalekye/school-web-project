<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['SSN'])) {
    $Patients_SSN = $_GET['SSN'];

    $sql = "SELECT * FROM patient WHERE SSN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Patients_SSN);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    
        $Patients_SSN = $row['SSN'];
        $Patients_First_Name = $row['Pfname'];
        $Patients_Last_Name = $row['Plname'];
        $YearofBirth = $row['YearofBirth'];
        $Gender = $row['Gender'];
        $Email=$row['email'];
        $Location_Address=$row['Address'];
        $Password = $row['password'];

    

        // Display the update form
        ?>
        <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="patupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name="SSN" value="<?php echo $Patients_SSN; ?>">

            <label for="Pfname">Patients First Name:</label>
            <input type="text" name="Pfname" value="<?php echo $Patients_First_Name; ?>">
            <br><br>
            <label for="Plname">Patients Last Name:</label>
            <input type="text" name="Plname" value="<?php echo $Patients_Last_Name; ?>">
            <br><br>
            <label for="YearofBirth">Year Of Birth:</label>
            <input type="date" name="YearofBirth" value="<?php echo $YearofBirth; ?>">
            <br><br>
            <label for="Address">Location Address:</label>
            <input type="text" name="Address" value="<?php echo $Location_Address; ?>">
            <br><br>
            <label for="Email">Email:</label>
            <input type="email" name="Email" value="<?php echo $Email; ?>">
            <br><br>
            <label for="Gender">Gender:</label>
            <input type="text" name="Gender" value="<?php echo $Gender; ?>">
            <br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" value="<?php echo $password; ?>">
            <br><br>
        
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Patient not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
