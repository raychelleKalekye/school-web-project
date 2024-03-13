<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['SalesID'])) {
    $Sales_ID = $_GET['SalesID'];

    
    $sql = "SELECT * FROM sales WHERE SalesID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Sales_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Sales_ID= $row['SalesID'];
        $Trade_Name=$row['TradeName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
        $Pharmacys_Name=$row['PharName'];
        $Pharmacist_SSN=$row['PharSSN'];
        $Pharmacist_First_Name=$row['Pharfname'];
        $Pharmacist_Last_Name=$row['Pharlname'];
        $Patients_SSN=$row['SSN'];
        $Patients_First_Name=$row['Pfname'];
        $Patients_Last_Name=$row['Plname'];
        $Dosage=$row['Dosage'];
        $DatePurchased=$_POST["DatePurchased"];

        ?>
        <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="salesupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name="SalesID" value="<?php echo $Sales_ID; ?>">

            <label for="DatePurchased">Date Purchased :</label>
            <input type="text" name="DatePurchased" value="<?php echo $DatePurchased; ?>">
            <br><br>

            <label for="TradeName">Trade Name:</label>
            <input type="text" name="TradeName" value="<?php echo $Trade_Name; ?>">
            <br><br>
            
            <label for="PharPhoneNo">Pharmacys Phone Number:</label>
            <input type="number" name="PharPhoneNo" value="<?php echo $Pharmacys_Phone_Number; ?>">
            <br><br>
            <label for="PharName">Pharmacys Name:</label>
            <input type="text" name="PharName" value="<?php echo $Pharmacys_Name; ?>">
            <br><br>
            <label for="PharSSN">Pharmacist's SSN:</label>
            <input type="number" name="PharSSN" value="<?php echo $Pharmacist_SSN; ?>">
            <br><br>
            <label for="Pharfname">Pharmacist's First Name:</label>
            <input type="text" name="Pharfname" value="<?php echo $Pharmacist_First_Name; ?>">
            <br><br>
            <label for="Pharlname">Pharmacist's Last Name:</label>
            <input type="text" name="Pharlname" value="<?php echo $Pharmacist_Last_Name; ?>">
            <br><br>
            <label for="SSN">Patient's SSN:</label>
            <input type="number" name="SSN" value="<?php echo $Patients_SSN; ?>">
            <br><br>
            <label for="Pfname">Patients First Name:</label>
            <input type="text" name="Pfname" value="<?php echo $Patients_First_Name; ?>">
            <br><br>
            <label for="Plname">Patients Last Name:</label>
            <input type="text" name="Plname" value="<?php echo $Patients_Last_Name; ?>">
            <br><br>
            <label for="Dosage">Dosage:</label>
            <input type="text" name="Dosage" value="<?php echo $Dosage; ?>">
            <br><br>

            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Sales not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>