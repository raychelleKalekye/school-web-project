<!DOCTYPE html>
<html>
<head>
    <title>DRUGS DETAILS</title>
    <link rel="stylesheet" href="/project_work/html_tables/tables.css">
    <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>DRUG'S DETAILS</h1>

    <br><br><hr><br><br>
    <a class="btn btn-primary" href="/project_work/drug_menu/main.html">BACK TO MAIN MENU</a>
    <br><br>
    <table class="table1">
        <tr>
         <th>Trade Name</th>
         <th>Formula</th>
         <th> Category</th>
         <th>Image</th>
        
         
        </tr>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "drug_dispensing_tool";


         if (isset($_GET['TradeName'])) {
            $tradeName = $_GET['TradeName'];

            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $sql = "SELECT * FROM drugs WHERE TradeName=?";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("s", $tradeName);
                    $stmt->execute();

                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='active-row'>";
                        echo "<td>" . $row["TradeName"] . "</td>";
                        echo "<td>" . $row["Formula"] . "</td>";
                        echo "<td>" . $row["Category"] . "</td>";
                        
                        echo '<img src="data:image;base64,' . base64_encode($row['drg_img']) .'" alt="Image" style="width:100px; height:100px;"> ';
                        echo "</tr>";
                    }

                    $stmt->close();
                } else {
                    die("Error in preparing the statement: " . $conn->error);
                }

                $conn->close();
            }
        } else {
            echo "TradeName parameter is missing.";
        }
        ?>
    </table>
</body>
</html>