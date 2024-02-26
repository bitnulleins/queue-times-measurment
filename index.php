<?php
require('./backend/config.php');
$fw = fopen(FILEDIR, "a");

$lines = 0;
$handle = fopen(FILEDIR, "r");
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
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <!-- HTML5 -->
    <meta charset="utf-8">
    <!-- HTML 4.x -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled"/>
    <title>Measure Queue Time - Web Tool</title>
    <meta type="description"
          content="Measure queue times (queue waiting time) of different ressources online with this tool for free. Save and export your queue times as CSV file.">
    <meta type="robot" content="index,follow">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="./frontend/script.js"></script>
    <link rel="stylesheet" href="./frontend/style.css">
</head>
<body class="text-center">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">Queue Waiting Time Measurement</h3>
        </div>
    </header>

    <div class="record">Measurement started...</div>

    <main role="main" class="inner cover">
        <div class="row center">
            <fieldset>
                <?php foreach (RESSOURCES as $ressource): ?>
                    <input type="radio" id="<?php echo lcfirst(str_replace(' ', '', $ressource)) ?>" name="location"
                           value="<?php echo $ressource ?>">
                    <label style="width: <?php echo 100 / sizeof(RESSOURCES); ?>%"
                           for="<?php echo lcfirst(str_replace(' ', '', $ressource)) ?>"> <?php echo $ressource ?> </label>
                <?php endforeach; ?>
            </fieldset>
        </div>
        <div class="row">
            <button id="toggleTime" disabled="true">Start measurement</button>
        </div>
        <div class="row">
            <button id="cancel" disabled>Cancel</button>
        </div>
        <div class="row info">
            <div class="col">
                <div id="countup">0s</div>
                <small>Waiting Time</small>
            </div>
            <div class="col">
                <div id="amount">0</div>
                <small>Measurements</small>
            </div>
            <div class="col">
                <div id="amount"><a href="<?php echo BASE_DIR . FILENAME . '.csv' ?>" target="_blank">CSV</a></div>
                <small>Download file</small>
            </div>
        </div>
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p>Queue Measurement Tool | <a href="https://github.com/bitnulleins/queue-times-measurment" target="_blank">View Source Code</a></p>
        </div>
    </footer>
</div>
</body>
</html>