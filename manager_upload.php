<div class="sectionHeader ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus">
	<h1>Please upload a CSV file received from an employee's evaluation to continue</h1>
</div>
<div class="question">
	<form method="post" action="?step=2&amp;action=evaluate" enctype="multipart/form-data">
	<label for="csvUpload">CSV file from the employee: </label>
	<input type="file" name="csvUpload" id="csvUpload"><br>
	<input type="submit" class="uploadButton" name="submit" value="Upload">
</form>
</div>