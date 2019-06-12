<?php
    require_once('../../core/init.php');
    require_once('../../classes/User.php');

    if(!empty(@$_GET['deleteContract'])){
        $dfg = $_GET['deleteContract'];
        $res = DB::deleteContract($dfg);

        echo $res;
    }

    $duomArr = DB::getContractList();
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
                        <form class="nav navbar-nav navbar-right" action="searchClients.php" method="POST">
                            <input class="form-control mr-sm-2 paieskaField" type="text" placeholder="Paieška" name="search" id="search" onkeyup="enableSearchButton()">
                            <button class="btn btn-secondary mr-sm-4" type="submit" name="submit-search" id="searchButton" disabled="">Paieška</button>
                        </form>
                    </li>
                    <li class="nav-item mr-sm-4">
                        <a href="../../users/user/info.php"><i class='fas fa-address-card'id="infoLight"></i></a>
                    </li>
                    <a href="../../logout.php"><i class='fas fa-sign-out-alt' id="logoutLight"></i></a>
                </ul>
            </div>
        </nav>
    </header>

    <div id="page-top">
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
                                            </tr>
                                        </thead>
                                        <tbody role="rowgroup">
                                            <?php
                                            $duomArrI = count($duomArr);

                                            for($i=0; $i<$duomArrI;$i++){
                                                $y=$i+1;
                                                ?>
                                                <tr class="table-light" role="row">
                                                    <th class="employeeList"scope="row"  role="cell"><?php echo $y ?></th>
                                                    <td  class="employeeList" role="cell"><?php echo $duomArr[$i]['client']['title'] ?></td>
                                                    <td  class="employeeList"role="cell"><?php echo $duomArr[$i]['contract']['contract_code'] ?></td>
                                                    <td  class="employeeList"role="cell"><?php
                                                    switch ($duomArr[$i]['contract']['status_id']) {
                                                            case 0:
                                                                echo "Nutraukta";
                                                                break;
                                                            case 1:
                                                                echo "Galiojanti";
                                                                break;
                                                            case 2:
                                                                echo "Sustabdyta";
                                                                break;
                                                        }
                                                        ?>
                                                    </td>

                                                    <td  class="employeeList" role="cell"></td>
                                                    <td  class="" role="cell">
                                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $y ?>">
                                                            <i class='fas fa-search' id="actions"></i>
                                                        </button>
                                                        
                                                    </td>
                                                    <div class="modal fade bd-example-modal-lg<?php echo $y ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h5 class="modal-title"><?php echo $duomArr[$i]['contract']['contract_code'] ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <form>
                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>Kliento tipas: </b></label>
                                                                      <div class="col-sm-8">
                                                                          <?php
                                                                          $result = DB::getClientTypeName($duomArr[$i]['client']['client_type_id']);
                                                                          $row = $result->fetch_assoc();
                                                                          echo $row['title'];?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>Pavadinimas:</b></label>
                                                                      <div class="col-sm-8">
                                                                          <input value='<?php echo $duomArr[$i]['client']['title'] ?>' name='client-title'  class="form-control">
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>El. paštas:</b></label>
                                                                      <div class="col-sm-8">
                                                                          <input value='<?php echo $duomArr[$i]['client']['email'] ?>' name='client-title'  class="form-control">
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>Telefono numeris:</b></label>
                                                                      <div class="col-sm-8">
                                                                          <input value='<?php echo $duomArr[$i]['client']['phone'] ?>' name='client-title'  class="form-control">
                                                                      </div>
                                                                  </div>

                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>Miestas: </b></label>
                                                                      <div class="col-sm-8">
                                                                          <input value='<?php
                                                                          $result = DB::getCityName($duomArr[$i]['client']['city_id']);
                                                                          $row = $result->fetch_assoc();
                                                                          echo $row['city_name'];?>' name='client-title'  class="form-control">
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>Gatvė:</b></label>
                                                                      <div class="col-sm-8">
                                                                          <input value='<?php
                                                                          $result = DB::getStreetName($duomArr[$i]['client']['street_id']);
                                                                          $row = $result->fetch_assoc();
                                                                          echo $row['address'] ?>' name='client-title'  class="form-control">
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>Numeris:</b></label>
                                                                      <div class="col-sm-8">
                                                                          <input value='<?php echo $duomArr[$i]['client']['house_nb'] ?>' name='client-title'  class="form-control">
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>Kliento kodas:</b></label>
                                                                      <div class="col-sm-8">
                                                                          <input value='<?php echo $duomArr[$i]['client']['identification_code'] ?>' name='client-title'  class="form-control">
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>PVM mokėtojo kodas:</b></label>
                                                                      <div class="col-sm-8">
                                                                          <input value='<?php echo $duomArr[$i]['client']['vat'] ?>' name='client-title'  class="form-control">
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>Įrašo data:</b></label>
                                                                      <div class="col-sm-8">
                                                                          <?php echo $duomArr[$i]['client']['time'] ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="form-group row">
                                                                      <label class="col-sm-4 col-form-label"><b>Dokumentas:</b></label>
                                                                      <div class="col-sm-8">
                                                                          <a href="/PROJEKTAI/bd/contractFiles/<?php
                                                                          $result = DB::getContractInfo($duomArr[$i]['client']['client_id']);
                                                                          $row = $result->fetch_assoc();
                                                                          echo $row['file_path'] ?>" target="_blank"><?php echo $row['file_path'] ?></a>
                                                                      </div>
                                                                  </div>
                                                              </form>
                                                            
                                                          </div>
                                                          <div class="modal-footer">
                                                              <a href="?deleteContract=<?php echo $duomArr[$i]['contract']['contract_id'] ?>"><button type="button" class="btn btn-alert my-2 my-sm-0" name="addUser_btn">Istrinti kontrakta</button></a>
                                                            <button type="button" class="btn userButton my-2 my-sm-0" name="addUser_btn">Išsaugoti pakeitimus</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
    </div>

                                                </tr>
                                            <?php } ?>
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
