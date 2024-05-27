<?php
function format_string($input): string
{

    $output = preg_replace("/[^a-zA-Z\s]+/", "", $input);

    $output = str_replace(" ", "", $output);

    $output = strtolower($output);

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
echo $output;


