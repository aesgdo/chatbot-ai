<?php 


function launch_chatbot_ai() {

   echo <<<EOD
   
      <div id="chatbot_ai_wrapper" class="chatbot_ai_wrapper botton_right">
      
         <div class="chatbot_ai_container no-show">

            <div class="chatbot_ai_header">
               
            </div>
               
         </div>

         <button id="chatbot_ai_button" class="chatbot_ai_button">
            <span class="message_icon"><i class="fa-regular fa-message"></i></span>
            <span class="no-show"><i class="fas fa-times"></i></span>
         </button>

      </div>
   
   EOD;

}