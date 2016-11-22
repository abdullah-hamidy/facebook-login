
<?php
 
 $token = "EAARQ2odrPZCEBANHAhpQ0oAifgpsZAUhB3eCYa6EZBfIqINxtxTOiMf4ZCZBOuzfQeLnFJHuAb52t4PtiI0KR6IuUPCVNMP5FPcDGZCnanz2VrmZCgCkbol7k9Hq9KGZCLvkF49U5X8RL2SsPsD250RS0dI7VY1m7c8o0j9LDZAwvkAZDZD";


$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

if ($verify_token === 'cloudwaysschool') {
  echo $challenge;
}
/* validate verify token needed for setting up web hook */ 
// if (isset($_GET['hub_verify_token'])) { 
//     if ($_GET['hub_verify_token'] === 'cloudwaysschool') {
//         echo $_GET['hub_challenge'];
//         return;
//     } else {
//         echo 'Invalid Verify Token';
//         return;
//     }
// }

$input = json_decode(file_get_contents('php://input'), true);	
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];

$url ='https://graph.facebook.com/v2.6/me/messages?access_token=$token';

 $ch = curl_init($url);
    /*prepare response*/
    $jsonData = '{
    "recipient":{
        "id":"' . $sender . '"
        },
        "message":{
            "text":"You said, ' . $message . '"
        }
    }';
	
	$jsonDataEncoded = $jsonData;
	
	 /* curl setting to send a json post data */
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    if (!empty($message)) {
        $result = curl_exec($ch); // user will get the message
    }












// $data_to_send = array(
// 'recipient'=> array('id'=>"$rec_id"), //ID to reply
// 'message' => array('text'=>"Hi I am Test Bot") //Message to reply
// );

// $options_header = array ( //Necessary Headers
// 'http' => array(
// 'method' => 'POST',
// 'content' => json_encode($data_to_send),
// 'header' => "Content-Type: application/json\n"
// )
// );
// $context = stream_context_create($options_header);
// file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token",false,$context);
// }
// 
?>
 
 
 









