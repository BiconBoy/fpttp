<?php 
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
$config['mode'] = 'sandbox';
 
/**
* Account SID
P_MKELE SID ACae3afb4ddfc91b7c665610e41fc623e9
BAKOBILE SID AC04f00bc49197e3ba9c5ce1fd768b7a4b
**/
$config['account_sid'] = 'AC04f00bc49197e3ba9c5ce1fd768b7a4b';//Your account sid that are acess from twilio dashboard
 
/**
* Auth Token
P_MKALE TOKEN c6504960b6f3457e304017416c4218f1
BAKOBILE TOKEN c6518a75b263e5b612cf1d4c794560f9

BAKO API djTpYakApRsCH6bpZA11DycNB69QUDGa
**/

$config['auth_token'] = 'c6518a75b263e5b612cf1d4c794560f9';//Your Authentication acess from twilio dashboard
 
/**
* API Version
**/
$config['api_version'] = '2010-04-01'; 
 
/**
* Twilio Phone Number
P_MKALE NUMBER +12563339348
BAKOBILE NUMBER +12566458765
**/
$config['number'] = '+12566458765';//Your configuration no that you have need to set in twilio dashboard is used to send recive message
 
/* End of file twilio.php */
?>
