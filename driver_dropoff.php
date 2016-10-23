<?php

/* 
 * user: kcho
 * 
 * driver has dropped off the requester at a facility
 * 
 * GET or POST:
 *	requestid	identifies the request
 *	lat			current location of driver, latitude
 *	lon			current location of driver, longitude
 * 
 * no return text, HTTP only
 * 
 */

require_once('phplib/prolog.php');
require_once('phplib/database.php');

$IMPORT_VARS = array('requestid', 'lat', 'lon');
module_startup();
db_open();		// if it fails, it died anyway

$lrc = $RC_FAILURE;
do
{
	if(empty($requestid))
		break;
	
	// NOT checking for transaction collision yet!
	
	$q = "SELECT * FROM requests WHERE requestid=" . $requestid;
	
	$request = db_query_one($q);
	if (!$request)
	{
		die('no result from query: ' . $q);
	}
	else if($request['status'] > $REQUEST_STATUS['PICKEDUP'])
	{
		break;
	}
	
	$q = "UPDATE requests SET status=" . $REQUEST_STATUS['COMPLETED'] . ", closedtime=now() WHERE requestid=" . $requestid;
	$result = db_query($q);
	if (!$result)
	{
		die('no result from query: ' . $q);
	}
	
	$lrc = $RC_SUCCESS;
} while(0);

require_once('phplib/epilog.php');

