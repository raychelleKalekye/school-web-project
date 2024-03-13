<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "drug_dispensing_tool";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['TradeName'])) {
    $Trade_Name = $_GET['TradeName'];

    // Retrieve the diagnosis information
    $sql = "SELECT * FROM drugs WHERE TradeName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Trade_Name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $Trade_Name=$row['TradeName'];
        $Formula=$row['Formula'];
        $Category=$row['Category'];
        $Drug_img=$row['drg_img'];
       
       

        // Display the update form
        ?>
         <title><link rel=stylesheet href="/project_work_html_forms/forms.css"></title>
        <form class=form1 action="drugupdate.php" method="POST">
            
            <h2>UPDATE RECORD</h2>
            <br><br>
            <input type="hidden" name=" TradeName" value="<?php echo $Trade_Name; ?>">

            <label for="Formula">Formula:</label>
            <input type="text" name="Formula" value="<?php echo $Formula; ?>">
            <br><br>
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
            <label for="drg_img">IMAGE OF DRUG</label>
            <input type="file" id="drg_img" name="drg_img">
            
            
            <br><br>
            
            <input type="submit" value="Update">
        </form>
        <?php
    } else {
        echo "Drug not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
