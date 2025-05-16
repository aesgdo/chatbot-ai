<section id="dashboard" class="dashboard">
    <div class="container">
        <h1>API's Configurations</h1>        
    </div>
    <div class="container">
        <h2>OpenAI API key</h2>

        <?php 
            
            $currentkey = "sk-...HIDDEN"; // default value

            $apikey = get_option('chatbot_ai_openai_api_key'); 

            if ( empty($apikey) ){
                $currentkey = "";
            } 
        ?>

        <p>Copy and paste your OpenAI API key here.</p>        
        <input id="chatbot_ai_openai_apikey" name="chatbot_ai_openai_apikey" type="text" class="chatbot_ai_openai_apikey form-control" value="<?php echo $currentkey; ?>" placeholder="ex. sk-....DFGE">
        <button id="chatbot_ai_apikey_button" name="chatbot_ai_apikey_button" type="button" class="chatbot_ai_apikey_button btn btn-primary">
            <span class="save_text">UPDATE</span>            
        </button>
    </div>
    <small>See <a href="https://platform.openai.com/api-keys" target="_blank">https://platform.openai.com/api-keys</a> to create your API key. Ensure that you have all permition to use it.</small>
    <div class="container">
        <h2>Select Your Default Model</h2>

        <?php $model = get_option('chatbot_ai_openai_model'); ?>

        <?php

            $array_models = [
                "o4-mini" => "o4-mini (recommended)",
                "gpt-4.1" => "gpt-4.1",
                "gpt-4.1-mini" => "gpt-4.1-mini",
                "gpt-4.1-nano" => "gpt-4.1-nano",
                "gpt-4o-mini" => "gpt-4o-mini",
            ];

            $options = array_map(function($value, $key) use ($model) {
                $selected = ($model == $key) ? 'selected' : '';
                return "<option value='$key' $selected>$value</option>";
            }, $array_models, array_keys($array_models));
            
        ?>

        <select name="chatboit_ai_model_select" id="chatboit_ai_model_select" class="chatboit_ai_model_select">
            <?php echo implode('', $options); ?>
        </select>               
    </div>
    <small>See <a href="https://platform.openai.com/docs/models" target="_blank">https://platform.openai.com/docs/models</a> for a full description about this models.</small>
</section>