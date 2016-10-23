<?php

/* 
 * user: kcho
 */

// database access values
$DB_HOST = 'localhost';
$DB_NAME = 'globalhack6';
$DB_USER = '';
$DB_PASSWORD = '';

// JSON responses
// successes:
$RC_SUCCESS = 1;
$RC_FAILURE = -1;

// user states
$DRIVER_STATUS = array(
	'UNAVAILABLE' => 0,
	'AVAILABLE' => 1,
);

$REQUEST_STATUS = array(
	'UNKNOWN' => 0,
	'OPEN' => 1,
	'ACCEPTED' => 2,
	'PICKEDUP' => 3,
	'NOSHOW' => 4,
	'COMPLETED' => 5,
);

$RANGEMILES_DEFAULT = 500;		// default to 5 miles
$FACILITY_MINAVAILABLE = 0;		// minumum threshhold of beds available

$TWILIO_ACCOUNTSID = "";
$TWILIO_AUTHTOKEN = "";
$TWILIO_NUMBER = "";
