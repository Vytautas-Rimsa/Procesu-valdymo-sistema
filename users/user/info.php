<?php
    require_once('../../core/init.php');
    require_once('../../classes/User.php');

    $user = new User();
    if(!$user->exists()){
        Redirect::to(404);
    } else{
        $data = $user->data();
    }
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">CRM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../tasks/user/activeTasks.php">Užduotys</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href="../../database/user/database.php">Duomenų bazė</a>
                    </li>                            
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item mr-sm-4">
                        <a href="#"><i class='fas fa-address-card'id="infoLight"></i></a>
                    </li>
                    <a href="../../logout.php"><i class='fas fa-sign-out-alt' id="logoutLight"></i></a>
                </ul>                
            </div>
        </nav>
    </header>

	<body>    
        <div class="container">
            <div class="col-sm-6 offset-sm-3">
                <div class="headerSilver">
		            <h2>Darbuotojo duomenys</h2>
	            </div>

                <form method="post" action="info.php" class="userFormaAplication">
                    <fieldset>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label userWords">Vardas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputName" id="inputName" placeholder="" value="<?php echo escape($data->vardas); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label userWords">Pavardė</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputSurname" id="inputSurname" placeholder="" value="<?php echo escape($data->pavarde); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label userWords">El. paštas</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="elpastas" id="inputEmail" placeholder=""  value="<?php echo escape($data->elpastas); ?>">
                            </div>
                        </div>                               

                        <div class="form-group row">          
                            <label for="exampleSelect1" class="col-sm-3 col-form-label userWords">Skyrius</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="departamentas" id="departamentas" placeholder="" value="<?php echo escape($data->skyrius); ?>">
                            </div>                       
                        </div>

                        <div class="form-group row">          
                            <label for="exampleSelect1" class="col-sm-3 col-form-label userWords">Pareigybė</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pareigos" id="post" placeholder="" value="<?php echo escape($data->pareigos); ?>">
                            </div>                       
                        </div>
                        <div class="form my-2 my-lg-0">
                            <a href="changepassword.php" class="btn userButton my-2 my-sm-0 btnRight">Pakeisti slaptažodį</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>        
    </body>
</html>