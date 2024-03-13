<!DOCTYPE html>
<html>
<head>
    <title> PHARMACISTS' TABLE</title>
    <link rel="stylesheet" href="/project_work/html_tables/tables.css">
    <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>LIST OF PHARMACISTS</h1>

    <br><br><hr><br><br>
    <a class="btn btn-primary" href="/project_work/html_forms/pharmacist.html">Add Pharmacist</a>
    <br><br>
    <table class="table1">
        <tr>
        <th>Pharmacist SSN</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Pharmacy</th>
         <th>Pharmacys' Phone Number</th>
         <th>Operation</th>
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
            $sql = "SELECT * FROM pharmacist";
            $result = $conn->query($sql);
            if (!$result) {
                die("Invalid query: " . $conn->error);
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='active-row'>";
                    echo "<td>" . $row["PharSSN"] . "</td>";
                    echo "<td>" . $row["Pharfname"] . "</td>";
                    echo "<td>" . $row["Pharlname"] . "</td>";
                    echo "<td>" . $row["PharName"] . "</td>";
                    echo "<td>" . $row["PharPhoneNo"] . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-primary btn-sm' href='/project_work/html_tables/phartedit.php?PharSSN=" . $row["PharSSN"] . "'>Edit</a>";
                    echo "<br><br>";
                    echo "<a class='btn btn-danger btn-sm' href='/project_work/html_tables/phartdelete.php?PharSSN=" . $row["PharSSN"] . "'>Delete</a>";
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
