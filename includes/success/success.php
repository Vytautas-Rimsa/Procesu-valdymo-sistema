<?php
$success = array();

function display_success() {
    global $success;

    if (count($success) > 0){
        echo '<div class="successDiv">';
        foreach ($success as $option){
            echo $option .'<br>';
        }
        echo '</div>';
    }
}