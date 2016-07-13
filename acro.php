<?php

require 'vendor/autoload.php';

if(isset($_POST['acro'])) {


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

        $req = $_POST['acro']; // required
	echo "<br />Requested Acronym:";
	echo $req;

	$req = "'sf': $req";  // build request string for short format acronym

        $client = new GuzzleHttp\Client();    // init Guzzle client
        $acros = $client->get('http://www.nactem.ac.uk/software/acromine/dictionary.py', [urlencode($req)]); // submit encoded request to the Acromine API

        // echo "<br />Response Code:<br />";
	// echo $acros->getStatusCode();                    // expect response 200
        // echo "<br />Encoding:<br />";
	// echo $acros->getHeader('content-type');                // 'application/json; charset=utf-8'
        echo "<br /><br />Long Forms and Frequencies: <br />";
	$stream = $acros->getBody();                         // sf lf
	echo (string) $stream->getContents();
        // echo (string) json_decode($stream->getContents(), true);                     // Output the JSON decoded data
?>
        <!-- Closing Remark -->
        <br /><br /> Thanks for using this simple Acromine client by Josh Pelz!

<?php

}

?>
