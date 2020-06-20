<?php
// Unique (anonymous) ID for device
DEFINE('ID', $_COOKIE['waiting_queue_measurement_device'] ?: setcookie('waiting_queue_measurement_device', uniqid()));
// Base folder for CSV files
DEFINE('BASE_DIR', './data/');
// Generate (unique) filename
DEFINE('FILENAME', ID . '_waiting_queue_measurement');
// Name the ressources that want you to measurment
DEFINE('RESSOURCES', ['Ressource 1', 'Ressource 2', 'Ressource 3']);