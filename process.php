<?php
include('Parsedown.php');
$configs = include('config.php');
try {
    if(isset($_POST['submit'])){
        // create curl resource
      $ch = curl_init();
        $userquery = $_POST['message'];
        $query = curl_escape($ch,$_POST['message']);
        $sessionid = curl_escape($ch,$_POST['sessionid']);
        curl_setopt($ch, CURLOPT_URL,
            "https://api.dialogflow.com/v1/query?v=20150910&query=".$query."&lang=en&sessionId=".$sessionid);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Authorization: Bearer '.trim($configs['CLIENT_ACCESS_TOKEN'])));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        $dec = json_decode($output);
       // echo "<pre>"; print_r($output); die;

        $messages = isset($dec->result->fulfillment->messages) ? $dec->result->fulfillment->messages : array();
        $action = isset($dec->result->action) ? $dec->result->action : array();
        $intentid = isset($dec->result->metadata->intentId) ? $dec->result->metadata->intentId : array();
        $intentname = isset($dec->result->metadata->intentName) ? $dec->result->metadata->intentName : array();
        $isEndOfConversation = isset($dec->result->metadata->endConversation) ? $dec->result->metadata->endConversation : array();
        $speech = '';
        for($idx = 0; $idx < count($messages); $idx++){
            $obj = $messages[$idx];
            if($obj->type=='0'){
                $speech = $obj->speech;
            }
        }

        $Parsedown = new Parsedown();
        $transformed= $Parsedown->text($speech);
        $response = new \stdClass();
        $response -> speech = $transformed;
        $response -> messages = $messages;
        $response -> isEndOfConversation = $isEndOfConversation;
        echo json_encode($response);
        // close curl resource to free up system resources
        curl_close($ch);
    }
}catch (Exception $e) {
    $speech = $e->getMessage();
    $fulfillment = new stdClass();
    $fulfillment->speech = $speech;
    $result = new stdClass();
    $result->fulfillment = $fulfillment;
    $response = new stdClass();
    $response->result = $result;
    echo json_encode($response);
}

?>