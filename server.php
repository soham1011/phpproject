<?php
include("rpn.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Could not connect succesfully: " . $conn->connect_error);
} else {
    echo "connected succesfully<br>";
}

// Get the expression sent from the form
$expression = isset($_POST['infix-input']) ? $_POST['infix-input'] : '';

$exp_type = isset($_POST['exp-type']) ? $_POST['exp-type'] : '';

if ($exp_type == "RPN") {
    $postfix = infixToPostfix($expression);
    echo "Postfix expression: $postfix<br>";

    $posfixInsertion = <<<sql
    INSERT INTO Postfix (exp, postfix) VALUES ("$expression", "$postfix");
    sql;

    if ($conn->query($posfixInsertion) == TRUE) {
        echo "Data added bkl check karle<br>";
    } else {
        echo "Data not added bkl check karle<br>";
    }
} else if ($exp_type == "PN") {
    $prefix = infixToPrefix($expression);
    echo "Prefix expression: $prefix<br>";

    $prefixInsertion = <<<sql
    INSERT INTO Prefix (exp, prefix) VALUES ("$expression", "$prefix");
    sql;

    if ($conn->query($prefixInsertion) == TRUE) {
        echo "Data added bkl check karle<br>";
    } else {
        echo "Data not added bkl check karle<br>";
    }
} else {
    echo "TUM DEKHO BHAI APNA<br>";
    exit(0);
}

$conn->close();
