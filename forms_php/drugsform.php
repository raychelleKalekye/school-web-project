<?php
$servername="localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";

try{
    $mysqli=new mysqli($servername,$username,$password,$database);
    if($mysqli->connect_error){
        throw new Exception("Connection failed: ". $mysqli->connect_error);
    }
    else{
        echo "Connection successful"."<br>";
    }
    if(isset($_POST['btn'])){
        $file=addslashes(file_get_contents($_FILES['drg_img']['tmp_name']));
        $TradeName=$_POST['TradeName'];
        $Formula=$_POST['Formula'];
        $Category=$_POST['Category'];

        $query="INSERT INTO drugs(TradeName,Category,Formula,drg_img) VALUES('$TradeName','$Category','$Formula','$file')";
        $query_run=mysqli_query($mysqli,$query);

        if($query_run){
            echo '<script type="text/javascript">alert("Image Profile Uploaded")</script>';

        }else{
            throw new Exception("Image Profile Not Uploaded: " .$mysqli->error);

        }

    }
    
}catch(Exception $e){
echo '<script type="text/javascript">alert("Error: '. $e->getMessage().'")</script>';
}
?>

