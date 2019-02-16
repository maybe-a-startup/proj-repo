<?php  

$name = $_POST["name"];
$contact = $_POST["contact"];
$problem = $_POST["problem"];


$dbname = "heroku_a7f9004cbb1ca7e";
$servername = "us-cdbr-iron-east-03.cleardb.net";
$username = "bbe307749f3e91";
$password = "737de82a";

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "INSERT INTO new_table (name, contact, problem) VALUES ('$name','$contact','$problem')";

if ($conn->query($sql) === TRUE) {
    header('Location: hover_text.html'); 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>