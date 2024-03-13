<!DOCTYPE html>
<html>
<head>
    <title>DIAGNOSIS TABLE</title>
    <link rel="stylesheet" href="/project_work/html_tables/tables.css">
    <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>LIST OF DIAGNOSIS</h1>

    <br><br><hr><br><br>
    <a class="btn btn-primary" href="/project_work/html_forms/diagnosis.html">Add Diagnosis</a>
    <br><br>
    <table class="table1">
        <tr>
            <th>DiagnosisId</th>
            <th>Symptoms</th>
            <th>Diagnosis</th>
            <th>Patients SSN</th>
            <th>Patients First Name</th>
            <th>Patients Last Name</th>
            <th>Doctors SSN</th>
            <th>Doctors Name</th>
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
            $sql = "SELECT * FROM diagnosis";
            $result = $conn->query($sql);
            if (!$result) {
                die("Invalid query: " . $conn->error);
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='active-row'>";
                    echo "<td>" . $row["DiagnosisId"] . "</td>";
                    echo "<td>" . $row["Symptoms"] . "</td>";
                    echo "<td>" . $row["Diagnosis"] . "</td>";
                    echo "<td>" . $row["SSN"] . "</td>";
                    echo "<td>" . $row["Pfname"] . "</td>";
                    echo "<td>" . $row["Plname"] . "</td>";
                    echo "<td>" . $row["DSSN"] . "</td>";
                    echo "<td>" . $row["DName"] . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-primary btn-sm' href='/project_work/html_tables/diagedit.php?DiagnosisId=" . $row["DiagnosisId"] . "'>Edit</a>";
                    echo "<br><br>";
                    echo "<a class='btn btn-danger btn-sm' href='/project_work/html_tables/diagdelete.php?DiagnosisId=" . $row["DiagnosisId"] . "'>Delete</a>";
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
