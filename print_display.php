<?php
if ($_POST['csv'])	{ // Yay, this was called from manager_generate, so we don't have to parse an uploaded file
	$responses = csvToArray(base64_decode($_POST['csv']));
	}
	
elseif($_FILES['csvUpload'])	{ // Need to parse the upload
	// Make sure the user actually did upload something
	if ($_FILES["csvUpload"]["error"] == 4)	{
		echo ("<div class=\"warning fade\">
		<p>It appears you didn't select a file to upload. Please <a href=\"?step=3\">go back</a> and try again.</p>
		</div>");
		exit();
		}
		
	// Do some checking on that uploaded file
	if (!isset($_FILES['csvUpload']['error']) || is_array($_FILES['csvUpload']['error']))	{
		echo ("<div class=\"warning fade\">
		<p>There seems to be a problem with the file you uploaded. Please <a href=\"?step=3\">go back</a> and try again.</p>
		</div>");
		exit();
		}
		
	if ($_FILES["csvUpload"]["error"] > 0)	{
		echo ("<div class=\"warning fade\">
		<p>There was an error with the file uploaded. Please report this error, with the error code below, to an administrator.</p>
		<p>Error code: " . $_FILES["csvUpload"]["error"] . "</p>
		</div>");
		exit();
		}
		
	if ($_FILES["csvUpload"]["type"] != "text/csv" && $_FILES["csvUpload"]["type"] != "application/vnd.ms-excel")	{
		echo ("<div class=\"warning fade\">
		<p>It looks like you didn't upload a valid fade employee evaluation CSV file. Please <a href=\"?step=3\">go back</a> and try again.</p>
		</div>");
		exit();	
		}
	
	// If it passes all this, we can start working with the CSV file. 
	// Note: I'm not doing more verification on the file because it's not really necessary. We're not executing anything from the uploaded file, and this is an internal use only tool.
	// I think it's fair to hope our employees won't hack us on this. 
	$csvUploadString = file_get_contents($_FILES["csvUpload"]["tmp_name"]);
	
	// Let's break out the employee responses CSV into our own little array, so that we can use a couple of them, like the name and position
	$responses = csvToArray($csvUploadString);
	}

else	{ // User shouldn't be here
	echo ("<div class=\"warning fade\">
	<p>It appears you didn't select a file to upload. Please <a href=\"?step=3\">go back</a> and try again.</p>
	</div>");
	exit();
	}

//Calculate the totals for display
$employeeScoreTotal = $responses['teamworkScoreEmployee'] + $responses['initiativeScoreEmployee'] + $responses['qualityScoreEmployee'] + $responses['communicationScoreEmployee'] + $responses['knowledgeScoreEmployee'];
$employeeScorePercent = ($employeeScoreTotal / 25) * 100;
$managerScoreTotal = $responses['teamworkScoreManager'] + $responses['initiativeScoreManager'] + $responses['qualityScoreManager'] + $responses['communicationScoreManager'] + $responses['knowledgeScoreManager'];
$managerScorePercent = ($managerScoreTotal / 25) * 100;

?>
<div class="content">
<form>
<input type="button" class="printButton noPrint" value="Print" onClick="window.print()">
</form>
</div>

<div class="table">
	<div class="row">
		<div class="cell right">Manager Name</div>
		<div class="cell"><?php echo($responses['managerName']); ?></div>
		<div class="cell right">Position</div>
		<div class="cell"><?php echo($responses['position']); ?></div>
	</div>
	<div class="row">
		<div class="cell right">Employee Name</div>
		<div class="cell"><?php echo($responses['employeeName']); ?></div>
		<div class="cell right">Department</div>
		<div class="cell"><?php echo($responses['department']); ?></div>
	</div>
	<div class="row">
		<div class="cell right">&nbsp;</div>
		<div class="cell">&nbsp;</div>
		<div class="cell right">Date</div>
		<div class="cell"><?php echo($responses['date']); ?></div>
	</div>
</div>
<div class="sectionHeader ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus">
	<h1>Section 1</h1>
	<h2>Please rate using the following scale</h2>
</div>
<div class="ratingsDefinition">
	<h2>Ratings Definition</h2>
	<p><em>EXCEPTIONAL (5)</em>:  Consistently exceeds all relevant performance standards. Provides leadership, fosters teamwork, is highly productive, innovative, responsive and generates top quality work.</p>
	<p><em>EXCEEDS EXPECTATIONS (4)</em>:  Consistently meets and often exceeds all relevant performance standards. Shows initiative and versatility, works collaboratively, has strong technical & interpersonal skills or has achieved significant improvement in these areas.</p>
	<p><em>MEETS EXPECTATIONS (3)</em>:   Meets all relevant performance standards. Seldom exceeds or falls short of desired results or objectives.</p>
	<p><em>BELOW EXPECTATIONS (2)</em>:   Sometimes meets the performance standards. Seldom exceeds and often falls short of desired results. Performance has declined significantly, or employee has not sustained adequate improvement, as required since the last performance review.</p>
	<p><em>NEEDS IMPROVEMENT (1)</em>:  Consistently falls short of performance standards.</p>
</div>
<div class="question">
	<span class="questionResponse bold">Employee</span>
	<span class="questionResponse2 bold">Manager</span>
	<p>&nbsp;</p>
</div>
<div class="question">
	<span class="questionTitle">Teamwork</span>
	<span class="questionResponse"><?php echo($responses['teamworkScoreEmployee']); ?></span>
	<span class="questionResponse2"><?php echo($responses['teamworkScoreManager']); ?></span>
	<p>Is an effective team player who adds complementary skills and contributes valuable ideas, opinions and feedback and supports the efforts of other employees in the team.</p>
</div>
<div class="question">
	<span class="questionTitle">Initiative</span>
	<span class="questionResponse"><?php echo($responses['initiativeScoreEmployee']); ?></span>
	<span class="questionResponse2"><?php echo($responses['initiativeScoreManager']); ?></span>
	<p>Recognises opportunities and initiates actions to capitalise on them. Looks for new and productive ways to make an impact.</p>
</div>
<div class="question">
	<span class="questionTitle">Quality of Work</span>
	<span class="questionResponse"><?php echo($responses['qualityScoreEmployee']); ?></span>
	<span class="questionResponse2"><?php echo($responses['qualityScoreManager']); ?></span>
	<p>Completes high quality work according to specifications.</p>
</div>
<div class="question">
	<span class="questionTitle">Communication</span>
	<span class="questionResponse"><?php echo($responses['communicationScoreEmployee']); ?></span>
	<span class="questionResponse2"><?php echo($responses['communicationScoreManager']); ?></span>
	<p>Connects with peers, subordinates and customers, actively listens, clearly and effectively shares information, demonstrates effective oral and written communication skills.</p>
</div>
<div class="question">
	<span class="questionTitle">Job Knowledge</span>
	<span class="questionResponse"><?php echo($responses['knowledgeScoreEmployee']); ?></span>
	<span class="questionResponse2"><?php echo($responses['knowledgeScoreManager']); ?></span>
	<p>Possesses skills and knowledge to perform the job competently and efficiently.</p>
</div>
<div class="question">
	<span class="questionTitle">Totals</span>
	<span class="questionResponse bold underline"><?php echo("$employeeScoreTotal"); ?></span>
	<span class="questionResponse2 bold underline"><?php echo("$managerScoreTotal"); ?></span>
</div>
<div class="question">
	<span class="questionTitle">Manager's comments and feedback for the employee:</span>
	<p><?php echo($responses['feedback']); ?></p>
</div>
<div class="sectionHeader ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus">
	<h1>Section 2</h1>
	<h2>Please answer the following open response questions</h2>
</div>
<div class="question">
	<span class="questionTitle">Q1. How would you rate your overall performance over the last year?</span>
	<p><?php echo($responses['openQuestion1']); ?></p>
</div>
<div class="question">
	<span class="questionTitle">Q2. What do you see as your greatest accomplishments or successful efforts over this past year?</span>
	<p><?php echo($responses['openQuestion2']); ?></p>
</div>
<div class="question">
	<span class="questionTitle">Q3. What factors impacted your job or your ability to perform your job positively or negatively during the last review period?</span>
	<p><?php echo($responses['openQuestion3']); ?></p>
</div>
<div class="question">
	<span class="questionTitle">Q4. If you were "calling the shots", what are three to five recommendations you would have for the growth/betterment of the company and your department?</span>
	<p><?php echo($responses['openQuestion4']); ?></p>
</div>
<div class="question">
	<span class="questionTitle">Q5. Please complete the following: <em>I believe my goals and objectives for the coming year should be:</em></span>
	<p><?php echo($responses['openQuestion5']); ?></p>
</div>
<div class="question">
	<span class="questionTitle">Q6. What additional comments or suggestions would you like to offer?</span>
	<p><?php echo($responses['openQuestion6']); ?></p>
</div>
<div class="question">
	<span class="questionTitle">What goals and objectives does the manager have for the employee?</span>
	<p><?php echo($responses['goals']); ?></p>
</div>