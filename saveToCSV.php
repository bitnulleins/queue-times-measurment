<?php
require('config.php');

/**
 * Source Code by bit01.de
 */

if (isset($_POST['location']) && isset($_POST['dateStart']) && isset($_POST['dateEnd'])) {

	if (!is_dir(BASE_DIR)) {
		mkdir(BASE_DIR);
	}
	
	$fw = fopen(FILEDIR, 'a');

	$weekdays[1] = "Monday";
	$weekdays[2] = "Tuesday";
	$weekdays[3] = "Wednesday";
	$weekdays[4] = "Thursday";
	$weekdays[5] = "Friday";
	$weekdays[6] = "Saturday";
	$weekdays[7] = "Sunday";
	
	$location = $_POST['location'];
	$start = $_POST['dateStart']/1000;
	$end = $_POST['dateEnd']/1000;
	$startDate = $start;
	$endDate = $end;
	$waitTimeInSeconds = round( $endDate - $startDate );
	$startTime = date("H:i:s",$startDate);
	$endTime = date("H:i:s",$endDate);
	$messaureDate = date("Y-m-d",$startDate);
	$weekday = $weekdays[date("w")];
	$timezone = date("e O",$startDate);
	
	$cells = array(uniqid(), $messaureDate, $weekday, $location, $startTime, $endTime, $waitTimeInSeconds, $bkkTime, $timezone);
	$row = join(",", $cells);
	fwrite($fw, $row."\n");
	fclose($fw);

}

?>