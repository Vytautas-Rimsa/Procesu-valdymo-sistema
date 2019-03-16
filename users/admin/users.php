<?php
    require_once('../../core/init.php');
    require_once('../../classes/User.php');

    $user = new User();
    if(!$user->exists()){
        //Redirect::to(404);
    } else{

    }
    $data = $user->showUsers();
    $getas = @$_GET['del_user'];
    $search = @$_POST['submit-search'];

    if(!empty($getas)){
        DB::deleteUser($getas);
        header('Location: users.php');
    }

    if(!empty($search)){
        DB::searchUser($search);
        header('Location: search.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
	    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Darbuotojų sąrašas</title>	
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/scripts.js"></script>
        <script type="text/javascript" src="../../js/main.js"></script>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
        <!-- Dropdown listui -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
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
                        <a class="nav-link active" href="#">Darbuotojai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Duomenų bazė</a>
                    </li>   
                </ul>                
                <form class="nav navbar-nav navbar-right" action="search.php" method="POST">				
                    <li class="form-inline my-2 my-lg-0" >
                        <input class="form-control mr-sm-2 paieskaField" type="text" placeholder="Paieška" name="search" id="search" onkeyup="enableSearchButton()">
                        <button class="btn btn-secondary mr-sm-4 paieskaButton" type="submit" name="submit-search" id="searchButton" disabled>Paieška</button>
                    </li>					
                    <a href="../../logout.php"><i class='fas fa-sign-out-alt' id="logout"></i></a>
                </form>
            </div>
        </nav>
    </header>

	<body id="page-top">	
        <div class="container">
            <div><h3>Darbuotojų sąrašas</h3></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nr.</th>
                        <th scope="col">Vardas</th>
                        <th scope="col">Pavardė</th>
                        <th scope="col">El. paštas</th>
                        <th scope="col">Skyrius</th>
                        <th scope="col">Pareigos</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                
                <tbody>
                <?php if ($data->num_rows > 0) {
                // output data of each row
                    $i =1;
                    while($row = $data->fetch_assoc()){
                 ?>
                    <tr class="table-light">
                        <th scope="row"><?php echo $i; ?></th>
                        <td ><?php echo $row['vardas']; ?></td>
                        <td ><?php echo $row['pavarde']; ?></td>
                        <td ><?php echo $row['elpastas']; ?></td>
                        <td ><?php echo $row['skyrius']; ?></td>
                        <td ><?php echo $row['pareigos']; ?></td>
                        <td class=""><a href="editUser.php?editUser=<?php echo $row['darb_id']; ?>"><i class='fas fa-edit' id="actions"></i></a></td>
                        <td class="">
                            <a onclick="redirect('<?php echo $row['darb_id'];?>')">
                                <i class='fas fa-trash-alt' id="actions"></i>
                            </a>
                        </td>
                    </tr>
                <?php $i++;
                        }
                    } else {
                echo "Nėra įrašų";
                } ?>
                </tbody>
            </table>

            <div class="my-2 my-lg-0 addUser">
                <a href="create_user.php"><button type="submit" class="btn adminButton my-2 my-sm-0" name="addUser_btn">Pridėti darbuotoją</button></a>
            </div>
        </div>
        <div class="scroll-to-top rounded">
            <span><a href=""><i class="fas fa-angle-up upDownButton"></i> </a></span>
        </div>
    <script>
        function redirect(a){
            Swal.fire({
                title: 'Ar tikrai norite ištrinti šį darbuotoją?',
                text: "Duomenys bus negrįžtamai pašalinti iš duomenų bazės",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#555555',
                confirmButtonText: 'Ištrinti',
                cancelButtonText: 'Atšaukti'
            }).then((result) => {
                if (result.value) {
                    location.replace("users.php?del_user=" + a)
                }
            })
        }
    </script>
    </body>
</html>
