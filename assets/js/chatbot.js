jQuery(function () {

    window.initialMessageDisplayed = false;
    var guid = (jQuery("#sessionId").text()).trim();


     jQuery('.message-send').click(function (e) {
        var query = jQuery("#message").val();
        showUserText();
        e.preventDefault();


        jQuery.ajax({
            type: 'post',
            url: 'chat_process',
            data: {submit:true, message:query, sessionid: guid},
            success: function (response) {
                jQuery('#message').focus();
              
                var responseObj = response;
                var speech = responseObj.speech;
                var messages = responseObj.messages[0];
                var eoc = responseObj.isEndOfConversation;
                
                var answerRow = jQuery('<div/>',{
                    'class':'message-box-holder'
                });
                var answerCol = jQuery('<div/>',{
                    'class':'message-box message-partner'
                });
                var answerContainerDiv = jQuery('<div/>',{
                    'class':"float-right",
                    tabindex:0
                });

                jQuery('#chat-messages').append(answerRow);
                jQuery(answerRow).append(answerCol);
                jQuery(answerCol).append(answerContainerDiv);


                var textFromDefaultResponse = speech;
                if (textFromDefaultResponse.trim()!==''){
                    renderDefaultResponse(textFromDefaultResponse,answerContainerDiv);
                }
                renderRichControls(messages, answerContainerDiv);

                var objDiv = document.getElementById("chat-messages");
                objDiv.scrollTop = objDiv.scrollHeight;
            }
        });
    });
     jQuery('.fa-minus').click(function(){   jQuery(this).closest('.chatbox').toggleClass('chatbox-min');
  });
  jQuery('.fa-close').click(function(){
    jQuery(this).closest('.chatbox').hide();
       jQuery.ajax({
            type: 'post',
            url: 'set_session',
            data: {chatbot_visible:0, sessionid: guid},
            success: function (response) {

            }
        });


    
  });
      jQuery('.chatbox-holder').removeClass("toshow");
    jQuery('.chatbox-holder').addClass("tohide");
  jQuery('a#option-4.support-option').click(function(){
   jQuery('.chatbox-holder').removeClass("tohide");
      jQuery('.chatbox-holder').addClass("toshow");
     var ch_container = jQuery('.chat-messages').html();
   jQuery.ajax({
            type: 'post',
            url: 'set_session',
            data: {chatbot_visible:1, 
                sessionid: guid,
                content:ch_container},
            success: function (response) {
                jQuery('.chatbox-container').html(response.data);
                                     jQuery('.message-send').click(function (e) {
        var query = jQuery("#message").val();
        showUserText();
        e.preventDefault();


        jQuery.ajax({
            type: 'post',
            url: 'chat_process',
            data: {submit:true, message:query, sessionid: guid},
            success: function (response) {
                jQuery('#message').focus();
              
                var responseObj = response;
                var speech = responseObj.speech;
                var messages = responseObj.messages[0];
                var eoc = responseObj.isEndOfConversation;
                
                var answerRow = jQuery('<div/>',{
                    'class':'message-box-holder'
                });
                var answerCol = jQuery('<div/>',{
                    'class':'message-box message-partner'
                });
                var answerContainerDiv = jQuery('<div/>',{
                    'class':"float-right",
                    tabindex:0
                });

                jQuery('#chat-messages').append(answerRow);
                jQuery(answerRow).append(answerCol);
                jQuery(answerCol).append(answerContainerDiv);


                var textFromDefaultResponse = speech;
                if (textFromDefaultResponse.trim()!==''){
                    renderDefaultResponse(textFromDefaultResponse,answerContainerDiv);
                }
                renderRichControls(messages, answerContainerDiv);

                var objDiv = document.getElementById("chat-messages");
                objDiv.scrollTop = objDiv.scrollHeight;
            }
        });
    });
                  jQuery('.fa-minus').click(function(){   jQuery(this).closest('.chatbox').toggleClass('chatbox-min');
  });
                  jQuery('.fa-close').click(function(){
    jQuery(this).closest('.chatbox').hide();
       jQuery.ajax({
            type: 'post',
            url: 'set_session',
            data: {chatbot_visible:0, sessionid: guid},
            success: function (response) {
                
            }
        });

    
  });
  
            }
        });
  });
  
});
function renderRichControls(data, parent){

    var i,len = data.length;
    for(i=0;i<len;i++){
        if(data[i] && data[i].hasOwnProperty('type')){
            if(data[i]['type']==='link_out_chip' &&
                data[i]['platform']==='google'){
                renderLinkOutSuggestion(data[i],parent);
            }
            if(data[i]['type']==='simple_response' &&
                data[i]['platform']==='google'){
                renderSimpleResponse(data[i],parent);
            }
            if(data[i]['type']==='basic_card' &&
                data[i]['platform']==='google'){
                renderBasicCard(data[i],parent);
            }
            if(data[i]['type']==='list_card' &&
                data[i]['platform']==='google'){
                renderList(data[i],parent);
            }
            if(data[i]['type']==='carousel_card' &&
                data[i]['platform']==='google'){
                renderCarousel(data[i],parent);
            }
        }
    }

    for(i=0;i<len;i++){
        if(data[i] && data[i].hasOwnProperty('type')){
            if(data[i]['type']==='suggestion_chips' &&
                data[i]['platform']==='google'){
                renderSuggestionChips(data[i],parent);
            }
        }
    }

}

function renderDefaultResponse(textFromDefaultResponse,parent){
//    var simpleResponseRow = jQuery('<div/>',{
//        class:'message-box-holder'
//    });
    var simpleResponseDiv = jQuery('<div/>',{
        class:''
    });
 //   jQuery(simpleResponseRow).append(simpleResponseDiv);
    jQuery(simpleResponseDiv).html(textFromDefaultResponse);
    parent.append(simpleResponseDiv);
}


function renderSimpleResponse(data, parent){
    var simpleResponseDiv = jQuery('<div/>',{
        'class':'message-box-holder'
    });
    var simpleResponseInnerDiv = jQuery('<div/>',{
        'class':'message-box message-partner'
    });
    var simpleResponseText = jQuery('<p/>',{
        html:data['textToSpeech'],
        tabindex:1
    });
    simpleResponseDiv.append(simpleResponseInnerDiv);
    simpleResponseInnerDiv.append(simpleResponseText);
    parent.append(simpleResponseDiv);
}



function showUserText(){
    var userMessageRow = jQuery('<div/>',{
        class:'message-box-holder'
    });
    var div = jQuery('<div/>', {
        text: jQuery("#message").val(),
        'class': "message-box",
        tabindex:1
    });
    jQuery(userMessageRow).append(div);
    jQuery("#chat-messages" ).append(userMessageRow);
    jQuery("#message").val('');
}

function truncateString(input, charLimit){
    if(input.length > charLimit) {
        return input.truncate(charLimit)+"...";
    }
    else{
        return input;
    }
}

String.prototype.truncate = String.prototype.truncate ||
    function (n){
        return this.slice(0,n);
    };
    
