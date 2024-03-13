<?php
$servername="localhost";
$username="root";
$password="";
$database="drug_dispensing_tool";


$conn=new mysqli($servername,$username,$password,$database);
if ($conn ->connect_error){
    die("Connection failed: " . $conn->connect_error);
}else{
echo "Connected successfully";}
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $first_name=$_POST["Pfname"];
    $last_name=$_POST["Plname"];
    $SSN=$_POST["id"];
    $Gender=$_POST["gender"];
    $Address=$_POST["Address"];
    $YearofBirth=$_POST["YearofBirth"];
    $email=$_POST["email"];
}
$sql="INSERT INTO patient(Pfname,Plname,SSN,YearofBirth,Gender,LAddress,email)VALUES(?,?,?,?,?,?,?)";
$stmt=$conn->prepare($sql);

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssissss", $first_name, $last_name, $SSN, $YearofBirth, $Gender, $Address, $email);


$stmt->execute();
if ($conn->affected_rows > 0) {
    echo "Data saved successfully.";
} else {
    echo "Error: Data was not saved.";
}
$stmt->close();








