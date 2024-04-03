<?php
function isOperator($c) {
    return (!ctype_alpha($c) && !ctype_digit($c));
}

function getPriority($c) {
    if ($c == '-' || $c == '+') {
        return 1;
    } elseif ($c == '*' || $c == '/') {
        return 2;
    } elseif ($c == '^') {
        return 3;
    }
    return 0;
}

function infixToPostfix($infix) {
    $infix = '(' . $infix . ')';
    $l = strlen($infix);
    $char_stack = [];
    $output = "";

    for ($i = 0; $i < $l; $i++) {
        if (ctype_alpha($infix[$i]) || ctype_digit($infix[$i])) {
            $output .= $infix[$i];
        } elseif ($infix[$i] == '(') {
            array_push($char_stack, $infix[$i]);
        } elseif ($infix[$i] == ')') {
            while ($char_stack[count($char_stack) - 1] != '(') {
                $output .= array_pop($char_stack);
            }
            array_pop($char_stack);
        } else {
            if (isOperator($char_stack[count($char_stack) - 1])) {
                if ($infix[$i] == '^') {
                    while (getPriority($infix[$i]) <= getPriority($char_stack[count($char_stack) - 1])) {
                        $output .= array_pop($char_stack);
                    }
                } else {
                    while (getPriority($infix[$i]) < getPriority($char_stack[count($char_stack) - 1])) {
                        $output .= array_pop($char_stack);
                    }
                }
                array_push($char_stack, $infix[$i]);
            }
        }
    }

    while (count($char_stack) != 0) {
        $output .= array_pop($char_stack);
    }

    return $output;
}

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
    $prefix = strrev($prefix);

    return $prefix;
}
?>
