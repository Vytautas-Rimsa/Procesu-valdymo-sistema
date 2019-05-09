<?php
    require_once('../../core/init.php');
    require_once('../../classes/User.php');
    require_once('../../includes/success/success.php');

    $user = new User();
    if(!$user->exists()){
        //Redirect::to(404);
    } else{

    }

    $data = DB::getUserCreatedTasks();

    $search = @$_POST['submit-search'];

    if(!empty($search)){
        DB::searchMyCreatedTasks($search);
        header('Location: searchMyCreatedTasks.php');
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
<!--            <a class="navbar-brand" href="#"id="myBtn"><i class='fas fa-info-circle' id="logoutLight"></i></a>-->
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myMenu"><i class='fas fa-info-circle' id="logout"></i></a></button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Užduotys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../database/user/database.php">Duomenų bazė</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2 paieskaField" type="text" placeholder="Paieška">
                        <button class="btn btn-secondary mr-sm-4 paieskaButton" type="submit">Paieška</button>
                    </li>
                    <li class="nav-item mr-sm-4">
                        <a href="../../users/user/info.php"><i class='fas fa-address-card'id="infoLight"></i></a>
                    </li>
                    <a href="../../logout.php"><i class='fas fa-sign-out-alt' id="logoutLight"></i></a>
                </ul>
            </div>
        </nav>
    </header>

    <body id="page-top">
        <div id="wrapper">
            <?php require '../../includes/tools/sidebarUser.php';?>
            <div id="content-wrapper">
                <div class="container-fluid">
                    <!-- Area Chart Example-->
                    <div class="card mb-3">
                        <div class="card-header userCardHeader">Mano sukurtos užduotys</div>
                        <div class="card-body myCreatedTasks">
                            <div id="activeTasks">
                                <?php echo display_success(); ?>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nr.</th>
                                        <th>Užduoties pavadinimas</th>
                                        <th>Užduoties sukūrimo data</th>
                                        <th>Statusas</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    if ($data->num_rows > 0) {
                                        $i =1;
                                        while($row = $data->fetch_assoc()){
                                            ?>
                                            <tr class="header userCardHeader whiteLine">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['startline']; ?></td>
                                                <td><?php if(date($row['finished'])=='0000-00-00 00:00:00'){
                                                        echo "Galiojanti";
                                                    } else{
                                                        echo "Užbaigta";
                                                    }?></td>
                                            </tr>
                                            <tr class="container activeTasksContainer">
                                                <td colspan="4">
                                                    <form action="activeTasks.php?activeTasks=<?php echo $row['task_id']?>" method="post">
                                                        <div class="row">
                                                            <div class="col col-md-10">
                                                                <textarea class="activeTasksTextarea form-control" name="task"><?php echo $row['task']; ?></textarea>
                                                            </div>
                                                            <div class="col col-md-2 didButtonsFF">
                                                                <i class='fas fa-edit userForwardTask' id="actionsAllTasks"></i>
                                                            </div>
                                                        </div>
                                                        <div class="row dialog">
                                                            <div class="col col-md-10">
                                                                <?php
                                                                $task = DB::showResults($row['task_id']);
                                                                while($row = $task->fetch_assoc()) {
                                                                    $q = DB::getUserData($row['reply_by']);
                                                                    $rowas = $q->fetch_assoc();

                                                                    echo "<div class='dialogWind'><div class='author'>Autorius: <b>".$rowas['vardas']." ".$rowas['pavarde']."</b></div>";
                                                                    echo '<div class="alert alertUser" role="alert">';
                                                                    echo $row['reply'];
                                                                    echo '</div></div> ';
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php $i++;
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
        </div>
    </body>
</html>
