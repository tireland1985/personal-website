$(document).ready(function(){
    $('select').formSelect({
        // specify options here
    });

    $('#project_desc').val('');
    M.textareaAutoResize($('#project_desc'));
});