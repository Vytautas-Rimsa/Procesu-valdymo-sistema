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
$data4 = DB::getUserCreatedTasks();

$search = @$_POST['submit-search'];

if(!empty($search)){
    DB::searchTaskFromActive($search);
    header('Location: searchActiveTasks.php');
}

if(!empty($_GET['lateTasks'])){
    $taskas = $_POST['task'];
    if(!empty($taskas)){
        DB::updateTask($_GET['lateTasks'], $taskas, $_SESSION['user']);
        $lateTasksSuccess = "Sėkmingai atlikta užduotis";
    }else{
        $lateTasksError = "Neužpildytas <b>Užduoties komentaro</b> laukelis";
    }
}

if(!empty($_GET['activeTasks'])){
    $taskas = $_POST['task'];

    if(empty($taskas)){
        $error = "Neužpildytas <b>Užduoties komentaro</b> laukelis";
    }

    if(!empty($taskas)){
        DB::updateTask($_GET['activeTasks'], $taskas, $_SESSION['user']);
        $success = "Sėkmingai atlikta užduotis";
    }
}

if(@$_GET['action'] == "darbuPeradresavimas"){
    $id=$_POST['peradresavimoId'];
    $uzd_id=intval($_POST['uzd_id']);
    if($id!="" || is_int($id)){
        DB::uzduotiesPeradresavimas($uzd_id, $id);
    }else{
        echo "Nepasirinktas tinkamas variantas";
    }
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.14/js/jquery.tablesorter.min.js"></script>
    </head>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <button type="button" class="btn-circle infoButtonHead" data-toggle="modal" data-target="#myMenu"><i class='fas fa-info-circle' id="logout"></i></a></button>
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
                        <form class="nav navbar-nav navbar-right" action="searchActiveTasks.php" method="POST">
                    <li class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2 paieskaField" type="text" placeholder="Paieška" name="search" id="search" onkeyup="enableSearchButton()">
                        <button class="btn btn-secondary mr-sm-4 paieskaButton" type="submit" name="submit-search" id="searchButton" disabled="">Paieška</button>
                    </li>
                    <li class="nav-item mr-sm-4">
                        <a href="../../users/head/info.php"><i class='fas fa-address-card'id="info"></i></a>
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
            <?php require '../../includes/tools/sidebarHead.php';?>
            <div id="content-wrapper">
                <div class="container-fluid">                
                <!-- Area Chart Example-->
                    <div class="card mb-3">
                        <div class="card-header headCardHeader">Aktyvios užduotys</div>
                        <?php if(!empty($error)){echo '<div class="errorDiv">'.$error.'</div>';} ?>
                        <?php if(!empty($success)){echo '<div class="successDiv">'.$success.'</div>';} ?>
                        <div class="card-body activeTasksAdmin">
                            <div id="activeTasks">
                                <table class="table table-hover" id="keywords0">
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
                                                        <form action="activeTasks.php?activeTasks=<?php echo $row['task_id']?>" method="post">
                                                            <div class="row">
                                                                <div class="col col-md-9">
                                                                    <h4><?php echo $row['task']; ?></h4>
                                                                    <?php
                                                                    $q = DB::getUserData($row['created_by']);
                                                                    $rowas = $q->fetch_assoc();
                                                                    echo "<div class='author'>Užduotį sukūrė: <b>".$rowas['vardas']." ".$rowas['pavarde']."</b><hr></div>";
                                                                    ?>
                                                                    <textarea class="activeTasksTextareaComent form-control" placeholder="Užduoties komentaras" name="task"></textarea>
                                                                </div>
                                                                <div class="col col-md-3 didButtonsFF">
                                                                    <button type="submit" class="button-submit"> <i class='far fa-check-square headCompleteTask' id="actionsAllTasks"></i></button><?php $uzd_id = $row['task_id'] ?>
                                                                </div>
                                                            </div>
                                                            <div class="row dialog">
                                                                <div class="col col-md-9">
                                                                    <?php
                                                                    $task = DB::showResults($row['task_id']);
                                                                    while($row = $task->fetch_assoc()) {
                                                                        $q = DB::getUserData($row['reply_by']);
                                                                        $rowas = $q->fetch_assoc();
                                                                        echo "<div class='dialogWind'><div class='author'>Autorius: <b>".$rowas['vardas']." ".$rowas['pavarde']."</b></div>";
                                                                        echo '<div class="alert alertHead" role="alert">';
                                                                        echo $row['reply'];
                                                                        echo '</div></div> ';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <button type="button" class="btn btn-primary adminButtonForward btn-lg" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">Peradresuoti</button>

                                                        <div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
                                                            <div class="modal-dialog">

                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Užduoties peradresavimas</h4>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <form action="activeTasks.php?action=darbuPeradresavimas" method="post">
                                                                            <select  class="form-control" name="peradresavimoId" required>
                                                                                <option value="">Pasirinkite skyrių</option>
                                                                                <?php
                                                                                $qqq=DB::getAllDepartments();
                                                                                while ($rvvv=mysqli_fetch_array($qqq)) {
                                                                                    echo '<option value="" style="font-weight: bold;">'.$rvvv['skyrius'].'</option>';
                                                                                    $department = DB::getDepartmentEmployee($rvvv['skyrius']);
                                                                                    while ($qw=mysqli_fetch_array($department)) {
                                                                                        echo '<option value="'. $qw['darb_id'] .'"><span style="margin-left: 15px">'.$qw['vardas'].' '.$qw['pavarde'].'</span></option>';}
                                                                                }?>
                                                                            </select>
                                                                            <input type="hidden" value="<?php echo $uzd_id ?>" name="uzd_id">
                                                                            <button type="submit" class="button-submit" ><i class='fas fa-forward headCompleteTask didButtonsForwardFinish' id="actionsAllTasks"></i></button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Atšaukti</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php $i++;
                                            }

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
                                <div class="card-body completedTasksAdmin">
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
                                                                            <h4><?php echo $row['task']; ?></h4>
                                                                            <?php
                                                                            $q = DB::getUserData($row['created_by']);
                                                                            $rowas = $q->fetch_assoc();
                                                                            echo "<div class='author'>Užduotį sukūrė: <b>".$rowas['vardas']." ".$rowas['pavarde']."</b><hr></div>";
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row dialog">
                                                                        <div class="col col-md-12">
                                                                            <?php
                                                                            $task = DB::showResults($row['task_id']);
                                                                            while($row = $task->fetch_assoc()) {
                                                                                $q = DB::getUserData($row['reply_by']);
                                                                                $rowas = $q->fetch_assoc();
                                                                                echo "<div class='dialogWind'><div class='author'>Autorius: <b>".$rowas['vardas']." ".$rowas['pavarde']."</b></div>";
                                                                                echo '<div class="alert alertHead" role="alert">';
                                                                                echo $row['reply'];
                                                                                echo '</div></div> ';
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; }

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
                                <?php
                                if(!empty($lateTasksError)){
                                    echo '<div class="errorDivSmallCard">'.$lateTasksError.'</div>';
                                }
                                if(!empty($lateTasksSuccess)){echo '<div class="successDivSmallCard">'.$lateTasksSuccess.'</div>';}
                                ?>
                                <div class="card-body overdueTasksAdmin">
                                    <div id="lateTasks">
                                        <table class="table table-hover" id="keywords" cellspacing="0" cellpadding="0">
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
                                                                            <h4><?php echo $row['task']; ?></h4>
                                                                            <?php
                                                                            $q = DB::getUserData($row['created_by']);
                                                                            $rowas = $q->fetch_assoc();
                                                                            echo "<div class='author'>Užduotį sukūrė: <b>".$rowas['vardas']." ".$rowas['pavarde']."</b><hr></div>";
                                                                            ?>
                                                                            <textarea class="activeTasksTextareaComent form-control" placeholder="Užduoties komentaras" name="task"></textarea>
                                                                        </div>
                                                                        <div class="col col-md-3 didButtonsFF">
                                                                            <button type="submit" class="button-submit"> <i class='far fa-check-square headCompleteTask' id="actionsAllTasks"></i></button><?php $uzd_id = $row['task_id'] ?>

                                                                        </div>
                                                                    </div>
                                                                    <div class="row dialog">
                                                                        <div class="col col-md-9">
                                                                            <?php
                                                                            $task = DB::showResults($row['task_id']);
                                                                            while($row = $task->fetch_assoc()) {
                                                                                $q = DB::getUserData($row['reply_by']);
                                                                                $rowas = $q->fetch_assoc();

                                                                                echo "<div class='dialogWind'><div class='author'>Autorius: <b>".$rowas['vardas']." ".$rowas['pavarde']."</b></div>";
                                                                                echo '<div class="alert alertHead" role="alert">';
                                                                                echo $row['reply'];
                                                                                echo '</div></div> ';
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                                <button type="button" class="btn btn-primary adminButtonSmallForward buttonLeft" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">Peradresuoti</button>

                                                                <div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
                                                                    <div class="modal-dialog">

                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Užduoties peradresavimas</h4>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                <form action="activeTasks.php?action=darbuPeradresavimas" method="post">
                                                                                    <select  class="form-control" name="peradresavimoId" required>
                                                                                        <option value="">Pasirinkite skyrių</option>
                                                                                        <?php
                                                                                        $qqq=DB::getAllDepartments();
                                                                                        while ($rvvv=mysqli_fetch_array($qqq)) {
                                                                                            echo '<option value="" style="font-weight: bold;">'.$rvvv['skyrius'].'</option>';
                                                                                            $department = DB::getDepartmentEmployee($rvvv['skyrius']);
                                                                                            while ($qw=mysqli_fetch_array($department)) {
                                                                                                echo '<option value="'. $qw['darb_id'] .'"><span style="margin-left: 15px">'.$qw['vardas'].' '.$qw['pavarde'].'</span></option>';}
                                                                                        }?>
                                                                                    </select>
                                                                                    <input type="hidden" value="<?php echo $uzd_id ?>" name="uzd_id">
                                                                                    <button type="submit" class="button-submit" ><i class='fas fa-forward headCompleteTask didButtonsForwardFinish' id="actionsAllTasks"></i></button>
                                                                                </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Atšaukti</button>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; }

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
        <script>
            $(function(){
                $('#keywords').tablesorter();
            });
        </script>
    </body>    
</html>
