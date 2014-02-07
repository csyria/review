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
	foreach ($responses as &$response)	{
		$response = trim($response);
		$response = htmlspecialchars($response);
		$response = nl2br($response);
		$response = str_replace(array("\n", "\r"), "", $response);
		}
	
	$filenameDate = date("Y-m-d", strtotime($responses['date']));
	$filename = "$responses[employeeName] $filenameDate Review.csv";
	
	$csv = "";
	foreach($responses as $responseName => $responseValue) {
		$csv .= "$responseName" . ",\"" . "$responseValue" . "\"\n";
		}	
	
	$csv = base64_encode($csv);
		
	echo ("
	<div class=\"valid fade\">
		<h2>Your review looks good!</h2>
		<p>Please review it below, then click the link to download your review file. Simply email this file to your manager, and you're done!</p>
	</div>
	<div class=\"table\">");
	foreach($responses as $responseName => $responseValue) {
		echo ("<div class=\"row\">
			<div class=\"cell right\">$fieldNames[$responseName]</div>
			<div class=\"cell\">$responseValue</div>
			</div>");
		}
	echo ("</div>
	<div class=\"info\"><p>If you see anything you want to change, please click the back button in your browser.</p>
	<p>Otherwise, please click the button below to download your review. Save the file, then simply email it to your manager to finish this step of the review process.</p>
	
	<form action=\"download.php\" method=\"post\" target=\"_blank\">
	<input type=\"hidden\" name=\"filename\" value=\"$filename\" />
	<input type=\"hidden\" name=\"csv\" value=\"$csv\" />
	<p><input type=\"submit\" class=\"downloadButton\" value=\"Download\" /></p>
	</form>	
	</div>
	");
	}
 
 ?>