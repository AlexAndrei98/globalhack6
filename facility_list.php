<?php

/* 
 * user: kcho
 * 
 * get list of shelter facilities near location (requester)
 * 
 * GET or POST:
 *	lat			location of request or driver, latitude
 *	lon			location of request or driver, longitude
 *	range		range in miles to look, default applies
 *	filter		keywords to filter (only those accepting all filter keywords)
 *		youth		include only those accepting youth
 *		family		include only those accepting family with minors
 *		male		include only those accepting bio male
 *		woman		include only those accepting bio female
 * 
 * JSON return:
 *	{
 *		name		facility name
 *		address		facility address
 *		lat			location of facility, latitude
 *		lon			location of facility, longitude
 *		distance	distance to facility from driver's lat,lon
 *		capacity	total number of beds
 *		available	number of beds not allocated
 *	}
 * 
 * sample query:
 *	http://n-qr.com/facility_list.php?lat=38.6322637&lon=-90.2288187&filter=male,family
 */

require_once('phplib/prolog.php');
require_once('phplib/database.php');

$IMPORT_VARS = array('lat', 'lon', 'range', 'filter');
module_startup();
db_open();		// if it fails, it died anyway

$lrc = $RC_FAILURE;
do
{
	if(empty($range))
		$range = $RANGEMILES_DEFAULT;

	$where = "WHERE available >= " . $FACILITY_MINAVAILABLE;
	
	if(strpos(strtolower($filter), "male") !== false)	{ $where .= " AND male > 0"; }
	if(strpos(strtolower($filter), "woman") !== false)	{ $where .= " AND female > 0"; }
	if(strpos(strtolower($filter), "family") !== false)	{ $where .= " AND family > 0"; }
	if(strpos(strtolower($filter), "youth") !== false)	{ $where .= " AND youth > 0"; }

	if(is_numeric($lat) and is_numeric($lon))
	{
		// build WHERE distance box filter
	}
	$q = "SELECT * FROM facilities $where";
	
	$result = db_query($q);
	if (!$result)
	{
		die('no result from query: ' . $q);
	}
	$facilities_list = array();
	if (db_numrows($result) > 0)
	{
		while ($row = db_fetch($result))
		{
			$distance = calculate_mileage($lat, $lon, $row['lat'], $row['lon']);
			if(($distance <= $range) || empty($lat) || empty($lon))
			{
				$facilities_list[] = array(
					'facilityid' => $row['facilityid'],
					'name' => $row['name'],
					'address' => $row['address'],
					'lat' => $row['lat'],
					'lon' => $row['lon'],
					'distance' => $distance,
					'capacity' => $row['capacity'],
					'available' => $row['available'],
				);
			}
		}

		// sort by distance, ascending
		foreach($facilities_list as $key => $row)
		{
			$sort_facilityid[$key] = $row['facilityid'];
			$sort_name[$key] = $row['name'];
			$sort_address[$key] = $row['address'];
			$sort_lat[$key] = $row['lat'];
			$sort_lon[$key] = $row['lon'];
			$sort_distance[$key] = $row['distance'];
			$sort_capacity[$key] = $row['capacity'];
			$sort_available[$key] = $row['available'];
		}
		
		array_multisort(
				$sort_distance, SORT_ASC,
				$sort_facilityid, SORT_ASC,
				$sort_name, SORT_ASC,
				$sort_address, SORT_ASC,
				$sort_lat, SORT_ASC,
				$sort_lon, SORT_ASC,
				$sort_capacity, SORT_ASC,
				$sort_available, SORT_ASC,
				$facilities_list
				);
	}
	
	$lrc = $RC_SUCCESS;
} while(0);

// produce final output
if ($lrc == $RC_SUCCESS)
{
	//JSON encode the failure and serve it up
	$RESULT = $facilities_list;
}
else
{
	//JSON encode the successful result and serve it up
	$RESULT = array();
}

require_once('phplib/epilog.php');

