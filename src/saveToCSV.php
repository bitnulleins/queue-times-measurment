<?php
require('config.php');

/**
 * Source Code by bit01.de
 */

$fileName = __DIR__ . "/" . BASE_DIR . FILENAME . '.csv';

if (isset($_POST['location']) && isset($_POST['dateStart']) && isset($_POST['dateEnd'])) {

	if (!is_dir(BASE_DIR)) {
		mkdir(BASE_DIR);
	}

	$fw = fopen($fileName, 'a');
	
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
	
	$lines = 0;
	$handle = fopen($fileName, "r");
	while(!feof($handle)){
	  $line = fgets($handle, 4096);
	  $lines += substr_count($line, PHP_EOL);
	}
	
	if ($lines == 0) {
		$header[] = "ID";
		$header[] = "Date";
		$header[] = "Weekday";
		$header[] = "Queue";
		$header[] = "Measurement_Start";
		$header[] = "Measurement_End";
		$header[] = "Waiting_Time_Seconds";
		$header[] = "Measurement_Timezone";
		$row = join(",", $header);
		fwrite($fw, $row."\n");
	}
	
	$cells = array(uniqid(), $messaureDate, $weekday, $location, $startTime, $endTime, $waitTimeInSeconds, $bkkTime, $timezone);
	$row = join(",", $cells);
	fwrite($fw, $row."\n");
	fclose($fw);

}

?>