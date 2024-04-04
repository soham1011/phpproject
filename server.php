<?php
include("connection.php");

// Get the expression sent from the form
$expression = isset($_POST['infix-input']) ? $_POST['infix-input'] : '';

$exp_type = isset($_POST['exp-type']) ? $_POST['exp-type'] : '';

if ($exp_type == "RPN") {
    include("rpn.php");

    $postfix = infixToPostfix($expression);
    echo "Postfix expression: $postfix<br>";

    $postfixInsertion = <<<sql
    INSERT INTO Postfix (exp, postfix) VALUES ("$expression", "$postfix");
    sql;

    if ($conn->query($postfixInsertion) == TRUE) {
        echo "Data added to the database<br>";
    } else {
        echo "Data not added to the database<br>";
    }
} else if ($exp_type == "PN") {
    include("pn.php");

    $prefix = infixToPrefix($expression);
    echo "Prefix expression: $prefix<br>";

    $prefixInsertion = <<<sql
    INSERT INTO Prefix (exp, prefix) VALUES ("$expression", "$prefix");
    sql;

    if ($conn->query($prefixInsertion) == TRUE) {
        echo "Data added to the database<br>";
    } else {
        echo "Data not added to the database<br>";
    }
} else {
    echo __LINE__ . " [ERROR] Unhandled expression type: $exp_type<br>";
    exit(0);
}

$conn->close();
