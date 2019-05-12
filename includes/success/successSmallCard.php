<?php
$success = array();

function display_success_small() {
    global $success;

    if (count($success) > 0){
        echo '<div class="successDivSmallCard">';
        foreach ($success as $option){
            echo $option .'<br>';
        }
        echo '</div>';
    }
}