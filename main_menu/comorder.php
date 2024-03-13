<!DOCTYPE html>
<html>
<head>
    <title> ORDERS TABLE</title>
    <link rel="stylesheet" href="/project_work/html_tables/tables.css">
    <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1>LIST OF ORDERS</h1>

    <br><br><hr><br><br>
    <a class="btn btn-primary" href="/project_work/main_menu/companymenu.html">BACK TO MAIN MENU</a>
    <br><br>
    <table class="table1">
        <tr>
        <th>Order ID</th>
            <th>Order's Date</th>
            <th>Pharmacy's Name</th>
            <th>Pharmacys's Phone Number</th>
            <th>Trade Name</th>
            <th>Formula</th>
            <th>Quantity</th>
          
    
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
            $sql = "SELECT OrderId,OrdDate,PharName,PharPhoneNo,TradeName,Formula,Quantity FROM orders where CoPhoneNo=?";
            $result = $conn->query($sql);
            if (!$result) {
                die("Invalid query: " . $conn->error);
            } else {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='active-row'>";
                    echo "<td>" . $row["OrderId"] . "</td>";
                    echo "<td>" . $row["OrdDate"] . "</td>";
                    echo "<td>" . $row["PharName"] . "</td>";
                    echo "<td>" . $row["PharPhoneNo"] . "</td>";
                    echo "<td>" . $row["TradeName"] . "</td>";
                    echo "<td>" . $row["Formula"] . "</td>";
                    echo "<td>" . $row["Quantity"] . "</td>";
                  
                    
                
                    echo "</tr>";
                }
            }
            $conn->close();
        }
        ?>
    </table>
</body>
</html>
