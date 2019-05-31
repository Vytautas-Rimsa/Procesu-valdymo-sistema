<?php
    require_once('../../core/init.php');
    require_once('../../classes/User.php');

    $notification = "";

    if(!empty(@$_GET['new_contract'])){
        if(empty($_POST['client_type'])
            OR empty($_POST['title'])
            OR empty($_POST['email'])
            OR empty($_POST['phone'])
            OR empty($_POST['code'])
            OR empty($_POST['contract_code'])
            OR empty($_POST['city'])
            OR empty($_POST['street'])
//            OR empty($_POST['file'])
        ){
            $notification = "<div class=\"alert alert-danger\" role=\"alert\">
        Prašome užpildyti laukelius
    </div>";
        }else{
            try{
                DB::saveClientData($_POST['client_type'],
                    $_POST['title'],
                    $_POST['email'],
                    $_POST['phone'],
                    $_POST['code'],
                    $_POST['contract_code'],
                    $_POST['city'],
                    $_POST['street'],
                    $_POST['contract_file'],
                    $_POST['house_nr'],
                    $_POST['vat'],
                    $_POST['contract_status']);

                $notification = "<div class=\"alert alert-success\" role=\"alert\">
        Įrašas sėkmingai sukurtas.
    </div>";
            }
            catch (Exception $e){
                $notification = "<div class=\"alert alert-danger\" role=\"alert\">
                Klaida: $e;
            </div>";
            }
        }
    }


    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sukurti klientą</title>
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
                        <a class="nav-link" href="database.php">Duomenų bazė</a>
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

            <div class="container">
                <div class="col-sm-6 offset-sm-3">
                    <div class="headerUser">
                        <h2>Sukurti naują klientą</h2>
                    </div>
<?php echo "$notification"; ?>
                    <form method="post" action="createCompany.php?new_contract=create" class="formaAplication">

                        <fieldset>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kliento tipas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="client_type">
                                        <?php
                                        $rowas = DB::getClientTypeList();
                                        while($row = $rowas->fetch_assoc()){
                                            echo "<option value='".$row['type_id']."'>".$row['title']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Įmonės pavadinimas (vardas, pavardė)</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="title" id="" placeholder="Įmonės pavadinimas/ vardas pavardė" value="" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">El. paštas</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" name="email" id="" placeholder="El. pašto adresas"  value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Telefono nr.</label>
                                <div class="col-sm-7">
                                    <input type="tel" class="form-control" name="phone" id="" placeholder="Telefono numeris"  value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Įmonės (asmens) kodas</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="code" id="" placeholder="Įmonės (asmens) kodas" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">PVM kodas</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="vat" id="" placeholder="PVM mokėtojo kodas" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Sutarties nr.</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="contract_code" id="" placeholder="Sutarties numeris" value="" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Sutarties statusas.</label>
                                <div class="col-sm-7">
                                    <select name="contract_status" class="form-control">
                                        <option value="1">Galiojanti</option>
                                        <option value="0">Nutraukta</option>
                                        <option value="2">Sustabdyta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label"><b>Adresas korespondencijai</b></label>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Miestas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="city">
                                        <?php
                                        $rowas = DB::getCityList();
                                        while($row = $rowas->fetch_assoc()){
                                            echo "<option value='".$row['city_id']."'>".$row['city_name']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Gatvė</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="street">
                                        <?php
                                        $rowas = DB::getStreetsList();
                                        while($row = $rowas->fetch_assoc()){
                                            echo "<option value='".$row['address_id']."'>".$row['address']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label  class="col-sm-1 col-form-label">Nr.</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="house_nr" id="" placeholder=""  value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Sutarties failas</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control-file" name="contract_file" id="" placeholder="Sutarties numeris" value="" accept="document/png, image/jpeg, application/pdf">
                                </div>
                            </div>



                            <div class="form my-2 my-lg-0">
                                <button type="reset" class="btn btn-default mr-sm-2 createUserBtn">Atšaukti</button>
                                <button type="submit" class="btn userTaskButton mr-sm-2 createUserBtn" name="register_btn">Patvirtinti</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <?php require '../../includes/tools/modalAdmin.php';?>
        <script src="../../js/cardPopdown.js"></script>
        <script src="../../js/modal.js"></script>
    </body>
</html>
