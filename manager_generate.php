<?php
// Parse POST-ed variables
$responses = $_POST['responses'];

// Let's do some error checking!
$errorCount = 0;
$errorText = "";

foreach($responses as $responseName => $responseValue) {
	if ($responseValue == "")	{
		$errorCount++;
		$errorText .= "$fieldNames[$responseName] was not answered.<br />";
		}
	}
	
if ($errorCount > 0)	{
	echo ("
	<div class=\"warning fade\">
		<h2>Errors were found in your review!</h2>
		<p>$errorText</p>
		<h2>Please use the back arrow on your browser to correct these issues, then submit again.</h2>
	</div>
	");
	}

else	{
	// Process and clean up the manager responses
	foreach ($responses as &$response)	{
		$response = trim($response);
		$response = htmlspecialchars($response);
		$response = nl2br($response);
		$response = str_replace(array("\n", "\r"), "", $response);
		}
		
	// Process and parse the submitted employee CSV
	$employeeResponses = csvToArray(base64_decode($_POST['employeeCsv']));
	
	// Merge the employee and the manager responses. We're going to dump the employee ones first, then the manager, so that if the manager changed any of the shared variables, they will be overwritten by the employee's responses
	$combinedResponses = array();
	foreach ($employeeResponses as $key => $value)	{
		$combinedResponses[$key] = $value;
		}
	foreach ($responses as $key => $value)	{
		$combinedResponses[$key] = $value;
		}
	
	$filenameDate = date("Y-m-d", strtotime($responses['date']));
	$filename = "$combinedResponses[employeeName] $filenameDate Completed Review.csv";
	
	$csv = "";
	foreach($combinedResponses as $responseName => $responseValue) {
		$csv .= "$responseName" . ",\"" . "$responseValue" . "\"\n";
		}	
	
	$csv = base64_encode($csv);
	
	echo ("
	<div class=\"valid fade\">
		<h2>Your review looks good!</h2>
		<p>Please review it below, then click the link to download and save the combined review file.</p>
	</div>
	<div class=\"table\">");
	foreach($responses as $responseName => $responseValue) { // Using $responses here instead of $combined responses because I don't want to expose employee responses yet. 
		echo ("<div class=\"row\">
			<div class=\"cell right\">$fieldNames[$responseName]</div>
			<div class=\"cell\">$responseValue</div>
			</div>");
		}
	echo ("</div>
	<div class=\"info\"><p>If you see anything you want to change, please click the back button in your browser.</p>
	<p>Otherwise, please click the link below to download and save the completed and combined review.</p>
	<form action=\"download.php\" method=\"post\" target=\"_blank\">
	<input type=\"hidden\" name=\"filename\" value=\"$filename\" />
	<input type=\"hidden\" name=\"csv\" value=\"$csv\" />
	<p><input type=\"submit\" class=\"downloadButton\" value=\"Download\" /></p>
	</form>	
	</div>
	
	<div class=\"info\"><p>After you have downloaded and saved the combined review, click below for a print-formatted report.</p>
	<form action=\"?step=3&amp;action=display\" method=\"post\">
	<input type=\"hidden\" name=\"csv\" value=\"$csv\" />
	<p><input type=\"submit\" class=\"reportButton\" value=\"Printable Report\" /></p>
	</form>	
	</div>
	");
	}

?>