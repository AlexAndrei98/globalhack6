<?php

/* 
 * user: kcho
 * 
 * get list of unclaimed requests around driver's location
 * 
 * GET or POST:
 *	lat		location of driver, latitude
 *	lon		location of driver, longitude
 *	range	range in miles to look, default applies
 * 
 * JSON return:
 *	array of requests...
 *	{
 *		requestid		identifies the request
 *		address			request address (based on request reference ID)
 *		distance		distance to request from driver's lat,lon
 *		receivedtime	time that request was received
 *	}
 * 
 * sample call:
 * http://n-qr.com/get_request_list.php?lat=38.2343,lon=87.53453
 */

require_once('phplib/prolog.php');
require_once('phplib/database.php');

$IMPORT_VARS = array('lat', 'lon','range');
module_startup();
db_open();		// if it fails, it died anyway

$lrc = $RC_FAILURE;
do
{
	if(empty($range))
		$range = $RANGEMILES_DEFAULT;
	
	$where = "WHERE status <= " . $REQUEST_STATUS['OPEN'];
	if(is_numeric($lat) and is_numeric($lon))
	{
		// build WHERE distance box filter
	}
	$q = "SELECT requests.requestid, requests.receivedtime, requests.status, sites.name, sites.address, sites.lat, sites.lon FROM requests LEFT JOIN sites ON requests.sitecode = sites.code $where";
	
	$result = db_query($q);
	if (!$result)
	{
		die('no result from query: ' . $q);
	}
	$requests_list = array();
	if (db_numrows($result) > 0)
	{
		while ($row = db_fetch($result))
		{
			$distance = calculate_mileage($lat, $lon, $row['lat'], $row['lon']);
			if(($distance <= $range) || empty($lat) || empty($lon))
			{
				$requests_list[] = array(
					'requestid' => $row['requestid'],
					'name' => $row['name'],
					'address' => $row['address'],
					'distance' => $distance,
					'receivedtime' => $row['receivedtime'],
				);
			}
		}
	}

	$lrc = $RC_SUCCESS;
} while(0);

// produce final output
if ($lrc == $RC_SUCCESS)
{
	//JSON encode the failure and serve it up
	$RESULT = $requests_list;
}
else
{
	//JSON encode the successful result and serve it up
	$RESULT = array();
}

require_once('phplib/epilog.php');

