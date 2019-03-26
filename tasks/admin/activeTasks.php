<?php
    require_once('../../core/init.php');
    require_once('../../classes/User.php');
    require_once('../../includes/success/success.php');

    $user = new User();
    if(!$user->exists()){
        //Redirect::to(404);
    } else{

    }

    $data = DB::getUserActiveTasks();
    $data2 = DB::getUserActiveTasks();
    $data3 = DB::getUserActiveTasks();
    $data4 = DB::getUserCreatedTasks();

    $search = @$_POST['submit-search'];

    if(!empty($search)){
        DB::searchTaskFromActive($search);
        header('Location: searchActiveTasks.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">		
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Aktyvios užduotys</title>	
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>        
        <script src="../../js/scripts.js"></script>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
<!-- Dropdown listui -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"id="myBtn"><i class='fas fa-info-circle' id="logout"></i></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Užduotys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../users/admin/users.php">Darbuotojai</a>
                    </li>     
                    <li class="nav-item">
                        <a class="nav-link" href="#">Duomenų bazė</a>
                    </li>                     
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="form-inline my-2 my-lg-0" >
                        <form class="nav navbar-nav navbar-right" action="searchActiveTasks.php" method="POST">
                    <li class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2 paieskaField" type="text" placeholder="Paieška" name="search" id="search" onkeyup="enableSearchButton()">
                        <button class="btn btn-secondary mr-sm-4 paieskaButton" type="submit" name="submit-search" id="searchButton" disabled="">Paieška</button>
                    </li>
                    <a href="../../logout.php"><i class="fas fa-sign-out-alt" id="logout"></i></a>
                    </form>
                    </li>
                </ul>                
            </div>
        </nav>
    </header>

	<body id="page-top">
        <div id="wrapper">
            <?php require '../../includes/tools/sidebarAdmin.php';?>
            <div id="content-wrapper">
                <div class="container-fluid">                
                <!-- Area Chart Example-->
                    <div class="card mb-3">
                        <div class="card-header adminCardHeader">Aktyvios užduotys</div>
                        <div class="card-body">
                            <div id="activeTasks">
                                <?php echo display_success(); ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nr.</th>
                                            <th>Užduoties pavadinimas</th>
                                            <th>Užduoties sukūrimo data</th>
                                            <th>Galutinis terminas</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        if ($data->num_rows > 0) {
                                            $i =1;
                                            while($row = $data->fetch_assoc()){
                                                if(date('Y-m-d H:i:s') < date($row['deadline']) && date($row['finished'])=='0000-00-00 00:00:00'){?>
                                                   <tr class="header activeTaskAdmin">
                                                       <td><?php echo $i; ?></td>
                                                       <td><?php echo $row['title']; ?></td>
                                                       <td><?php echo $row['startline']; ?></td>
                                                        <td><?php echo $row['deadline']; ?></td>
                                                   </tr>
                                                    <tr class="container activeTasksContainer">
                                                        <td colspan="4">
                                                            <form action="activeTasks.php?activeTasks=<?php echo $row['task_id']?>" method="post">
                                                                <div class="row">
                                                                    <div class="col col-md-9">
                                                                        <textarea class="activeTasksTextarea form-control" name="task"><?php echo $row['task']; ?></textarea>
                                                                        <textarea class="activeTasksTextareaComent form-control" placeholder="Atliktos arba peradresuotos užduoties komentaras" name="task"></textarea>
                                                                    </div>

                                                                    <div class="col col-md-3 didButtonsFF">
                                                                        <i class='far fa-check-square' id="actionsAllTasks"></i>
                                                                        <i class='fas fa-forward didButtonsForwardFinish' id="actionsAllTasks"></i>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php $i++;
                                                }
                                            }
                                        }
//                                        else {
//                                            echo '<div class="success">';
//                                            echo "Nėra įrašų";
//                                            echo'</div>';
//                                        }
                                    else {
                                        array_push($success, "Lentelėje įrašų nėra");
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Paskutinis įrašas 11:59 PM</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header adminCardHeader">Atliktos užduotys</div>
                                <div class="card-body">
                                    <div id="completedTasks">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Nr.</th>
                                                <th>Užduoties pavadinimas</th>
                                                <th>Užduoties sukūrimo data</th>
                                                <th>Atlikimo data</th>
                                            </tr>
                                            </thead>
                                            <?php
                                            if ($data3->num_rows > 0) {
                                                $i =1;
                                                while($row = $data3->fetch_assoc()){

                                                    if(date($row['finished'])!='0000-00-00 00:00:00'){?>
                                                        <tr class="header activeTaskAdmin">
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row['title']; ?></td>
                                                            <td><?php echo $row['startline']; ?></td>
                                                            <td><?php echo $row['finished']; ?></td>
                                                        </tr>
                                                        <tr class="container activeTasksContainer">
                                                            <td colspan="4">
                                                                <form action="activeTasks.php?completedTasks=<?php echo $row['task_id']?>" method="post">
                                                                    <div class="row">
                                                                        <div class="col col-md-12">
                                                                            <textarea class="activeTasksTextarea form-control" name="task"><?php echo $row['task']; ?>
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; }
//                                                        else {
//                                                        echo '<div class="success">';
//                                                        echo "Nėra įrašų";
//                                                        echo'</div>';
//                                                    }
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer small text-muted">Paskutinis įrašas 11:59 PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header adminCardHeader">Pradelstos užduotys</div>
                                <div class="card-body">
                                    <div id="lateTasks">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nr.</th>
                                                    <th>Užduoties pavadinimas</th>
                                                    <th>Užduoties sukūrimo data</th>
                                                    <th>Galutinis terminas</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            if ($data2->num_rows > 0) {
                                                $i =1;
                                                while($row = $data2->fetch_assoc()){

                                                    if(date('Y-m-d H:i:s') > date($row['deadline']) && date($row['finished'])=='0000-00-00 00:00:00'){?>
                                                        <tr class="header activeTaskAdmin">
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row['title']; ?></td>
                                                            <td><?php echo $row['startline']; ?></td>
                                                            <td><?php echo $row['deadline']; ?></td>
                                                        </tr>
                                                        <tr class="container activeTasksContainer">
                                                            <td colspan="4">
                                                                <form action="activeTasks.php?lateTasks=<?php echo $row['task_id']?>" method="post">
                                                                    <div class="row">
                                                                        <div class="col col-md-9">
                                                                            <textarea class="activeTasksTextarea form-control" name="task"><?php echo $row['task']; ?>
                                                                            </textarea>
                                                                            <textarea class="activeTasksTextareaComent form-control" placeholder="Atliktos arba peradresuotos užduoties komentaras" name="task"></textarea>
                                                                        </div>
                                                                        <div class="col col-md-3 didButtonsFF">
                                                                            <i class='far fa-check-square ' id="actionsAllTasks"></i>
                                                                            <i class='fas fa-forward didButtonsForwardFinishP' id="actionsAllTasks"></i>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; }
//                                                        else {
//                                                        echo '<div class="success">';
//                                                        echo "Nėra įrašų";
//                                                        echo'</div>';
//                                                    }
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer small text-muted">Paskutinis įrašas 11:59 PM</div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <!-- /.container-fluid -->                
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /#wrapper -->
        <div class="scroll-to-top rounded">
            <span><a href=""><i class="fas fa-angle-up upDownButton"></i> </a></span>
        </div>
        <?php require '../../includes/tools/modalAdmin.php';?>
        <script src="../../js/cardPopdown.js"></script>
        <script src="../../js/modal.js"></script>
    </body>    
</html>
