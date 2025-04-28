<div id="chatbot_ai_wrapper" class="chatbot_ai_wrapper botton_right">
      
    <div class="chatbot_ai_container no-show">

    <div class="chatbot_ai_header">
        <div class="chatbot_ai_image_wrap">
            <?php
                $botface_image = plugin_dir_url(__FILE__) . '../../assets/images/botface300x300.png';
                $botface_image = esc_url($botface_image);
            ?>
            <img style="width:100%" src="<?php echo $botface_image; ?>"/>
        </div>               
        <span>Bienvenid@</span>
    </div>

    <div class="chatbot_ai_body">
        <div class="chatbot_ai_body_message_wrap">

            <div class="welcome_message">
                <p>Hola, soy un asistente virtual. ¿Cuál es tu nombre?</p>
            </div>

            <div class="chatbot no-show">
                <p><span class="title">Chatbot:</span><br><span class="msg">Hola, soy un asistente virtual. ¿Cuál es tu nombre?</span></p>
            </div>

            <!-- <div class="user no-show">
                <p><span class="title">Yo:</span><br><span class="msg">Pepe</span></p>
            </div>

            <div class="chatbot no-show">
                <p><span class="title">Chatbot:</span><br><span class="msg">Hola, Pepe, en que puedo ayudarte?</span></p>
            </div>

            <div class="user no-show">
                <p><span class="title">Yo:</span><br><span class="msg">cuales servicios ofrecen en esta pagina.</span></p>
            </div>

            <div class="chatbot no-show">
                <p><span class="title">Chatbot:</span><br><span class="msg">Son muchos, mejor dique que buscas?</span></p>
            </div>

            <div class="user no-show">
                <p><span class="title">Yo:</span><br><span class="msg">Quiero una beca</span><br><span class="msg">para poder estudiar Derecho</span></p>
                
            </div> -->
            
        </div>

        <div class="chatbot_ai_body_input_wrap">
            <input type="text" id="chatbot_ai_input" class="chatbot_ai_input" placeholder="Escribe tu nombre aquí..." required>
            <br>
            <button id="chatbot_ai_btn_start" class="chatbot_ai_btn_start">
                <span>Iniciar Chat</span>
                <span class="send_msg_icon no-show"><i class="fa-regular fa-paper-plane"></i></span>
            </button>
        </div>
    </div>
        
    </div>

    <button id="chatbot_ai_button" class="chatbot_ai_button">
        <span class="message_icon"><i class="fa-regular fa-message"></i></span>
        <span class="no-show"><i class="fas fa-times"></i></span>
    </button>

</div>