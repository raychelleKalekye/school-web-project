<!DOCTYPE html>
<html>
<head>
    <title> INSURANCE TABLE</title>
    <link rel="stylesheet" href="/project_work/html_tables/tables.css">
    <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>LIST OF PATIENTS WITH INSURANCE</h1>

    <br><br><hr><br><br>
    <a class="btn btn-primary" href="/project_work/html_forms/insurance.html">Add INSURANCE</a>
    <br><br>
    <table class="table1">
        <tr>
        <th>Insurance Number</th>
         <th>Insurance Company</th>
         <th>Patient's First Name</th>
         <th>Patient's Last name</th>
         <th>Percent Deducted</th>
         <th>Patient's SSN</th>
         <th>Operations</th>
        </tr>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "drug_dispensing_tool";

        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "SELECT * FROM insurance";
            $result = $conn->query($sql);
            if (!$result) {
                die("Invalid query: " . $conn->error);
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='active-row'>";
                    echo "<td>" . $row["insuranceNo"] . "</td>";
                    echo "<td>" . $row["InsuranceCo"] . "</td>";
                    echo "<td>" . $row["Pfname"] . "</td>";
                    echo "<td>" . $row["Plname"] . "</td>";
                    echo "<td>" . $row["PercentDeducted"] . "</td>";
                    echo "<td>" . $row["SSN"] . "</td>";
                
                    echo "<td>";
                    echo "<a class='btn btn-primary btn-sm' href='/project_work/html_tables/insuedit.php?insuranceNo=" . $row["insuranceNo"] . "'>Edit</a>";
                    echo "<br><br>";
                    echo "<a class='btn btn-danger btn-sm' href='/project_work/html_tables/insudelete.php?insuranceNo=" . $row["insuranceNo"] . "'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            $conn->close();
        }
        ?>
    </table>
</body>
</html>
