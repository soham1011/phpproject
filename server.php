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

// Calculate the result using the RPN calculator class
$postfix = infixToPostfix($expression);
echo "Postfix expression: $postfix";

$prefix = infixToPrefix($expression);
echo "Prefix expression: $prefix";

$conn->close();
