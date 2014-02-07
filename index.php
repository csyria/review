<?php

error_reporting(E_ALL ^ E_NOTICE);

$step = $_GET['step'];
$action = $_GET['action'];

// Common functions and constants
$date = date("m/d/Y");
$date2 = date("Y-m-d");

function csvToArray($csv)	{
	$responses = array();
	$responseLines = explode("\n", trim($csv)); // break out the CSV key/pairs into an array of lines
	foreach ($responseLines as $responseLine)	{
		$responsePair = explode(",", $responseLine, 2); // split the lines into a key and a value string
		$key = $responsePair[0];
		$value = substr($responsePair[1], 1, strlen($responsePair[1])-2); // remove the quotes from around the value
		$responses["$key"] = $value; // store it in a nice associative array
		}
	return $responses;
	}
	
$fieldNames = array(
	'managerName' => "Manager Name",
	'position' => "Position",
	'employeeName' => "Employee Name",
	'department' => "Department",
	'date' => "Date",
	'teamworkScoreEmployee' => "Teamwork Score",
	'initiativeScoreEmployee' => "Initiative Score",
	'qualityScoreEmployee' => "Quality Score",
	'communicationScoreEmployee' => "Communication Score",
	'knowledgeScoreEmployee' => "Knowledge Score",
	'teamworkScoreManager' => "Teamwork Score (Manager)",
	'initiativeScoreManager' => "Initiative Score (Manager)",
	'qualityScoreManager' => "Quality Score (Manager)",
	'communicationScoreManager' => "Communication Score (Manager)",
	'knowledgeScoreManager' => "Knowledge Score (Manager)",
	'openQuestion1' => "Open Question 1",
	'openQuestion2' => "Open Question 2",
	'openQuestion3' => "Open Question 3",
	'openQuestion4' => "Open Question 4",
	'openQuestion5' => "Open Question 5",
	'openQuestion6' => "Open Question 6",
	'feedback' => "Comments and feedback for the employee",
	'goals' => "Goals and feedback for the employee",
	);

// Output section
echo ("
<!doctype html>
<html lang=\"en\">
<head>
<meta charset=\"utf-8\">
<title>Innflux Employee Evaluation From</title>
<link rel=\"stylesheet\" href=\"css/ui-darkness/jquery-ui-1.10.4.custom.css\" />
<link rel=\"stylesheet\" href=\"css/stylesheet.css\" media=\"screen\" />
<link rel=\"stylesheet\" href=\"css/stylesheet_print.css\" media=\"print\" />
<script src=\"js/jquery-2.0.3.js\"></script>
<script src=\"js/jquery-ui-1.10.4.custom.js\"></script>

<script>
$(function() {
	$( \"#date\" ).datepicker();
	$( \"#anim\" ).change(function() {
		$( \"#date\" ).datepicker( \"option\", \"showAnim\", $( this ).val() );
		});
	});
	$(function() {
		var managerNames = [
		\"Chris Drinkall\",
		\"Chris Wieland\",
		\"Jeremiah Carscadden\",
		\"Mike Grabenstein\",
		\"Brian O'Connor\"
		];
	$( \"#managerName\" ).autocomplete({
			source: managerNames
			});
		});
	$(function() {
		$( \"#accordion\" ).accordion({
			heightStyle: \"content\"
			});
		});
	$(document).ready(function()	{
		$(\".fade\").hide(0).delay(200).fadeIn(500)
		});
</script>


</head>

<body>
<div id=\"container\">
<div id=\"header\">
	<span id=\"headerLogo\"><a href=\"?\"><img src=\"images/innflux_logo.png\" alt=\"Innflux Logo\" /></a></span>
	<span id=\"headerText\">Employee Evaluation Form</span>
</div>
<div id=\"content\">
");

if ($step == 1)	{
	if ($action == "generate")	{
		include("employee_generate.php");
		}
	else	{
		include("employee_evaluate.php");
		}
	}
elseif ($step == 2)	{
	if ($action == "evaluate")	{
		include("manager_evaluate.php");
		}
	elseif ($action == "generate")	{
		include("manager_generate.php");
		}
	else	{
		include("manager_upload.php");
		}
	}
elseif ($step == 3)	{
	if ($action == "display")	{
		include("print_display.php");
		}
	else	{
		include("print_upload.php");
		}
	}
elseif ($step == "test")	{
	include("test.php");
	}
else	{
	include("entry.php");
	}
	
echo ("
</div>
</div>
</body>
</html>
");