$(document).ready(function(){
    // initialise select fields
    $('select').formSelect({
        // specify options here
    });

    //initialise character counter by input/textarea field id
    $('textarea#project_desc, input#modal_name').characterCounter();

   // $('#project_desc').val('');
   // M.textareaAutoResize($('#project_desc'));
});