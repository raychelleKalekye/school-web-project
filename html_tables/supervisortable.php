<!DOCTYPE html>
<html>
<head>
    <title>SUPEERVISOR TABLE</title>
    <link rel="stylesheet" href="/project_work/html_tables/tables.css">
    <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>LIST OF SUPERVISORS</h1>

    <br><br><hr><br><br>
    <a class="btn btn-primary" href="/project_work/html_forms/supervisor.html">Add Supervisor</a>
    <br><br>
    <table class="table1">
        <tr>
        <th>Supervisor's Name</th>
         <th>Supervisor's ID</th>
         <th> Contract Id</th>
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
            $sql = "SELECT * FROM supervisor";
            $result = $conn->query($sql);
            if (!$result) {
                die("Invalid query: " . $conn->error);
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='active-row'>";
                    echo "<td>" . $row["SupervisorID"] . "</td>";
                    echo "<td>" . $row["SupName"] . "</td>";
                    echo "<td>" . $row["ContractId"] . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-primary btn-sm' href='/project_work/html_tables/supedit.php?SuoervisorID=" . $row["SupervisorID"] . "'>Edit</a>";
                    echo "<br><br>";
                    echo "<a class='btn btn-danger btn-sm' href='/project_work/html_tables/supandelete.php?SupervisorID=" . $row["SupervisorID"] . "'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            $conn->close();
        }
        ?>
    </table>
</body>