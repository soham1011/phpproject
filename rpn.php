<?php
function getPrecedence($operator)
{
    switch ($operator) {
        case '+':
        case '-':
            return 1;
        case '*':
        case '/':
            return 2;
        case '^':
            return 3;
        default:
            return 0;
    }
}

function infixToPostfix($infix)
{
    $stack = [];
    $postfix = '';

    for ($i = 0; $i < strlen($infix); $i++) {
        $char = $infix[$i];

        if (ctype_alnum($char)) {
            $postfix .= $char;
        } elseif ($char == '(') {
            array_push($stack, $char);
        } elseif ($char == ')') {
            while (end($stack) != '(') {
                $postfix .= array_pop($stack);
            }
            array_pop($stack);
        } else {
            while (
                !empty($stack)
                && getPrecedence(end($stack))
                >= getPrecedence($char)
            ) {
                $postfix .= array_pop($stack);
            }
            array_push($stack, $char);
        }
    }

    while (!empty($stack)) {
        $postfix .= array_pop($stack);
    }

    return $postfix;
}
