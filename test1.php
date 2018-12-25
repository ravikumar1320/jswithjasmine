<?php
$username = 'ADMIRAL.UK\DAVIESH4';
$hash = hash('sha512', $username.gmdate('Y-m-d H', time()));
$fields = array('field_user_payroll','field_user_department');

$data = array('domain' => $username, 'hash_id' => $hash, 'fields' => json_encode($fields));

$data_string = json_encode($data);                                                            
                                                                                                                  
$ch = curl_init(); 
      curl_setopt($ch, CURLOPT_URL,
            "http://staging.atlas.admiralgroup.lan/userauth");
curl_setopt($ch, CURLOPT_POST, 1);                                                                   
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, 1);
curl_setopt($ch, CURLOPT_USERPWD, "admiral.uk\lihw:HexaBin08");                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Accept: application/json'
)                                                                   
);                                                                                                               
                                                                                                     
$result = curl_exec($ch);
print_r($result);
print_r(json_decode($result));
