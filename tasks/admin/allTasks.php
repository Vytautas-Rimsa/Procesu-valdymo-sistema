<?php
    require_once('../../core/init.php');
    require_once('../../classes/User.php');

    $user = new User();
    if(!$user->exists()){
        //Redirect::to(404);
    } else{

    }

    $data = DB::getAllTasks();

    $deleteTask = @$_GET['del_task'];

    if(!empty($deleteTask)){
        DB::deleteTask($deleteTask);
        header('Location: allTasks.php');
    }

    $search = @$_POST['submit-search'];

    if(!empty($search)){
        DB::searchTaskFromAll($search);
        header('Location: searchAllTasks.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Užduočių sąrašas</title>
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/scripts.js"></script>
        <script type="text/javascript" src="../../js/main.js"></script>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
        <!-- Dropdown listui -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="../../js/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/lt.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    </head>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button type="button" class="btn-circle infoButton" data-toggle="modal" data-target="#myMenu"><i class='fas fa-info-circle' id="logout"></i></a></button>
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
                        <a class="nav-link" href="../../database/admin/database.php">Duomenų bazė</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="form-inline my-2 my-lg-0">
                        <form class="nav navbar-nav navbar-right" action="searchAllTasks.php" method="POST">
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
                    <div class="card mb-3">
                        <div class="card-header adminCardHeader">Užduočių sąrašas</div>
                        <form method="post" action="allTasks.php">
                        <div class="card-body allTasksAdmin">
                            <div id="newTask">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nr.</th>
                                        <th>Užduoties pavadinimas</th>
                                        <th>Sukūrimo data</th>
                                        <th>Statusas</th>
                                    </tr>
                                    </thead>
                                    <?php if ($data->num_rows > 0) {
                                        $i =1;
                                        while($row = $data->fetch_assoc()){
                                            ?>
                                            <tr class="header activeTaskAdmin">
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
                                                    <form action="" method="post">
                                                        <div class="row">
                                                            <div class="col col-md-10">
                                                                <textarea class="activeTasksTextarea form-control" name="task"><?php echo $row['task']; ?></textarea>
                                                                <?php
                                                                $q = DB::getUserData($row['created_by']);
                                                                $rowas = $q->fetch_assoc();
                                                                echo "<div class='author'>Užduotį sukūrė: <b>".$rowas['vardas']." ".$rowas['pavarde']."</b><hr></div>";
                                                                ?>
                                                            </div>
                                                            <div class="col col-md-2 didButtons">
                                                                <i class='fas fa-edit' id="actionsAllTasks"></i>
                                                                <a onclick="redirect('<?php echo $row['task_id'];?>')"><i class='fas fa-trash-alt' id="actionsAllTasks"></i></a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php $i++;
                                        }
                                    } else {
                                        echo "Nėra įrašų";
                                    } ?>
                                </table>
                            </div>
                        </div>

                        </form>

                        <div class="card-footer small text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-to-top rounded">
            <span><a href=""><i class="fas fa-angle-up upDownButton"></i> </a></span>
        </div>
        <script src="../../js/deleteTask.js"></script>
        <?php require '../../includes/tools/modalAdmin.php';?>
        <script src="../../js/cardPopdown.js"></script>
        <script src="../../js/modal.js"></script>
    </body>
</html>
