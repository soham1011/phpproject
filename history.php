<?php
include("connection.php");

$history = $conn->query("SELECT * FROM Postfix;");
# $exp_type = isset($_POST['exp-type']) ? $_POST['exp-type'] : '';

echo "History:<br>";

echo "Postfix:<br>";
if ($history->num_rows > 0) {
    while ($row = $history->fetch_assoc()) {
        echo "Expression: " . $row["exp"] . " Postfix: " . $row["postfix"] . "<br>";
    }
} else {
    echo "No data yet<br>";
}

$history = $conn->query("SELECT * FROM Prefix;");
echo "Prefix:<br>";

if ($history->num_rows > 0) {
    while ($row = $history->fetch_assoc()) {
        echo "Expression: " . $row["exp"] . " Prefix: " . $row["prefix"] . "<br>";
    }
} else {
    echo "No data yet<br>";
}

echo "<br>";
