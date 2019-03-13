<?php
    require_once 'core/init.php';

    if(Session::exists('home')){
        echo Session::flash('home');
    }
    $user = new User();
?>
<!--<!DOCTYPE html>-->
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prisijungimas</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="js/scripts.js"></script>
    </head>
    <body class="indeksas">
        <div class="content">
            <?php
                if($user->isLoggedIn() && $user->hasPermission('admin')){
                    redirect::to('tasks/admin/activeTasks.php');
                } elseif($user->isLoggedIn() && $user->hasPermission('head')){
                    redirect::to('tasks/head/activeTasks.php');
                } elseif($user->isLoggedIn() && $user->hasPermission('employee')){
                    redirect::to('tasks/user/activeTasks.php');
                } else{
                    echo '<a href="login.php"> <img class="displayed" src="images/gear.jpg" alt="clockGear"> </a>';
                }
            ?>
        </div>
    </body>
</html>