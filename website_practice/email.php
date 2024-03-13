<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Fname = $_POST['Fname'];
  $Lname=$_POST['Lname'];
  $Email = $_POST['Email'];
  $Subject = $_POST['Subject'];
  $Message = $_POST['Message'];

  $to = "rayleneinquiries@gmail.com";
  $headers = "From: $Fname .$Lname <$Email>";

  if (mail($to, $Subject, $Message, $headers)) {
    echo "Email sent successfully!";
  } else {
    echo "Error sending email.";
  }
}
?>
