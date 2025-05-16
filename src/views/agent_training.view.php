<section id="dashboard" class="dashboard">
    <div class="container">
        <h1>Agent Training Options</h1>        
    </div>
    <div class="container">
        <h2>Training Prompt</h2>
        <p>Write the agent promt to assists your chat users.</p>

        <?php $prompt = get_option('chatbot_ai_openai_agent_prompt'); ?>

        <textarea style="width:100%;max-width:300px;" id="chatbot_ai_agent_prompt" name="chatbot_ai_agent_prompt" class="chatbot_ai_agent_prompt form-control" rows="5" placeholder="ex. You are a helpful assistant."><?php echo $prompt; ?></textarea>
        <br/>
        <button id="chatbot_ai_train_button" name="chatbot_ai_train_button" type="button" class="chatbot_ai_train_button btn btn-primary">
            <span class="save_text">Save</span>            
        </button>
</section>