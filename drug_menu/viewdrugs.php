<!DOCTYPE html>
<html>
    <head>
     <title>DRUGS DISPLAY</title>
     <link rel="stylesheet" href="project_work/html_tables/tables.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <form action="" method="POST" enctype="multipart/form-data">

            <h2>DRUGS DISPLAY</h2>
            <br><br>
            <table>
                <tr>
                    <th>TRADE NAME</th>
                    <th>FORMULA</th>
                    <th>CATEGORY</th>
                    <th>IMAGE OF DRUG</th>
                </tr>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "drug_dispensing_tool";
    
                $conn = new mysqli($servername, $username, $password, $database);
                if ($conn->connect_error) {
                    die("Connection error failed: " . $conn->connect_error);
                } 
                $query="SELECT * FROM drugs ";
                $query_run=mysqli_query($conn,$query);
                while($row=mysqli_fetch_array($query_run)){
                ?>
                    <tr>
                        <td>
                            <?php echo $row['TradeName'];?>
                        </td>
                        <td>
                            <?php echo $row['Formula'];?>
                        </td>
                        <td>
                            <?php echo $row['Category'];?>
                        </td>
                        <td>
                            <?php echo '<img src="data:image;base64,' . base64_encode($row['drg_img']) .'" alt="Image" style="width:100px; height:100px;"> ';?>
                        </td>   
                    </tr>
                <?php
                }
                ?>
            </table>
        </form>
    </body>
</html>



