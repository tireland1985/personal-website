$(document).ready(function(){
    toggleInput();
    $("#imageUpload").change(function(){
        toggleInput();
    });
});

function toggleInput(){
    if($("#multiple_images").val() === "true"){
        $("#imageUpload").show();
        $("#extended_details").show();
    }
    else {
        $("#imageUpload").hide();
        $("#extended_details").hide();
    }
}