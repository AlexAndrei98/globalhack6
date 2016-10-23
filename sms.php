<?php

/* 
 * user: kcho
 * 
 * interface to Twilio SMS
 * 
 */

require_once('phplib/secrets.php');

require __DIR__ . '/twilio/Twilio/autoload.php';
use Twilio\Rest\Client;

function _sendSms($to, $message)
{
	global $TWILIO_ACCOUNTSID, $TWILIO_AUTHTOKEN, $TWILIO_NUMBER;
	
    $client = new Client($TWILIO_ACCOUNTSID, $TWILIO_AUTHTOKEN);

    try {
        $client->messages->create(
            $to,
            [
                "body" => $message,
                "from" => $TWILIO_NUMBER
            ]
        );
//        Log::info('Message sent to ' . $TWILIO_NUMBER);
    } catch (TwilioException $e) {
/*        Log::error(
            'Could not send SMS notification.' .
            ' Twilio replied with: ' . $e
        );
  */
    }
}
