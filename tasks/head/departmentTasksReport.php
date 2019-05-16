<?php
    require_once('../../core/init.php');
    require_once('../../classes/User.php');

    $user = new User();
    if(!$user->exists()){
        //Redirect::to(404);
    } else{

    }

    $data = DB::getUserCreatedTasks();
    $data2 = DB::countUserCreatedTasks();

    $report2 = DB::getUserActiveTasks();
    $report3 = DB::getUserActiveTasks();
    $report4 = DB::getUserActiveTasks();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Užduočių ataskaita</title>
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="../../js/scripts.js"></script>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
        <!-- Dropdown listui -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.14/js/jquery.tablesorter.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="../../js/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/lt.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Number'],
                    <?php
                    while ($row = mysqli_fetch_array($data2)){
                        echo "['".$row["task"]."', ".$row["number"]."],";
                    }
                    ?>
                ]);
                var options = {

                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>
    </head>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
                        <a class="nav-link" href="#">Duomenų bazė</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="form-inline my-2 my-lg-0" >
                        <form class="nav navbar-nav navbar-right" action="searchActiveTasks.php" method="POST">                         <a href="../../logout.php"><i class="fas fa-sign-out-alt" id="logout"></i></a>
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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header headCardHeader">Užduočių statistika</div>
                                <div class="card-body completedTasksAdmin">
                                    <div id="completedTasks">

                                        <table class="table table-hover">
                                            <tbody>
                                            <tr>
                                                <th>Skyriaus darbuotojas</th>
                                            </tr>
                                            <tr>
                                                <th class="reportTableTh">Priskirtų užduočių skaičius</th>
                                                <td class="reportTableTd">
                                                    <?php
                                                    if ($report2->num_rows > 0) {
                                                        $count = 0;
                                                        while ($row = $report2->fetch_assoc()) {
                                                            if (date('Y-m-d H:i:s') < date($row['deadline']) && date($row['finished']) == '0000-00-00 00:00:00') {
                                                                $count++;
                                                            }
                                                        }
                                                        echo $count;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="reportTableTh">Pradelstų užduočių skaičius</th>
                                                <td class="reportTableTd">
                                                    <?php
                                                    if ($report3->num_rows > 0) {
                                                        $count = 0;
                                                        while ($row = $report3->fetch_assoc()) {
                                                            if (date('Y-m-d H:i:s') > date($row['deadline']) && date($row['finished'])=='0000-00-00 00:00:00') {
                                                                $count++;
                                                            }
                                                        }
                                                        echo $count;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="reportTableTh">Atliktų užduočių skaičius</th>
                                                <td class="reportTableTd">
                                                    <?php
                                                    if ($report4->num_rows > 0) {
                                                        $count = 0;
                                                        while ($row = $report4->fetch_assoc()) {
                                                            if(date($row['finished'])!='0000-00-00 00:00:00') {
                                                                $count++;
                                                            }
                                                        }
                                                        echo $count;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="reportTableTh">Sukurtų užduočių skaičius</th>
                                                <td class="reportTableTd">
                                                    <?php
                                                    if ($data->num_rows > 0) {
                                                        $count =0;
                                                        while($row = $data->fetch_assoc()) {
                                                            $count++;
                                                        }
                                                        echo $count;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th class="reportTableTh">Pasirinkite ataskaitos laikotarpį</th>
                                                <td><form action="newTaskAdministration.php?newtask=<?php echo $row['darb_id']?>" method="post">
                                                        <div class="row">
                                                            <div class="reportTableDate">
                                                                <input type="text" name="datetimes" class="dateAndTime form-control" name="save_task_btn">
                                                                <script src="../../js/dateTime.js"></script>
                                                            </div>
                                                            <div class="reportTableButton"">
                                                                <input type="submit" value="Pasirinkti" class="btn btn-primary">
                                                            </div>
                                                        </div>
                                                    </form></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer small text-muted"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header headCardHeader">Priskirtų užduočių skritulinė diagrama</div>
                                <div class="card-body overdueTasksAdmin">
                                    <div id="piechart" style="width: 500px; height: 300px;"></div>
                                </div>
                                <div class="card-footer small text-muted"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header headCardHeader">Pradelstų užduočių skritulinė diagrama</div>
                                <div class="card-body overdueTasksAdmin">
                                    <div id="piechart" style="width: 500px; height: 300px;"></div>
                                </div>
                                <div class="card-footer small text-muted"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header headCardHeader">Atliktų užduočių skritulinė diagrama</div>
                                <div class="card-body overdueTasksAdmin">
                                    <div id="piechart" style="width: 500px; height: 300px;"></div>
                                </div>
                                <div class="card-footer small text-muted"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header headCardHeader">Sukurtų užduočių skritulinė diagrama</div>
                                <div class="card-body overdueTasksAdmin">
                                    <div id="piechart" style="width: 500px; height: 300px;"></div>
                                </div>
                                <div class="card-footer small text-muted"></div>
                            </div>
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
