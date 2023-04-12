$(document).ready(function(){
    toggleInput();
    $("#imageUpload").change(function(){
        toggleInput();
    });
});

function toggleInput(){
    if($("#multiple_images").val() === "true"){
        $("#imageUpload").show();
    }
    else {
        $("#imageUpload").hide();
    }
}