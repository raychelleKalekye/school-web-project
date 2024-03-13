<!DOCTYPE html>
<html>
    <head>
     <title>DRUGS DISPLAY</title>
     <link href="/project_work/drug_menu/drugs.css" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Bacasime+Antique&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <form action="" method="POST" enctype="multipart/form-data">

            <h2>ANTIBACTERIALS DISPLAY</h2>
            <br><br>
            <table>
                <tr>
                    <th>IMAGE OF DRUG</th>
                    <th></th>
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
                $query="SELECT drg_img,TradeName FROM drugs WHERE Category='Antibacterial'";
                $query_run=mysqli_query($conn,$query);
                while($row=mysqli_fetch_array($query_run)){
                ?>
                    <tr>
                   
                        <td>
                            <?php echo '<img src="data:image;base64,' . base64_encode($row['drg_img']) .'" alt="Image" style="width:100px; height:100px;"> ';?>
                        </td>   
                        <td> 
                          <?php echo "<a class='btn btn-danger btn-sm' href='/project_work/drug_menu/viewdetails.php?TradeName=" . $row["TradeName"] . "'>View Details</a>";?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </form>
    </body>
</html>




