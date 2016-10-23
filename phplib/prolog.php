<?php

/* 
 * user: kcho
 */

/*
  Parse a variables list from an array of variables.
  Each individual variable in varlist creates a globally
  scoped variable with the value found in the supervar
  container.  Values are first stripped of any interstitial
  tags.

  After the call, each variable named in varlist is
  ALWAYS defined (but value may be emptystring).

  Example supervars to use might be $_REQUEST, $_POST,
  $_GET, etc.

  $initialize (default YES) controls where absent $varlist
  that are not in $required are initialized to blank-string.
 */

require_once('secrets.php');

function parse_vars(array $supervar, array $varlist, array $required = array(), $initialize = TRUE)
{
	global $RC_SUCCESS, $RC_FAILURE;
	
	foreach($varlist as $localkey)
	{
		global $$localkey;

		if(array_key_exists($localkey, $supervar))
		{
			$$localkey = trim(htmlspecialchars(strip_tags(urldecode($supervar[$localkey]))));
		}
		else
		{
			if($initialize && !isset($$localkey))
				$$localkey = '';
		}
	}

	if(!empty($required))
	{
		foreach($required as $localkey)
		{
			if(empty($$localkey))
			{
				// one or more required fields are blank
				return($RC_FAILURE);
			}
		}
	}

	return($RC_SUCCESS);
}

// delayed startup; import vars, check valid connection, etc.
// pass in startmodes_array of modulestartmodes().
// $initializevars controls defaulting $$varlist to blank-strings.
function module_startup()
{
	global $IMPORT_VARS, $REQUIRED_VARS;
	global $RC_FAILURE;
	global $RC_SUCCESS;

	$lrc = $RC_FAILURE;

	do
	{
		if(is_null($REQUIRED_VARS))
			$REQUIRED_VARS = array();
		
		// import variables and validate the required ones
		if(isset($IMPORT_VARS))
			if(parse_vars($_REQUEST, $IMPORT_VARS, $REQUIRED_VARS) <> $RC_SUCCESS)
				break;

		$lrc = $RC_SUCCESS;
	} while(0);

	return($lrc);
}

function calculate_mileage($lat1, $lon1, $lat2, $lon2)
{
 	// used internally, this function actually performs that calculation to
	// determine the mileage between 2 points defined by lattitude and
	// longitude coordinates.  This calculation is based on the code found
	// at http://www.cryptnet.net/fsp/zipdy/

	// Convert lattitude/longitude (degrees) to radians for calculations
	$lat1 = deg2rad(floatval($lat1));
	$lon1 = deg2rad(floatval($lon1));
	$lat2 = deg2rad(floatval($lat2));
	$lon2 = deg2rad(floatval($lon2));

//print("lat1=$lat1 lon1=$lon1   lat2=$lat2 lon2=$lon2>>><br/>");
	
	// Find the deltas
	$delta_lat = $lat2 - $lat1;
	$delta_lon = $lon2 - $lon1;

	// Find the Great Circle distance 
	$temp = pow(sin($delta_lat/2.0),2) + cos($lat1) * cos($lat2) * pow(sin($delta_lon/2.0),2);
	$distance = 3956 * 2 * atan2(sqrt($temp),sqrt(1-$temp));

	return $distance;
 }
   
