<!DOCTYPE html>
<html>
<head>
    <title>COMPANY TABLE</title>
    <link rel="stylesheet" href="/project_work/html_tables/tables.css">
    <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>LIST OF PHARMACIES</h1>

    <br><br><hr><br><br>
    <a class="btn btn-primary" href="/project_work/html_forms/Phharmacy.html">Add Pharmacy</a>
    <br><br>
    <table class="table1">
        <tr>
        <th>Pharmacy's Name</th>
         <th>Phone Number</th>
         <th>Location</th>
         
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
            $sql = "SELECT * FROM pharmacy";
            $result = $conn->query($sql);
            if (!$result) {
                die("Invalid query: " . $conn->error);
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='active-row'>";
                    echo "<td>" . $row["PharPhoneNo"] . "</td>";
                    echo "<td>" . $row["PharName"] . "</td>";
                    echo "<td>" . $row["LoAddress"] . "</td>";
                    
                    echo "<td>";
                    echo "<a class='btn btn-primary btn-sm' href='/project_work/html_tables/pharedit.php?PharPhoneNo=" . $row["PharPhoneNo"] . "'>Edit</a>";
                    echo "<br><br>";
                    echo "<a class='btn btn-danger btn-sm' href='/project_work/html_tables/phardelete.php?PharPhoneNo=" . $row["PharPhoneNo"] . "'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            $conn->close();
        }
        ?>
    </table>
</body>