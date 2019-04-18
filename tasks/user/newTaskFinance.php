<?php
    require_once('../../core/init.php');
    require_once('../../classes/User.php');
    require_once('../../includes/errors/errors.php');

    $user = new User();
    if(!$user->exists()){
        //Redirect::to(404);
    } else{

    }

    $data = DB::getDepartmentEmployee("Finansų skyrius");

    if(!empty($_GET['newtask'])){
        $a = explode(" - ", $_POST['datetimes']);
        $b=$_POST['title'];
        $c=$_POST['task'];
        $d=$_SESSION["user"];
        $e=$_GET['newtask'];
        if(empty($b)) {
            array_push($errors, "Neužpildytas <b>Užduoties pavadinimo</b> laukelis");
        }
        if(empty($c)){
            array_push($errors, "Neužpildytas <b>Užduoties aprašymo</b> laukelis");
        }
        if(!empty($b) && !empty($c)){
            DB::insertTask($b, $c, $a, $d, $e);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sukurti užduotį</title>
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
    </head>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"id="myBtn"><i class='fas fa-info-circle' id="logoutLight"></i></a>
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
                    <div class="card mb-3">
                        <div class="card-header userCardHeader">Sukurti naują užduotį finansų skyriui</div>
                        <?php echo display_error(); ?>
                        <div class="card-body">
                            <div id="newTask">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nr.</th>
                                        <th>Vardas</th>
                                        <th>Pavardė</th>
                                        <th>Pareigos</th>
                                    </tr>
                                    </thead>
                                    <?php if ($data->num_rows > 0) {
                                        $i =1;
                                        while($row = $data->fetch_assoc()){
                                            ?>
                                            <tr class="header userCardHeader whiteLine">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['vardas']; ?></td>
                                                <td><?php echo $row['pavarde']; ?></td>
                                                <td><?php echo $row['pareigos']; ?></td>
                                            </tr>
                                            <tr class="container activeTasksContainer">
                                                <td colspan="4">
                                                    <form action="newTaskFinance.php?newtask=<?php echo $row['darb_id']?>" method="post">
                                                        <div class="row">

                                                            <div class="col col-md-8">
                                                                <input class="activeTasksInput form-control" placeholder="Užduoties pavadinimas" name="title">
                                                                <textarea class="activeTasksTextarea form-control" placeholder="Užduoties aprašymas" name="task"></textarea>
                                                            </div>
                                                            <div class="col col-md-1">
                                                                <input type="submit" value="Įrašyti" class="btn userTaskButton">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" name="datetimes" class="dateAndTime form-control" name="save_task_btn">
                                                                <script src="../../js/dateTime.js"></script>
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
                        <div class="card-footer small text-muted">Paskutinis įrašas 11:59 PM</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-to-top rounded">
            <span><a href=""><i class="fas fa-angle-up upDownButton"></i></a></span>
        </div>
        <?php require '../../includes/tools/modalUser.php';?>
        <script src="../../js/cardPopdown.js"></script>
        <script src="../../js/modal.js"></script>
    </body>
</html>
