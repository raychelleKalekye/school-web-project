<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['SupervisorID'])) {
    $Supervisors_ID = $_GET['SupervisorID'];

  
    $sql = "SELECT * FROM supervisor WHERE SupervisorID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Supervisors_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Supervisors_ID=$row['SupervisorID'];
        $Supervisors_Name=$row['SupName'];
        $Contract_Id=$row['ContractId'];
        
        ?>
         <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="supupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name=" SupervisorID" value="<?php echo $Supervisors_ID; ?>">

            <label for="SupName">Supervisor's Name:</label>
            <input type="text" name="SupName" value="<?php echo $Supervisors_Name; ?>">
            <br><br>
            <label for="ContractId">Contract Id:</label>
            <input type="text" name="ContractId" value="<?php echo $Contract_Id; ?>">
            <br><br>
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Supervisor not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>