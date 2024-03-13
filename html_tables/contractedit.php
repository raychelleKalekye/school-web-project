<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['ContractId'])) {
    $Contract_Id = $_GET['ContractId'];

    
    $sql = "SELECT * FROM pharmcontract WHERE ContractId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Contract_Id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Contract_Id = $row['ContractId'];
        $Companys_Phone_Number=$row['CoPhoneNo'];
        $Supervisors_ID=$row['SupervisorID'];
        $Supervisors_Name=$row['SupName'];
        $Companys_Name=$row['CoName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
        $Pharmacys_Name=$row['PharName'];
        $Start_Date=$row['StartDate'];
        $End_Date=$row['EndDate'];
        $Contracts_Text=$row['ContractText'];

        ?>
        <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="contractupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name="ContractId" value="<?php echo $Contract_Id; ?>">

            <label for="CoPhoneNo">Companys Phone Number:</label>
            <input type="number" name="CoPhoneNo" value="<?php echo $Companys_Phone_Number; ?>">
            <br><br>
            <label for="SupervisorID">Supervisor'S ID:</label>
            <input type="number" name="SupervisorID" value="<?php echo $Supervisors_ID; ?>">
            <br><br>
            <label for="SupName">Supervisor's Name:</label>
            <input type="text" name="SupName" value="<?php echo $Supervisors_Name; ?>">
            <br><br>
            <label for="CoName">Company's Name:</label>
            <input type="text" name="CoName" value="<?php echo $Companys_Name; ?>">
            <br><br>
            <label for="PharPhoneNo">Pharmacys Phone Number:</label>
            <input type="number" name="PharPhoneNo" value="<?php echo $Pharmacys_Phone_Number; ?>">
            <br><br>
            <label for="PharName">Pharmacys_Name:</label>
            <input type="text" name="PharName" value="<?php echo $Pharmacys_Name; ?>">
            <br><br>
            <label for="StartDate">Start Date:</label>
            <input type="date" name="DName" value="<?php echo $Doctors_Name; ?>">
            <br><br>
            <label for="EndDate">End Date:</label>
            <input type="date" name="EndDate" value="<?php echo $End_Date; ?>">
            <br><br>
            <label for="ContractsText">Contract's Text:</label>
            <input type="text" name="ContractsText" value="<?php echo $Contracts_Text; ?>">
            <br><br>
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Contract not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
