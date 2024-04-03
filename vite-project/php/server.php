<?php
// Allow requests from specific origin
header('Access-Control-Allow-Origin: http://localhost:5173');

// Set the content type to JSON
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sohamxD";


$conn = new mysqli( $servername, $username, $password, $dbname );

if($conn->connect_error){
    die("". $conn->connect_error);
}
else{
    echo"connected succesfully";
}

// Define the RPN class
class RPN
{
    // Define a static variable to store the pattern
    public static $pattern;

    // Define the Calculate method
    public static function Calculate($pattern)
    {
        // Initialize variables
        $numbers = [];
        $calculationResult = null;

        // Split the pattern into an array of tokens
        $pattern_array = explode(' ', str_replace("  ", " ", trim($pattern)));
        $acceptable_operators = array("+", "-", "/", "*");

        // Check for errors in the input pattern
        if (count($pattern_array) == 1) {
            return 'single character put'; // Return error code for single-character input
        } elseif (!in_array(end($pattern_array), $acceptable_operators)) {
            return 'missing operator at the end'; // Return error code for missing operator at the end
        }

        // Establish database connection
        

        // Check connection
       

        // Iterate over the tokens in the pattern array
        foreach ($pattern_array as $value) {
            if (is_numeric($value)) {
                $numbers[] = $value; // Push numbers onto the stack
            } elseif (in_array($value, $acceptable_operators)) {
                $first_number = array_pop($numbers); // Pop the first number from the stack
                $second_number = array_pop($numbers); // Pop the second number from the stack

                // Perform the calculation based on the operator
                switch ($value) {
                    case '+':
                        $calculationResult = $second_number + $first_number;
                        break;
                    case '-':
                        $calculationResult = $second_number - $first_number;
                        break;
                    case '/':
                        $calculationResult = $second_number / $first_number;
                        break;
                    case '*':
                        $calculationResult = $second_number * $first_number;
                        break;
                }

                // Push the result onto the stack
                array_push($numbers, $calculationResult);
            } else {
                return -3; // Return error code for invalid character
            }
        }

        // Close the database connection
       

        // Return the calculation result
        return $calculationResult;
    }
}

// Get the expression sent from the form
$expression = isset($_POST['maroti']) ? $_POST['maroti'] : '';

// Calculate the result using the RPN calculator class
$result = RPN::Calculate($expression);

// Return the result as JSON
echo json_encode(['result' => $result]);
?>
