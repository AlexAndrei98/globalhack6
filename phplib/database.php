<?php

/* 
 * user: kcho
 */

require_once('secrets.php');

$DB = null;

function db_open()
{
	global $DB, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASSWORD;

	$DB = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
	if(!$DB)
	{
		die("unable to select database" . mysqli_connect_error());
	}
}

function db_close()
{
	global $DB;

	//close db
	if(isset($DB))
	{
		mysqli_close($DB);
		$DB = null;
	}
}

/*
 * Execute a query against passed database that should return exactly 1 record
 * 
 * returns an array of fields
 */

function db_query_one($q1)
{
	global $RC_SUCCESS, $RC_FAILURE;
	global $DB;

	$fetch = null;

	$rc = $RC_FAILURE;
	do
	{
		$result = mysqli_query($DB, $q1);
		if(!$result)
			break;

		// echo "[here q1=$q1]";
		// echo "[rows=".strval(mysqli_num_rows($result))."]";

		if(mysqli_num_rows($result) <> 1)
			break;

		$fetch = mysqli_fetch_assoc($result);
		$rc = $RC_SUCCESS;

	} while(0);

	if($rc == $RC_SUCCESS)
	{
		return($fetch);
	}
	else
	{
		return(null);
	}
}

// returns database query result itself
function db_query($q)
{
	global $RC_SUCCESS, $RC_FAILURE;
	global $DB;

	$fetch = null;

	$rc = $RC_FAILURE;
	do
	{
		$result = mysqli_query($DB, $q);
		if(!$result)
			break;

		$rc = $RC_SUCCESS;
	} while(0);

	if($rc == $RC_SUCCESS)
		return($result);
	else
		return(null);
}

// determine the number of rows in dbresult
function db_numrows($dbresult)
{
	return(mysqli_num_rows($dbresult));
}

// fetch the next row of the valid dbresult as an associative array
function db_fetch($dbresult)
{
	return(mysqli_fetch_assoc($dbresult));
}
