# Queue Time Measurment Tool
Measure queue times easy with this lightweight and reponsive web client.

* Responsive Web Client (mobile-ready)
* Can switch browser tabs while measure queue time
* Download generated CSV with unique id's to analyse queue time

With this tool you can measure for example:

* Queue waiting time in supermarket, secruity check or other stores
* Processing time from a machine
* Computer boot times
* Different ressources possible

## How to use

1. Choose a ressource that you want to measure
2. Click start measurement
3. Stop measurement
4. Repeat this steps

## Installation

1. Clone / Download Git repository to your server
2. Change config when it is nescessary
3. Start measurments...

```php
// Base folder for CSV files
DEFINE('BASE_DIR', './data/');
// Generate (unique) filename
DEFINE('FILENAME', ID . '_waiting_queue_measurement');
// Name the ressources that want you to measurment
DEFINE('RESSOURCES', ['Ressource 1', 'Ressource 2', 'Ressource 3']);
```

# Licence

GNU GENERAL PUBLIC LICENSE V3
