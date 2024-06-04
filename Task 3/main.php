<?php
function format_string($input): string
{
    // Видаліть неалфавітні символи, за винятком пробілів
    $output = preg_replace("/[^a-zA-Z\s]+/", "", $input);

    // Видаліть не алфавітні символи, завинятком пробілів
    $output = str_replace(" ", "", $output);

    // Перетворення на малі літери
    $output = strtolower($output);

    // Альтернативний регістр кожного символу
    $result = '';
    $upper = true;
    for ($i = 0; $i < strlen($output); $i++) {
        if ($upper) {
            $result.= strtoupper($output[$i]);
        } else {
            $result.= strtolower($output[$i]);
        }
        $upper =!$upper;
    }

    return $result;
}

$input = "This is a test! 123, ABC";
$output = format_string($input);
echo $output; // Output: "TiIs Is A A"


