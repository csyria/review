<?php

$filename = $_POST['filename'];
$csv = $_POST['csv'];

$csv = base64_decode($csv);

header("Cache-Control: must-revalid fadeate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header('Content-Disposition: attachment; filename="' . $filename . '"');
header("Expires: 0");
header("Pragma: public");
 
$fh = @fopen( 'php://output', 'w' );

fwrite($fh, $csv);

// Close the file
fclose($fh);
// Make sure nothing else is sent, our file is done
exit;

?>