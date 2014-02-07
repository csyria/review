<form action="?step=1&amp;action=generate" method="post">
<div class="table">
	<div class="row">
		<div class="cell right"><label for="managerName">Manager Name</label></div>
		<div class="cell"><input name="responses[managerName]" id="managerName" tabindex="1" /></div>
		<div class="cell right"><label for="position">Position</label></div>
		<div class="cell"><input name="responses[position]" id="position" tabindex="3" /></div>
	</div>
	<div class="row">
		<div class="cell right"><label for="employeeName">Employee Name</label></div>
		<div class="cell"><input name="responses[employeeName]" id="employeeName" tabindex="2"/></div>
		<div class="cell right"><label for="department">Department</label></div>
		<div class="cell"><input name="responses[department]" id="department" tabindex="4" /></div>
	</div>
	<div class="row">
		<div class="cell right">&nbsp;</div>
		<div class="cell">&nbsp;</div>
		<div class="cell right"><label for="date">Date</label></div>
		<div class="cell"><input name="responses[date]" id="date" value="<?php echo("$date"); ?>" tabindex="5" /></div>
	</div>
</div>
<div class="sectionHeader ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus">
	<h1>Section 1</h1>
	<h2>Please rate yourself using the dropdown boxes</h2>
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
		<select name="responses[teamworkScoreEmployee]" id="teamworkScoreEmployee">
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
		<select name="responses[initiativeScoreEmployee]" id="initiativeScoreEmployee">
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
		<select name="responses[qualityScoreEmployee]" id="qualityScoreEmployee">
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
		<select name="responses[communicationScoreEmployee]" id="communicationScoreEmployee">
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
		<select name="responses[knowledgeScoreEmployee]" id="knowledgeScoreEmployee">
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
<div class="sectionHeader ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus">
	<h1>Section 2</h1>
	<h2>Please answer the following open response questions</h2>
</div>
<div class="question">
	<span class="questionTitle">Q1. How would you rate your overall performance over the last year?</span>
	<p><textarea name="responses[openQuestion1]" id="openQuestion1" rows="6" cols="80"></textarea></p>
</div>
<div class="question">
	<span class="questionTitle">Q2. What do you see as your greatest accomplishments or successful efforts over this past year?</span>
	<p><textarea name="responses[openQuestion2]" id="openQuestion2" rows="6" cols="80"></textarea></p>
</div>
<div class="question">
	<span class="questionTitle">Q3. What factors impacted your job or your ability to perform your job positively or negatively during the last review period?</span>
	<p><textarea name="responses[openQuestion3]" id="openQuestion3" rows="6" cols="80"></textarea></p>
</div>
<div class="question">
	<span class="questionTitle">Q4. If you were "calling the shots", what are three to five recommendations you would have for the growth/betterment of the company and your department?</span>
	<p><textarea name="responses[openQuestion4]" id="openQuestion4" rows="6" cols="80"></textarea></p>
</div>
<div class="question">
	<span class="questionTitle">Q5. Please complete the following: <em>I believe my goals and objectives for the coming year should be:</em></span>
	<p><textarea name="responses[openQuestion5]" id="openQuestion5" rows="6" cols="80"></textarea></p>
</div>
<div class="question">
	<span class="questionTitle">Q6. What additional comments or suggestions would you like to offer?</span>
	<p><textarea name="responses[openQuestion6]" id="openQuestion6" rows="6" cols="80"></textarea></p>
</div>
<div class="question">
	<p><input type="submit" class="doneButton" value="All done. Submit!" /></p>
</div>
</form>