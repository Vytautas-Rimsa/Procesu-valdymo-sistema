
<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">		
		<title>Darbuotojo redagavimas</title>	
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../../js/scripts.js"></script>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
<!-- Dropdown listui -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">CRM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../tasks/admin/activeTasks.php">Užduotys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Darbuotojai</a>
                    </li>                                   
                    <li class="nav-item">
                        <a class="nav-link" href="#">Duomenų bazė</a>
                    </li>                                                       
                </ul>                
                <ul class="nav navbar-nav navbar-right"> 
                    <a href="../../logout.php"><i class='fas fa-sign-out-alt' id="logout"></i></a>
                </ul>
            </div>
        </nav>
    </header>

	<body>    
        <div class="container">
            <div class="col-sm-6 offset-sm-3">
                
                <div class="header">
		            <h2>Redaguoti darbuotojo duomenis</h2>
	            </div>
            
                <form method="post" action="editUser.php" class="formaAplication">
                    <fieldset>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Vardas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="newName" id="" placeholder="" value="<!--<?php echo $row[1]; ?>-->">
                                <input type="hidden" class="form-control" name="darb_id" id="" placeholder="" value="<!--<?php echo $row[0]; ?>-->">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Pavardė</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="newSurname" id="" placeholder="" value="<!--<?php echo $row[2]; ?>-->">
                                <input type="hidden" class="form-control" name="darb_id" id="" placeholder="" value="<!--<?php echo $row[0]; ?>-->">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">El. paštas</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="newEmail" id="" placeholder="" value="<!--<?php echo $row[3]; ?>-->">
                                <input type="hidden" class="form-control" name="darb_id" id="" placeholder="" value="<!--<?php echo $row[0]; ?>-->">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Slaptažodis</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="newPassword" id="" placeholder="" value="<!--<?php echo $row[4]; ?>-->">
                                <input type="hidden" class="form-control" name="darb_id" id="" placeholder="" value="<!--<?php echo $row[0]; ?>-->">
                            </div>
                        </div>
         
                        <div class="form-group row">          
                            <label for="exampleSelect1" class="col-sm-3 col-form-label">Skyrius</label>
                            <div class="col-sm-9">
			                    <select class="form-control" name="newDepartment" id="department" value="<!--<?php echo $row[5]; ?>-->">
                                    <option value="">Pasirinkite skyrių</option>
				                    <option value="Administracija">Administracija</option>
									<option value="Apsaugos skyrius">Apsaugos skyrius</option>
									<option value="Finansų skyrius">Finansų skyrius</option>
                                    <option value="Komercijos skyrius">Komercijos skyrius</option>
                                    <option value="Personalo skyrius">Personalo skyrius</option>
                                    <option value="Techninis skyrius">Techninis skyrius</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">          
                            <label for="exampleSelect1" class="col-sm-3 col-form-label">Pareigybė</label>
                            <div class="col-sm-9">
			                    <select disabled="disabled" class="form-control subcat" name="newPost" id="" value="<!--<?php echo $row[6]; ?>-->">
                                    <option value="">Pasirinkite pareigybę</option>
                                    <optgroup data-rel="Administracija">
				                        <option value="Administratore">Administratorė</option>
                                        <option value="Direktorius">Direktorius</option>
                                        <option value="Teisinikas">Teisinikas</option>
                                    </optgroup>
                                    <optgroup data-rel="Finansų skyrius">
				                        <option value="Vyr. buhalterė">Vyr. buhalterė</option>
                                        <option value="Buhalterė">Buhalterė</option>                                        
                                    </optgroup>
                                    <optgroup data-rel="Apsaugos skyrius">
				                        <option value="Skyriaus vadovas">Skyriaus vadovas</option>
                                        <option value="Padalinio vadovas">Padalinio vadovas</option>                                        
                                    </optgroup>
                                    <optgroup data-rel="Komercijos skyrius">
				                        <option value="Skyriaus vadovas">Skyriaus vadovas</option>
                                        <option value="Projektų vadovas">Projektų vadovas</option>
                                        <option value="Vadybininkas">Vadybininkas</option>
                                        <option value="Klientų aptarnavimo vadybininkas">Klientų aptarnavimo vadybininkas</option>
                                    </optgroup>
                                    <optgroup data-rel="Personalo skyrius">
				                        <option value="Skyriaus vadovas">Skyriaus vadovas</option>
                                        <option value="Vadybininkas">Vadybininkas</option>                                        
                                    </optgroup>
                                    <optgroup data-rel="Techninis skyrius">
				                        <option value="Skyriaus vadovas">Skyriaus vadovas</option>
                                        <option value="Projektų vadovas">Projektų vadovas</option>
                                        <option value="IT administratorius">IT administratorius</option>
                                        <option value="CSP inžinierius">CSP inžinierius</option>
                                        <option value="CSP vyr. operatorius">CSP vyr. operatorius</option>
                                    </optgroup>                            
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">          
                            <label for="exampleSelect1" class="col-sm-3 col-form-label">Darbuotojo rolė</label>
                            <div class="col-sm-9">
			                    <select class="form-control" name="newUser_type" id="" value="<!--<?php echo $row[7]; ?>-->">
                                    <option value="">Pasirinkite darbuotojo rolę</option>
				                    <option value="1">Administratorius</option>
                                    <option value="2">Skyriaus vadovas</option>
                                    <option value="3">Darbuotojas</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-inline my-2 my-lg-0">
                            <button type="submit" class="btn adminButton my-2 my-sm-0" name="updateUser">Atnaujinti</button>             
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>