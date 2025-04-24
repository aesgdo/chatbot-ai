<section id="dashboard" class="dashboard">
    <div class="container">
        <h1>API's Configurations</h1>        
    </div>
    <div class="container">
        <h2>OpenAI API key</h2>
        <p>Copy and paste your OpenAI API key here.</p>        
        <input type="password" class="form-control" placeholder="Enter OpenAI API key" id="openai-api-key">
        <button type="button" class="btn btn-primary">
            <span class="save_text">Save</span>
            <span class="remove_text no-show">Remove</span>
        </button>
    </div>
    <small>See <a href="https://platform.openai.com/api-keys" target="_blank">https://platform.openai.com/api-keys</a> to create your API key. Ensure that you have all permition to use it.</small>
    <div class="container">
        <h2>Select Your Default Model</h2>
        <select name="" id="">
            <option value="o4-mini">o4-mini (recommended)</option>
            <option value="gpt-4.1">gpt-4.1</option>
            <option value="gpt-4.1-mini">gpt-4.1-mini</option>
            <option value="gpt-4.1-nano">gpt-4.1-nano</option>
            <option value="gpt-4o-mini">gpt-4o-mini</option>
        </select>
        <button type="button" class="btn btn-primary">
            <span class="save_text">Save</span>
            <span class="remove_text no-show">Remove</span>
        </button>        
    </div>
    <small>See <a href="https://platform.openai.com/docs/models" target="_blank">https://platform.openai.com/docs/models</a> for a full description about this models.</small>
</section>