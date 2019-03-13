<?php
    require_once '../../core/init.php';
    $user = new User();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Darbuotojo duomenys</title>
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="../../js/scripts.js"></script>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
        <!-- Dropdown listui -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">CRM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../tasks/head/activeTasks.php">Užduotys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Duomenų bazė</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item mr-sm-4">
                        <a href="info.php"><i class='fas fa-address-card active'id="info"></i></a>
                    </li>
                    <a href="../../logout.php"><i class='fas fa-sign-out-alt' id="logout"></i></a>
                </ul>
            </div>
        </nav>
    </header>

    <body>
        <div class="container">
            <div class="col-sm-6 offset-sm-3">

                <div class="headerBlue">
                    <h2>Slaptažodžio keitimas</h2>
                </div>

                <form method="post" action="" class="formaAplication">
                    <?php
                        if(Input::exists()){
                            if(Token::check(Input::get('token'))){
                                $validate = new Validate();
                                $validation = $validate->check($_POST, array(
                                    'password_current' => array(
                                        'requiredPassword' => true
    //                                        'minPassword' => 8,
    //                                        'maxPassword' => 64,
    //                                        'oneNumber' => true,
    //                                        'oneBigLetter' => true,
    //                                        'oneSmallLetter' => true,
    //                                        'oneSpecialSymbol' => true,
    //                                        'noSpaces' => true
                                    ),
                                    'password_new' => array(
                                        'required_password_new' => true,
                                        'minPasswordNew' => 8,
                                        'maxPasswordNew' => 64,
                                        'oneNumberNew' => true,
                                        'oneBigLetterNew' => true,
                                        'oneSmallLetterNew' => true,
                                        'oneSpecialSymbolNew' => true,
                                        'noSpacesNew' => true
                                    ),
                                    'password_new_again' => array(
                                        'required_password_new_again' => true,
                                        'minPasswordNewAgain' => 8,
                                        'maxPasswordNewAgain' => 64,
                                        'oneNumberNewAgain' => true,
                                        'oneBigLetterNewAgain' => true,
                                        'oneSmallLetterNewAgain' => true,
                                        'oneSpecialSymbolNewAgain' => true,
                                        'noSpacesNewAgain' => true,
                                        'matchesPasswordNewAgain' => 'password_new'
                                    )
                                ));

                                if($validation->passed()){
                                    if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->slaptazodis){
                                        echo '<div class="error">';
                                        echo 'Neteisingai įvestas dabartinis slaptažodis';
                                        echo'</div>';
                                    } else{
                                        $salt = Hash::salt(32);
                                        $user->update(array(
                                            'slaptazodis' => Hash::make(Input::get('password_new'), $salt),
                                            'salt' => $salt
                                        ));

                                        Session::flash('home', 'Slaptažodis sėkmingai pakeistas');
                                        Redirect::to('info.php');
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
                            <label for="password_current" class="col-sm-4 col-form-label">Dabartinis slaptažodis</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password_current" id="password_current" placeholder="Įveskite norimą keisti slaptažodį" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_new" class="col-sm-4 col-form-label">Naujas slaptažodis</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password_new" id="password_new" placeholder="Įveskite naują slaptažodį" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_new_again" class="col-sm-4 col-form-label">Pakartoti slaptažodį</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password_new_again" id="password_new_again" placeholder="Įveskite naują slaptažodį dar kartą" value="">
                            </div>
                        </div>

                        <div class="my-2 my-lg-0">
                            <button type="submit" class="btn btn-primary my-2 my-sm-0 btnRight" name="login_btn" value="Change">Atnaujinti slaptažodį</button>
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>