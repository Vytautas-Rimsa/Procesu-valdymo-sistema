
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
            <!-- Sidebar -->
            <ul class="sidebar userSidebar navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="createClient.php">
                        <span>Fizinis asmuo</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span>Juridinis asmuo</span>
                    </a>
                </li>
            </ul>

            <div class="container">
                <div class="col-sm-6 offset-sm-3">
                    <div class="headerUser">
                        <h2>Sukurti naują klientą</h2>
                    </div>

                    <form method="post" action="createClient.php" class="formaAplication">

                        <fieldset>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Sutarties nr.</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="contractNb" id="" placeholder="Sutarties numeris" value="" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pavadinimas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="comapny" id="" placeholder="Įmonės pavadinimas" value="" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Įmonės kodas</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="code" id="" placeholder="Įmonės kodas" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">PVM kodas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="vat" id="" placeholder="PVM mokėtojo kodas" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">El. paštas</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="elpastas" id="" placeholder="El. pašto adresas"  value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Telefono nr.</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone" id="" placeholder="Telefono numeris"  value="">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label"><b>Adresas korespondencijai</b></label>
                            </div>


                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Gatvė</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="street" id="" value="">
                                        <option value="">Pasirinkite gatvę</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <label  class="col-sm-1 col-form-label">Nr.</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="number" id="" placeholder=""  value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Miestas</label>
                                <div class="col-sm-9">
                                    <select class="form-control subcat" name="miestas" id="" value="">
                                        <option value="">Pasirinkite miestą</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form my-2 my-lg-0">
                                <i class='fas fa-paperclip' id="infoLight"></i>
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
