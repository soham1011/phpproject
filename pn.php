<?php
include("rpn.php");

function infixToPrefix($infix) {
    $infix = strrev($infix);
    $l = strlen($infix);

    for ($i = 0; $i < $l; $i++) {
        if ($infix[$i] == '(') {
            $infix[$i] = ')';
        } elseif ($infix[$i] == ')') {
            $infix[$i] = '(';
        }
    }

    $prefix = infixToPostfix($infix);
    return strrev($prefix);
}
?>
