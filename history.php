<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Could not connect succesfully: " . $conn->connect_error);
}

$history = $conn->query("SELECT * FROM Postfix;");
# $exp_type = isset($_POST['exp-type']) ? $_POST['exp-type'] : '';

echo "History:<br>";


if ($history->num_rows > 0) {
    // output data of each row
    while ($row = $history->fetch_assoc()) {
        echo "Expression: " . $row["exp"] . " Postfix: " . $row["postfix"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

$history = $conn->query("SELECT * FROM Prefix;");
echo "Prefix:<br>";

if ($history->num_rows > 0) {
    // output data of each row
    while ($row = $history->fetch_assoc()) {
        echo "Expression: " . $row["exp"] . " Prefix: " . $row["prefix"] . "<br>";
    }
} else {
    echo "0 results<br>";
}

echo "<br>";
