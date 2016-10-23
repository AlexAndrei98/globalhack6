<?php

/* 
 * user: kcho
 * 
 * updates the count of beds available at the specified facility
 * 
 * GET or POST:
 *	facilityid	identifies the site
 *	adjust		add value to current count (e.g. -1 means subtract 1)
 *	update		set current count to value
 * 
 * JSON return:
 *	name	name of facility
 *	count	new count after update
 * 
 */

require_once('phplib/prolog.php');
require_once('phplib/database.php');

$IMPORT_VARS = array('facilityid', 'adjust', 'update');
module_startup();
db_open();		// if it fails, it died anyway

$lrc = $RC_FAILURE;
do
{
	if(empty($facilityid))
		break;
	
	// NOT checking for transaction collision yet!
	
	$q = "SELECT * FROM facilities WHERE facilityid=" . $facilityid;
	
	$facility = db_query_one($q);
	if (!$facility)
	{
		die('no result from query: ' . $q);
	}
	
	$newcount = $facility['available'];
	if(!empty($update))
	{
		$newcount = $update;
	}
	else if(!empty($adjust))
	{
		$newcount = $facility['available'] + $adjust;
	}
	
	if($newcount < 0 || $newcount > $facility['capacity'])
		break;
	
	$q = "UPDATE facilities SET available=" . $newcount . "WHERE facilityid=" . $facilityid;
	$result = db_query($q);
	if (!$result)
	{
		die('no result from query: ' . $q);
	}
	
	$lrc = $RC_SUCCESS;
} while(0);

require_once('phplib/epilog.php');

