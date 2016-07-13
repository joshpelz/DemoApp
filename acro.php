<?php

require 'vendor/autoload.php';

function failed($error) {
        // custom error code
        echo "The request was not a valid acronym, or no results were found.";
        echo "Error output:";
        echo $error."<br /><br /><br />";
        die();
}

if(!isset($_POST['acro'])) {
	 failed('No valid acronym was submitted, perhaps the field was left blank!');
}

$acro = $_POST['acro']; // required

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.nactem.ac.uk/software/acromine/dictionary.py');
curl_setopt($ch, CURLOPT_POSTFIELDS, array('sf' => $acro));
$result = curl_exec($ch);
curl_close($ch);
echo indent($result);
$output = json_decode($result, true);
// print_r($output, true);;
echo (string) json_decode($output);                     // Output the JSON tidy data
?>
        <!-- Closing Remarks -->
        <br /><br /> Thanks for using this simple Acromine client by Josh Pelz!

