<?php

//echo ($_FILES['csvUpload']['type']);

// Make sure the user actually did upload something
if ($_FILES["csvUpload"]["error"] == 4)	{
	echo ("<div class=\"warning fade\">
	<p>It appears you didn't select a file to upload. Please <a href=\"?step=2\">go back</a> and try again.</p>
	</div>");
	exit();
	}
	
// Do some checking on that uploaded file
if (!isset($_FILES['csvUpload']['error']) || is_array($_FILES['csvUpload']['error']))	{
	echo ("<div class=\"warning fade\">
	<p>There seems to be a problem with the file you uploaded. Please <a href=\"?step=2\">go back</a> and try again.</p>
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
	<p>It looks like you didn't upload a valid fade employee evaluation CSV file. Please <a href=\"?step=2\">go back</a> and try again.</p>
	</div>");
	exit();	
	}

// If it passes all this, we can start working with the CSV file. 
// Note: I'm not doing more verification on the file because it's not really necessary. We're not executing anything from the uploaded file, and this is an internal use only tool.
// I think it's fair to hope our employees won't hack us on this. 
$csvUploadString = file_get_contents($_FILES["csvUpload"]["tmp_name"]);

// Let's break out the employee responses CSV into our own little array, so that we can use a couple of them, like the name and position
$employeeResponses = csvToArray($csvUploadString);

// And for this, I'm going to pass the employee's responses unmodified into the generate action, base64-encoded of course. 	
$employeeCsvB64 = base64_encode($csvUploadString);
?>

<form action="?step=2&amp;action=generate" method="post">
<input type="hidden" name="employeeCsv" value="<?php echo("$employeeCsvB64"); ?>" />
<div class="table">
	<div class="row">
		<div class="cell right"><label for="managerName">Manager Name</label></div>
		<div class="cell"><input name="responses[managerName]" id="managerName" value="<?php echo($employeeResponses['managerName']); ?>" tabindex="1" />
		</div>
		<div class="cell right"><label for="position">Position</label></div>
		<div class="cell"><input name="responses[position]" id="position" value="<?php echo($employeeResponses['position']); ?>" tabindex="3" /></div>
	</div>
	<div class="row">
		<div class="cell right"><label for="employeeName">Employee Name</label></div>
		<div class="cell"><input name="responses[employeeName]" id="employeeName" value="<?php echo($employeeResponses['employeeName']); ?>" tabindex="2" /></div>
		<div class="cell right"><label for="department">Department</label></div>
		<div class="cell"><input name="responses[department]" id="department" value="<?php echo($employeeResponses['department']); ?>" tabindex="4" /></div>
	</div>
	<div class="row">
		<div class="cell right">&nbsp;</div>
		<div class="cell">&nbsp;</div>
		<div class="cell right"><label for="date">Date</label></div>
		<div class="cell"><input name="responses[date]" id="date" value="<?php echo($employeeResponses['date']); ?>" tabindex="5" /></div>
	</div>
</div>
<div class="sectionHeader ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus">
	<h1>Section 1</h1>
	<h2>Please rate the employee using the dropdown boxes</h2>
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
	<span class="questionTitle">Teamwork</span>
	<span class="questionResponse">
		<select name="responses[teamworkScoreManager]" id="teamworkScoreManager">
			<option value="" selected="selected"> </option>
			<option value="5">5</option>
			<option value="4">4</option>
			<option value="3">3</option>
			<option value="2">2</option>
			<option value="1">1</option>
		</select>
	</span>
	<p>Is an effective team player who adds complementary skills and contributes valuable ideas, opinions and feedback and supports the efforts of other employees in the team.</p>
</div>
<div class="question">
	<span class="questionTitle">Initiative</span>
	<span class="questionResponse">
		<select name="responses[initiativeScoreManager]" id="initiativeScoreManager">
			<option value="" selected="selected"> </option>
			<option value="5">5</option>
			<option value="4">4</option>
			<option value="3">3</option>
			<option value="2">2</option>
			<option value="1">1</option>
		</select>
	</span>
	<p>Recognises opportunities and initiates actions to capitalise on them. Looks for new and productive ways to make an impact.</p>
</div>
<div class="question">
	<span class="questionTitle">Quality of Work</span>
	<span class="questionResponse">
		<select name="responses[qualityScoreManager]" id="qualityScoreManager">
			<option value="" selected="selected"> </option>
			<option value="5">5</option>
			<option value="4">4</option>
			<option value="3">3</option>
			<option value="2">2</option>
			<option value="1">1</option>
		</select>
	</span>
	<p>Completes high quality work according to specifications.</p>
</div>
<div class="question">
	<span class="questionTitle">Communication</span>
	<span class="questionResponse">
		<select name="responses[communicationScoreManager]" id="communicationScoreManager">
			<option value="" selected="selected"> </option>
			<option value="5">5</option>
			<option value="4">4</option>
			<option value="3">3</option>
			<option value="2">2</option>
			<option value="1">1</option>
		</select>
	</span>
	<p>Connects with peers, subordinates and customers, actively listens, clearly and effectively shares information, demonstrates effective oral and written communication skills.</p>
</div>
<div class="question">
	<span class="questionTitle">Job Knowledge</span>
	<span class="questionResponse">
		<select name="responses[knowledgeScoreManager]" id="knowledgeScoreManager">
			<option value="" selected="selected"> </option>
			<option value="5">5</option>
			<option value="4">4</option>
			<option value="3">3</option>
			<option value="2">2</option>
			<option value="1">1</option>
		</select>
	</span>
	<p>Possesses skills and knowledge to perform the job competently and efficiently.</p>
</div>
<div class="question">
	<span class="questionTitle">Comments and feedback for the employee:</span>
	<p><textarea name="responses[feedback]" id="feedback" rows="6" cols="80"></textarea></p>
</div>
<div class="sectionHeader ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus">
	<h1>Section 2</h1>
	<h2>Please answer the following open response questions</h2>
</div>
<div class="question">
	<span class="questionTitle">What goals and objectives do you have for the employee?</span>
	<p><textarea name="responses[goals]" id="openQuestion1" rows="6" cols="80"></textarea></p>
</div>
<div class="question">
	<p><input type="submit" class="doneButton" value="All done. Submit!" /></p>
</div>