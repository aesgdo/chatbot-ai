<?php 


function launch_chatbot_ai() {

   $botface_image = plugin_dir_url(__FILE__) . '../../assets/images/botface300x300.png';
   $botface_image = esc_url($botface_image);

   echo <<<EOD
   
      <div id="chatbot_ai_wrapper" class="chatbot_ai_wrapper botton_right">
      
         <div class="chatbot_ai_container no-show">

            <div class="chatbot_ai_header">
               <div class="chatbot_ai_image_wrap">
                  <img style="width:100%" src="$botface_image"/>
               </div>               
               <span>Bienvenid@</span>
            </div>

            <div class="chatbot_ai_body">
               <div class="chatbot_ai_body_message_wrap">
                  <p>Hola, soy un asistente virtual. ¿Cuál es tu nombre?</p>
               </div>
               <div class="chatbot_ai_body_input_wrap">
                  <input type="text" id="chatbot_ai_input" class="chatbot_ai_input" placeholder="Escribe tu nombre aquí...">
                  <br>
                  <button id="chatbot_ai_btn_start" class="chatbot_ai_btn_start">
                   <span>Iniciar Chat</span>
                  </button>
               </div>
            </div>
               
         </div>

         <button id="chatbot_ai_button" class="chatbot_ai_button">
            <span class="message_icon"><i class="fa-regular fa-message"></i></span>
            <span class="no-show"><i class="fas fa-times"></i></span>
         </button>

      </div>
   
   EOD;

}