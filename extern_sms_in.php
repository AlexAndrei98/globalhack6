<?php

/* 
 * user: kcho
 * 
 * twilio callback handlers for incoming SMS
 * 
 *	From	is set to the From phone number
 *	To		is set to the To phone number
 *  Body	is set to the message Body
 *  
 *
 * <Response> contains <Message> to be sent back to sender
 * 
 * 
 * allow 'nevermind' or 'cancel' from open ticket number
 * 
 */

require_once('phplib/prolog.php');
require_once('phplib/database.php');
require_once('sms.php');

$IMPORT_VARS = array('From', 'To', 'Body');
module_startup();
db_open();		// if it fails, it died anyway

/*
require __DIR__ . '/twilio/Twilio/autoload.php';
use Twilio\Rest\Client;
*/

// validate sitecode and get related info if found
function findsite($sitecode)
{
	global $RC_SUCCESS, $RC_FAILURE;
	
	$lrc = $RC_FAILURE;
	do
	{
		if(empty($sitecode))
			break;

		$q = "SELECT * FROM sites WHERE code='$sitecode'";
		$site = db_query_one($q);
		if(empty($site))
		{
			die('no result from query: ' . $q);
		}

		$lrc = $RC_SUCCESS;
	} while(0);

	// produce final output
	if ($lrc == $RC_SUCCESS)
	{
		return($site);
	}
	else
	{
		return($RC_FAILURE);
	}
}

// notify drivers available near site[]
function notifydrivers($site)
{
	global $RANGEMILES_DEFAULT;
	
	$message = "Angel Lift: A new Angel Lift request for pickup at " . $site['name'] . ", " . $site['address'] . ", received at " . date('l jS \of F Y h:i:s A') . ". Click to view available requests: http://n-qr.com";
	
	$drivercount = 0;
	do
	{
		$q = "SELECT * FROM drivers WHERE available > 0";
		$result = db_query($q);
		if (!$result)
		{
			die('no result from query: ' . $q);
		}
		if (db_numrows($result) > 0)
		{
			while ($row = db_fetch($result))
			{
				$distance = calculate_mileage($site['lat'], $site['lon'], $row['lat'], $row['lon']);
				if(($distance <= $RANGEMILES_DEFAULT) || empty($row['lat']) || empty($row['lon']))
				{
					_sendSms($row['mobilenum'], $message);
					$drivercount++;
				}
			}
		}
	} while(0);
	
	return($drivercount);
}


$lrc = $RC_FAILURE;
do
{
	// TODO:  check if requester number is banned
	
	// TODO:  check that sitecode is valid
	$sitecode = intval($Body);
	$site = findsite($sitecode);
	if($site == $RC_FAILURE)
		break;

	$q = "INSERT INTO requests (receivedtime, sitecode, status, sourcenum, destnum) VALUES (now(), '$sitecode', '".$REQUEST_STATUS['OPEN']."', $From, $To)";

	$result = db_query($q);
	if (!$result)
	{
		die('no result from query 1: ' . $q);
	}
	
	// send notification to available nearby drivers
//	if(notifydrivers($site) <= 0)
//		break;
	notifydrivers($site);

	$lrc = $RC_SUCCESS;
} while(0);

// produce final output
if ($lrc == $RC_SUCCESS)
{
	$message = "Thank you for using Angel Lift.  We are sending someone your way at ". $site['name'] . ".  Stay nearby.";
}
else
{
	$message = "Thank you for using Angel Lift.  A problem was experienced.  Please try again after a few minutes.";
}

header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

require_once('phplib/epilog.php');
?>
<Response>
    <Message>
		<?php echo $message ?>
	</Message>
</Response>
