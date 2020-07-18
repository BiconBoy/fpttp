<?php
/*Start sendsms_helper.php file 
  "customerid": "1946-5345-973f-435b-8676-b6d303838425",
  "key": "e19fcf26-8d2f-4e6e-8d6e-e1c4c892628d",
  "secret": "4f04ec967e21f98145711cf77a68e9a60dd0cdb85f448bd76c699970e965b31c"*/
    function sendsms($mobileno, $textmessage, $return = '0'){       
        $sender = 'SEDEMO';  // Need to change
        $smsGatewayUrl = 'https://api.thesmsworks.co.uk/v1';
        $apikey = 'e19fcf26-8d2f-4e6e-8d6e-e1c4c892628d'; // Change   

        $textmessage = urlencode($textmessage);
        $api_element = '/api/web/send/';
        $api_params = $api_element.'?apikey='.$apikey.'&sender='.$sender.'&to='.$mobileno.'&message='.$textmessage;    
        $smsgatewaydata = $smsGatewayUrl.$api_params;
        $url = $smsgatewaydata;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);        
        if(!$output){
           $output =  file_get_contents($smsgatewaydata);
        }
	print_r($output);
        if($return == '1'){ 
            return $output;            
        }else{
            echo "Sent";
        }        
    }

    /*     * End sendsms_helper.php file  

        Load sendsms helper as $this->load->helper('sendsms');
        Call sendsms function Ex. sendsms( '919918xxxxxx', 'test message' );

	*/
?>
