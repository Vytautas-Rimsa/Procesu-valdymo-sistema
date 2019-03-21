<?php
require_once('../../core/init.php');
require_once('../../classes/User.php');

$user = new User();
if(!$user->exists()){
    //Redirect::to(404);
} else{

}

$data = DB::getUserActiveTasks();
$data2 = DB::getUserActiveTasks();
$data3 = DB::getUserActiveTasks();
//$search = @$_POST['submit-search'];

//if(!empty($search)){
//    DB::searchTaskFromAll($search);
//    header('Location: searchAllTasks.php');
//}
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">CRM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Užduotys</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="#">Duomenų bazė</a>
                    </li>                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2 paieskaField" type="text" placeholder="Paieška">
                        <button class="btn btn-secondary mr-sm-4 paieskaButton" type="submit">Paieška</button>
                    </li>
                    <li class="nav-item mr-sm-4">
                        <a href="../../users/head/info.php"><i class='fas fa-address-card'id="info"></i></a>
                    </li>                    
                    <a href="../../logout.php"><i class='fas fa-sign-out-alt' id="logout"></i></a>
                </ul>                
            </div>
        </nav>
    </header>

	<body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="sidebar navbar-nav headSidebar">
                <li class="nav-item">
                    <a class="nav-link" href="#">                        
                        <i class='fas fa-user-circle'></i>
                        <span>Mano užduotys</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class='far fa-file-alt'></i>
                        <span>Nauja užduotis</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item" href="newTaskAdministration.php">Administracijai</a>
                        <a class="dropdown-item" href="newTaskSecurity.php">Apsaugos skyriui</a>
                        <a class="dropdown-item" href="newTaskFinance.php">Finansų skyriui</a>
                        <a class="dropdown-item" href="newTaskCommerce.php">Komercijos skyriui</a>
                        <a class="dropdown-item" href="newTaskPersonal.php">Personalo skyriui</a>
                        <a class="dropdown-item" href="newTaskTech.php">Techninis skyriui</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class='fas fa-tasks'></i>
                        <span>Užduočių ataskaita</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">                        
                        <a class="dropdown-item" href="#">Dienos</a>
                        <a class="dropdown-item" href="#">Savaitės</a>
                        <a class="dropdown-item" href="#">Mėnesio</a>                        
                        <a class="dropdown-item" href="#">Pasirinkto laikotarpio</a>
                        <!-- <div class="dropdown-divider"></div> -->
                        <!-- <h6 class="dropdown-header">Other Pages:</h6> -->                        
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="charts.html">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Charts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tables.html">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Tables</span>
                    </a>
                </li>
            </ul>
            <div id="content-wrapper">
                <div class="container-fluid">                
                <!-- Area Chart Example-->
                    <div class="card mb-3">
                        <div class="card-header headCardHeader">Aktyvios užduotys</div>
                        <div class="card-body">
                            <div id="newTask">
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
                                                <tr class="header headCardHeader">
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['title']; ?></td>
                                                    <td><?php echo $row['startline']; ?></td>
                                                    <td><?php echo $row['deadline']; ?></td>
                                                </tr>
                                                <tr class="container activeTasksContainer">
                                                    <td colspan="4">
                                                        <form action="activeTasks.php?newtask=<?php echo $row['task_id']?>" method="post">
                                                            <div class="row">
                                                                <div class="col col-md-9">
                                                                    <textarea class="activeTasksTextarea form-control" name="task"><?php echo $row['task']; ?></textarea>
                                                                    <textarea class="activeTasksTextareaComent form-control" placeholder="Atliktos arba peradresuotos užduoties komentaras" name="task"></textarea>
                                                                </div>
                                                                <div class="col col-md-3 didButtonsFF">
                                                                    <i class='far fa-check-square headCompleteTask' id="actionsAllTasks"></i>
                                                                    <i class='fas fa-forward headForwardTask didButtonsForwardFinish' id="actionsAllTasks"></i>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php $i++;
                                            }
//                                                else {
//                                                        echo '<div class="success">';
//                                                        echo "Nėra įrašų";
//                                                        echo'</div>';
//                                                }
                                        }
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
                                <div class="card-header headCardHeader">Atliktos užduotys</div>
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
                                                        <tr class="header headCardHeader">
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
                                <div class="card-header headCardHeader">Pradelstos užduotys</div>
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
                                                        <tr class="header headCardHeader">
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
                                                                            <i class='far fa-check-square headCompleteTask' id="actionsAllTasks"></i>
                                                                            <i class='fas fa-forward didButtonsForwardFinishP headForwardTask' id="actionsAllTasks"></i>
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
        <script>
            $(document).ready(function() {
                //Fixing jQuery Click Events for the iPad
                var ua = navigator.userAgent,
                    event = (ua.match(/iPad/i)) ? "touchstart" : "click";
                if ($('.table').length > 0) {
                    $('.table .header').on(event, function() {
                        $(this).toggleClass("active", "").nextUntil('.header').css('display', function(i, v) {
                            return this.style.display === 'table-row' ? 'none' : 'table-row';
                        });
                    });
                }
            })
        </script>
    </body>    
</html>
