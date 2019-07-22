<?php
require_once 'google-api-php-client-2.2.3/vendor/autoload.php';


$client = new \Google_Client();
$client->setApplicationName('Google Sheets and PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig('google-api-php-client-2.2.3/credentials.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "";

$smr = 0; $lmp = 0; $sbr = 0; $lob = 0;
$mbd = 0; $mla = 0; $tgg = 0;
for ($x=2; $x<60; $x++){
  $range = "E$x";
  $response = $service->spreadsheets_values->get($spreadsheetId, $range);
  $values = $response->getValues();
  if(empty($values)) {
  }else {
    foreach ($values as $row) {
      if ($row[0] == "SMR1"){
        $smr++;
      }elseif ($row[0] == "LMP"){
        $lmp++;
      }elseif ($row[0] == "SBR"){
        $sbr++;
      }elseif ($row[0] == "LOB"){
        $lob++;
      }elseif ($row[0] == "MBD"){
        $mbd++;
      }elseif ($row[0] == "MLA"){
        $mla++;
      }elseif ($row[0] == "TGG"){
        $tgg++;
      }
    }
  }
}

echo "Try sending message. \n";
// echo "DATA CMDF \nSMR1 = $smr \nLMP = $lmp \nSBR = $sbr \nLOB = $lob \nMBD = $mbd \nMLA = $mla \nTGG = $tgg \n";

$chat_id = ; 
$text = "DATA SEKTOR \nSMR1 = $smr \nLMP = $lmp \nSBR = $sbr \nLOB = $lob \nMBD = $mbd \nMLA = $mla \nTGG = $tgg" ;
$disable_web_page_preview = null;
$reply_to_message_id = null;
$reply_markup = null;

$data = array(
        'chat_id' => $chat_id,
        'text' => $text,
        'disable_web_page_preview' => urlencode($disable_web_page_preview),
        'reply_to_message_id' => urlencode($reply_to_message_id),
        'reply_markup' => urlencode($reply_markup)
    );

$url = "https://api.telegram.org/botYOUR_BOT_TOKEN/sendMessage";

//  open connection
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($data));
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
echo "Success send message";

?>
