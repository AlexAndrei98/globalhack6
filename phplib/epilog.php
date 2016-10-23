<?php

/* 
 * user: kcho
 */

//close db
if(isset($DB))
{
	db_close();
	$DB = null;
}

// produce final output
if(isset($RESULT))
{
	echo json_encode($RESULT);
}
