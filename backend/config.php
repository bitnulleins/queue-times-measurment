<?php
if (isset($_COOKIE['waiting_queue_measurement_device'])) {
	$id = $_COOKIE['waiting_queue_measurement_device'];
} else {
	$unique_id = uniqid();
	setcookie('waiting_queue_measurement_device', $unique_id);
	$id = $unique_id;
}
// Unique (anonymous) ID for device
DEFINE('ID', $id);
// Base folder for CSV files
DEFINE('BASE_DIR', './data/');
// Generate (unique) filename
DEFINE('FILENAME', ID . '_waiting_queue_measurement');
// File directory
DEFINE('FILEDIR', __DIR__ . "/" . BASE_DIR . FILENAME . '.csv');
// Name the ressources that want you to measurment
DEFINE('RESSOURCES', ['Ressource 1', 'Ressource 2', 'Ressource 3']);