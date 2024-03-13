<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['InventoryID'])) {
    $Inventory_ID = $_GET['InventoryID'];

    
    $sql = "SELECT * FROM inventory WHERE InventoryID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Inventory_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Inventory_ID = $row['InventoryID'];
        $Category=$row['Category'];
        $Trade_Name=$row['TradeName'];
        $Formula=$row['Formula'];
        $Quantity=$row['Quantity'];
        $Pharmacys_Name=$row['PharName'];
        $Pharmacys_Phone_Number=$row['PharPhoneNo'];
       

        ?>
        <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="inveupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name="InventoryID" value="<?php echo $Inventory_ID; ?>">

            <label for="TradeName">Trade Name:</label>
            <input type="text" name="TradeName" value="<?php echo $Trade_Name; ?>">
            <br><br>
            <label for="Formula">Formula:</label>
            <input type="text" name="Formula" value="<?php echo $Formula; ?>">
            <br><br>
            <label for="Category">CATEGORY OF DRUG</label>
            <select id="Category" name="Category">
                <option value="Stimulant">Stimulant</option>
                
                <option value="Antifungal">Antifungal</option>
                <option value="Supplements">Supplements</option>
                <option value="Antiemetic">Antiemetic</option>
                <option value="Psychotropic">Psychotropic</option>
                <option value="Cardiovascular">Cardiovascular</option>
                <option value="Antiviral">Antiviral</option>
                <option value="Antibacterial">Antibacterial</option>

            </select>
            <br><br>
            <label for="Quantity">Quantity:</label>
            <input type="number" name="Quantity" value="<?php echo $Quantity; ?>">
            <br><br>
            <label for="PharName">Pharmacy's Name:</label>
            <input type="text" name="PharName" value="<?php echo $Pharmacys_Name; ?>">
            <br><br>
            <label for="PharPhoneNo">Pharmacys Phone Number:</label>
            <input type="number" name="PharPhoneNo" value="<?php echo $Pharmacys_Phone_Number; ?>">
            <br><br>
           
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Inventory  not found.";
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
