<?php
$errors = array();

function display_error() {
    global $errors;

    if (count($errors) > 0){
        echo '<div class="errorDiv">';
        foreach ($errors as $error){
            echo $error .'<br>';
        }
        echo '</div>';
    }
}