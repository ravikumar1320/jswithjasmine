<?php
/**
 * Form constructor for the admin settings form to add access token.
 *
 */
/*
 * Create form to add access token
 */
function drupalform_add_accesskey(){
     $query = db_select('chatbot_data', 'n')
        ->fields('n')
        ->execute();
    $num = $query->fetchAll();
    $defaultvalue = isset($num[0]->access_token) ? $num[0]->access_token : '';


       $form['ch_accesskey']=array(
        '#title' => t('Access token/key'),
        '#type' => 'textfield',
        '#default_value' => $defaultvalue,
        '#description'=>t('Add/edit dialogflow access token')
    );
    $form['submit']=array(
        '#type'=>'submit',
        '#value'=>t('Submit')
    );

    return $form;
}

/*
 * Validate the input value if it is not empty
 */
function drupalform_add_accesskey_validate(&$form, &$form_state){
    $token_value = $form_state['values']['ch_accesskey'];
    if(empty($token_value))
    {
        form_set_error('ch_accesskey', t('Please enter the access token.'));
    }
}

/*
 * Submit the form and saved the token value in the database
 */
function drupalform_add_accesskey_submit(&$form, &$form_state)
{
    $formId = isset($form['#form_id']) ? $form['#form_id'] : '';

    if ($formId == 'drupalform_add_accesskey' && $formId != '') {
        $token_value = isset($form_state['values']['ch_accesskey']) ? $form_state['values']['ch_accesskey'] : array();

        $query = db_select('chatbot_data', 'n')
            ->fields('n')
            ->execute();
        $num = $query->rowCount();

        if ($num == 0) {
            $nid = db_insert('chatbot_data')
                ->fields(array(
                    'access_token' => $token_value,
                    'updated' => time()
                ))
                ->execute();
            drupal_set_message(t('Access token saved'));
        } else {
            $num_updated = db_update('chatbot_data')
                ->fields(array(
                    'access_token' => $token_value,
                    'updated' => time()
                ))
                ->execute();
            drupal_set_message(t('Access token updated'));
        }
    }
}

function chatbot_visibility(){
    $data='';
    $sessionID = isset($_POST['sessionid']) ? $_POST['sessionid'] : '';
    $ch_container = isset($_POST['content']) ? $_POST['content'] : '';
    if($ch_container=='null'){
        $ch_container ='';
    }
    
    if(isset($_POST)){
         if($_POST['chatbot_visible']!=''){
               if($_POST['chatbot_visible'] == 1){
                       $_SESSION['chatbot_visible'] = 1;
                      
                                                $data.= '<div class="chatbox-holder">
  <div class="chatbox">
    <div class="chatbox-top">

      <div class="chat-partner-name">
        <span class="status online"></span>
        <a target="_blank" href="#">Welcome to Atlas</a>
      </div>
      <div class="chatbox-icons">
        <a href="javascript:void(0);"><i class="fa fa-minus"></i></a>
        <a href="javascript:void(0);"><i class="fa fa-close"></i></a>       
      </div>      
    </div>
    
    <div class="chat-messages" id="chat-messages">
   '.$ch_container.'
    </div>
     <form id = "chatbot-form">
    <div class="chat-input-holder">
      <input class="chat-input" id="message" placeholder="Write something and press Enter..."></input>
      <input type="submit"  value="Send" class="message-send" />
    </div>
     </form>
  </div>
  

</div>';

$data.='
<span style="display: none;" id="sessionId">
      
'. $sessionID.'
    
</span>
';
       
                 }
                 if($_POST['chatbot_visible'] == 0){
                       $_SESSION['chatbot_visible'] = 0;
                 }
 
             }
             
         
    }
      drupal_json_output(array('data' => $data));
}