<?php

    $rowas = DB::getContractList();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Duomenų bazė</title>
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
            <button type="button" class="btn-circle infoButton" data-toggle="modal" data-target="#myMenu"><i class='fas fa-info-circle' id="logoutLight"></i></a></button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../../tasks/user/activeTasks.php">Užduotys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Duomenų bazė</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Paieška">
                        <button class="btn btn-secondary mr-sm-4" type="submit">Paieška</button>
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

            <div id="content-wrapper">
                <div class="container-fluid">
                    <!-- Area Chart Example-->
                    <div class="card mb-3">
                        <div class="card-header userCardHeader">SUTARČIŲ SĄRAŠAS
                            <a href="createCompany.php"><i class="fas fa-plus-square" id="addLight"></i></a>
                        </div>
                            <div class="card-body">
                                <div id="activeTasks">

                                    <table table class="table table-hover" id="keywords" cellspacing="0" cellpadding="0">
                                        <thead role="rowgroup">
                                        <tr  role="row">
                                            <th role="columnheader">Nr.</th>
                                            <th role="columnheader">Pavadinimas</th>
                                            <th role="columnheader">Sutarties numeris</th>
                                            <th role="columnheader">Statusas</th>
                                            <th role="columnheader"></th>
                                            <th role="columnheader"></th>
                                            <th role="columnheader"></th>
                                        </tr>
                                        </thead>
                                        <tbody role="rowgroup">
                                            <?php

                                            $i = 1;

                                            while($row = $rowas->fetch_assoc()){
                                                echo "<tr class=\"table-light\" role=\"row\">
                                                    <th class=\"employeeList\"scope=\"row\"  role=\"cell\">$i</th>
                                                    <td  class=\"employeeList\" role=\"cell\">ytu</td>
                                                    <td  class=\"employeeList\"role=\"cell\">".$row['']."</td>
                                                    <td  class=\"employeeList\"role=\"cell\"></td>
                                                    <td  class=\"employeeList\"role=\"cell\"></td>
                                                    <td  class=\"\"role=\"cell\"><i class='fas fa-paperclip' id=\"actions\"></i></td>
                                                    <td class=\"\" role=\"cell\"><a href=\"\"><i class='fas fa-edit' id=\"actions\"></i></a></td>
                                                    <td class=\"\" role=\"cell\">
                                                        <a onclick=\"redirect('')\">
                                                            <i class='fas fa-trash-alt' id=\"actions\"></i>
                                                        </a>
                                                    </td>
                                                </tr>";
                                            }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <div class="card-footer small text-muted"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-to-top rounded">
            <span><a href=""><i class="fas fa-angle-up upDownButton"></i> </a></span>
        </div>
    </body>
    <?php require '../../includes/tools/modalAdmin.php';?>
    <script src="../../js/cardPopdown.js"></script>
    <script src="../../js/modal.js"></script>
    <script>
        $(function(){
            $('#keywords').tablesorter();
        });
    </script>
</html>
