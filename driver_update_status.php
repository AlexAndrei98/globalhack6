<?php

/* 
 * user: kcho
 * 
 * update driver's available/unavailable, and location
 * 
 * GET or POST:
 *	driverid	driver updating status
 *	lat			current location of driver, latitude
 *	lon			current location of driver, longitude
 *	available	status to update to (re-affirm okay)
 *		yes		include driver in notifications
 *		no		do not include driver in notifications
 * 
 * no return text, HTTP only
 * 
 */

require_once('phplib/prolog.php');
require_once('phplib/database.php');

$IMPORT_VARS = array('driverid', 'lat', 'lon', 'available');
module_startup();
db_open();		// if it fails, it died anyway

$lrc = $RC_FAILURE;
do
{
	if(empty($requestid))
		break;
	
	// NOT checking for transaction collision yet!
	
	$q = "SELECT * FROM drivers WHERE driverid=" . $driverid;
	
	$driver = db_query_one($q);
	if (!$driver)
	{
		die('no result from query: ' . $q);
	}
	
	$q = "UPDATE drivers SET ";

	if(strpos("Y,YES,TRUE,1", strtoupper($available))) { $q .= "available=" . $DRIVER_STATUS['AVAILABLE']; }
	if(strpos("N,NO,FALSE,0", strtoupper($available))) { $q .= "available=" . $DRIVER_STATUS['UNAVAILABLE']; }
	
	if(is_numeric($lat) and is_numeric($lon))
	{
		$q .= ", lat=$lat, lon=$lon";
	}
	
	$q .= " WHERE driverid=" . $driverid;
	$result = db_query($q);
	if (!$result)
	{
		die('no result from query: ' . $q);
	}
	
	$lrc = $RC_SUCCESS;
} while(0);

require_once('phplib/epilog.php');

