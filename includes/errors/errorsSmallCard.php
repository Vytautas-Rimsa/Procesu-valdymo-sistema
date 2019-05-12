<?php
$errors = array();

function display_error_small() {
    global $errors;

    if (count($errors) > 0){
        echo '<div class="errorDivSmallCard">';
        foreach ($errors as $error){
            echo $error .'<br>';
        }
        echo '</div>';
    }
}