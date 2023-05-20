<?php
function validate_extension($file){
    //define the permitted file extensions
    $allowed_exts = ['gif', 'png', 'jpg', 'jpeg'];
    $info = pathinfo($file);

    if(in_array($info['extension'], $allowed_exts)){
        return true;
    }
    else return false;
//        return false;
//    return 'Error: only ' . implode(', ', $allowed_exts) . ' are permitted';
}