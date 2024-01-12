<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "OneVision";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    echo '<h1>not connect</h1>';
}

if(($_SERVER['REQUEST_METHOD'] == 'POST')){
    $tmp=$_POST['email'];
    $mail=strtoupper($tmp);
    $psd = $_POST['psd'];
    $sql = "SELECT * FROM `login` WHERE `EMAIL` LIKE '$mail'";
    $result = $conn->query($sql);
    if($result){
        $row = $result->fetch_assoc();
        $rowCount = $row['count'];
        if ($result->num_rows > 0){
            IF($psd == $row['PSD']){
                $_SESSION['mail']= $mail;
                if(isset($_SESSION['mail']))
                header('location:TEDT.php');
            }else{
                echo '<h4>password not match.</h4>';
            }
        }else{
            echo '<h4>Email not match.</h4>';
        }
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3><?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Name not set'; ?></h3>
</body>
</html>
