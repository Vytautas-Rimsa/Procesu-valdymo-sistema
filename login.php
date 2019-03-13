<?php 
    require_once 'core/init.php';
?>
<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Prisijungti</title>	
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="js/scripts.js"></script>
    </head>   

	<body>    
        <div class="container">
            <div class="col-sm-6 offset-sm-3">
                <div class="headerBlue">
		            <h2>Prisijungimas prie sistemos</h2>
	            </div>
                <form method="post" action="" class="formaAplication">
                    <?php
                        if(Input::exists()){
                            if(Token::check(Input::get('token'))){
                                $validate = new Validate();
                                $validation = $validate->check($_POST, array(
                                    'elpastas' => array('required' => true),
                                    'slaptazodis' => array('required' => true)
                                ));
                                if($validation->passed()){
                                    $user = new User();
                                    $remember = (Input::get('remember') === 'on') ? true : false;
                                    $login = $user->login(Input::get('elpastas'), Input::get('slaptazodis'), $remember);

                                    if($login && $user->hasPermission('admin')){
                                        Redirect::to('tasks/admin/activeTasks.php');
                                    } elseif($login && $user->hasPermission('head')){
                                        Redirect::to('tasks/head/activeTasks.php');
                                    }elseif($login && $user->hasPermission('employee')){
                                        Redirect::to('tasks/user/activeTasks.php');
                                    }else{
                                        echo '<div class="error">';
                                        echo 'Prisijungti nepavyko<br>Neteisingai įvestas elektroninio pašto adresas arba slaptažodis';
                                        echo'</div>';
                                    }
                                }else {
                                    echo '<div class="error">';
                                    foreach($validation->errors() as $error){
                                        echo $error, '<br>';
                                    }
                                    echo'</div>';
                                }
                            }
                        }
                    ?>
                    <fieldset>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">El. paštas</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="elpastas" id="inputEmail" placeholder="El. paštas" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Slaptažodis</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="slaptazodis" id="inputPassword" placeholder="Slaptažodis" value="">
                            </div>
                        </div>

                        <div class="my-2 my-lg-0">
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            <input type="checkbox" name="remember" id="remember"> <label for="remember">Prisiminti mane</label>
                            <button type="submit" class="btn btn-primary my-2 my-sm-0 btnRight" name="login_btn">Prisijungti</button>
                         </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>