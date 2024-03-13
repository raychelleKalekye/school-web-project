<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['OrderId'])) {
    $Order_Id = $_GET['OrderId'];

    
    $sql = "SELECT * FROM orders WHERE OrderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Order_Id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Order_Id = $row['OrderId'];
        $Order_Date=$row['OrdDate'];
        $Pharmacys_Name=$row['PharName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
        $Trade_Name=$row['TradeName'];
        $Formula=$row['Formula'];
        $Quantity=$row['Quantity'];
        $Companys_Name=$row['CoName'];
        $Companys_Phone_Number=$row['CoPhoneNo'];

        ?>
        <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="ordupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name="OrderId" value="<?php echo $Order_Id; ?>">

            <label for="OrdDate">Order's Date:</label>
            <input type="date" name="OrdDate" value="<?php echo $Order_Date; ?>">
            <br><br>
            <label for="PharName">Pharmacy's Name:</label>
            <input type="text" name="PharName" value="<?php echo $Pharmacys_Name; ?>">
            <br><br>
            <label for="PharPhoneNo">Pharmacys Phone Number:</label>
            <input type="text" name="PharPhoneNo" value="<?php echo $Supervisors_Name; ?>">
            <br><br>
            <label for="TradeName">Trade Name:</label>
            <input type="text" name="TradeName" value="<?php echo $Trade_Name; ?>">
            <br><br>
            <label for="Formula">Formula:</label>
            <input type="text" name="Formula" value="<?php echo $Formula; ?>">
            <br><br>
            <label for="Quantity">Quantity:</label>
            <input type="number" name="Quantity" value="<?php echo $Quantity; ?>">
            <br><br>
            <label for="CoName">Company's Name:</label>
            <input type="text" name="CoName" value="<?php echo $Companys_Name; ?>">
            <br><br>
            <label for="CoPhoneNo">Company's Phone Number:</label>
            <input type="CoPhoneNo" name="CoPhoneNo" value="<?php echo $Companys_Phone_Number; ?>">
            <br><br>
          
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Order not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
