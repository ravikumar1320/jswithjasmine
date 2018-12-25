<?php      
//$a = json_encode("https://api.api.ai/v1/query?v=20150910&query=who%20are%20you%3F&lang=en&sessionId=1b5e60c8-34dd-d0fc-7746-ab3b4324c82d");

//https://api.dialogflow.com/v1/query?v=20170712&query=who%20are%20you%3F&lang=en&sessionId=1b5e60c8-34dd-d0fc-7746-ab3b4324c82d&timezone=Asia/Kolkata
//
//  $ch = curl_init();
//        $userquery = 'who are you';
//         curl_setopt($ch, CURLOPT_POST, 1);
//        $query = curl_escape($ch,$userquery);
//         //  $postData = 'v=20170712&query=who%20are%20you%3F&lang=en&sessionId=1b5e60c8-34dd-d0fc-7746-ab3b4324c82d&timezone=Asia/Kolkata';
//          $postData =  array(
//              "v" =>"20170712",
// "query"=> "who are you",
// "sessionId"=> "1b5e60c8-34dd-d0fc-7746-ab3b4324c82d",
// "timezone" => "Asia/Kolkata",
// "lang" => "en"
//);
//          
//          $postData = json_encode($postData);
//        $sessionid = curl_escape($ch,'1b5e60c8-34dd-d0fc-7746-ab3b4324c82d');
//        curl_setopt($ch, CURLOPT_URL,
//            "https://api.dialogflow.com/v1/query");
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
//            'Authorization: Bearer bec0c00fa44c4eb2898f9d9c1bfd1ba6'));
//        
//           curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
////        curl_setopt($ch, CURLOPT_PROXY, 'http://inspop-proxy.inspopcorp.com');
////curl_setopt($ch, CURLOPT_PROXYPORT, '8080');
////curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        $output = curl_exec($ch);
//          echo "<pre>"; print_r($output); die;
//        $dec = json_decode($output);


      
     $ch = curl_init();
     
         curl_setopt($ch, CURLOPT_POST, 1);
        

          
       $posted_data =   Array(
    '_wpcf7' => 1488,
    '_wpcf7_version' => '5.0.2',
    '_wpcf7_locale' => 'en_US',
    '_wpcf7_unit_tag' => 'wpcf7-f1488-p385-o1',
    '_wpcf7_container_post' => 385,
    'name' => 'test12',
    'email' => 'test12@gmail.com',
    'amount' => 'INR 962083',
    'id:income' => 100002,
);
          $name = isset($posted_data['name']) ? $posted_data['name'] : '';
    $email = isset($posted_data['email']) ? $posted_data['email'] : '';
    $amount = isset($posted_data['amount']) ? $posted_data['amount'] : 0;
    $income = isset($posted_data['id:income']) ? $posted_data['id:income'] : 0;
       
 
    $payload =  array(
    "Email" => $email,
    "Name" =>$name ,
    "Amount" => $amount,
    "Income" => $income
    );
    $Jsonpayload = json_encode($payload);
    
//    $postData =  array(
//    "Customer_ID" =>"40",
//    "CustomerActivity_ID"=> "1e1c3c6d-570d-4912-a3ef-c20885e7ea59",
//    "PayLoad"=> $Jsonpayload,
//    "ActivitySource_ID" => "1"         
//);
    
                      $postData1 =  array(
              "Customer_ID" =>"40",
 "CustomerActivity_ID"=> "1e1c3c6d-570d-4912-a3ef-c20885e7ea59",
 "PayLoad"=> $Jsonpayload,
 "ActivitySource_ID" => "1",
                "Email" => $email,
    "Name" =>$name ,
);
   

          $postData2 = json_encode($postData1);
    
        curl_setopt($ch, CURLOPT_URL,
            "http://product.inspopcorp.com/api/product/CustomerActivity");
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
           curl_setopt($ch, CURLOPT_POSTFIELDS, $postData2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
          echo "<pre>"; print_r($output); die;