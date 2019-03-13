
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
            <a class="navbar-brand" href="#">CRM</a>
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
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span>Juridinis asmuo</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="createClient.php">
                        <span>Fizinis asmuo</span>
                    </a>
                </li>
            </ul>

            <form method="post" action="" class="">
                <div id="content-wrapper">
                    <div class="container-fluid">
                        <!-- Area Chart Example-->
                        <div class="card mb-3">
                            <div class="card-header userCardHeader">Juridinis asmuo</div>
                            <div class="card-body">
                                <fieldset>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label userWords">Sutarties numeris</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                        <label for="" class="col-sm-2 col-form-label userWords">Sutarties pasirašymo data</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label userWords">Įmonės pavadinimas</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                        <label for="" class="col-sm-1.5 col-form-label userWords">Įmonės kodas</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                        <label for="" class="col-sm-1.5 col-form-label userWords">PVM kodas</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label userWords"><b>Buveinės adresas</b></label>
                                        <label for="" class="col-sm-0.5 col-form-label userWords">Gatvė</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                        <label for="" class="col-sm-0.5 col-form-label userWords">Namo nr.</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                        <label for="" class="col-sm-0.5 col-form-label userWords">Buto nr.</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                        <label for="" class="col-sm-0.5 col-form-label userWords">Miestas</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label userWords"><b>Adresas korespondencijai</b></label>
                                        <label for="" class="col-sm-0.5 col-form-label userWords">Gatvė</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                        <label for="" class="col-sm-0.5 col-form-label userWords">Namo nr.</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                        <label for="" class="col-sm-0.5 col-form-label userWords">Buto nr.</label>
                                        <div class="col-sm-1">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                        <label for="" class="col-sm-0.5 col-form-label userWords">Miestas</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-1 col-form-label userWords">El. paštas</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                        <label for="" class="col-sm-1.5 col-form-label userWords">Telefono nr.</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="" id="" placeholder="" value="">
                                        </div>
                                    </div>

                                    <div class="form-inline my-2 my-lg-0" style="float: right;">
                                        <a href="" class="btn userButton my-2 my-sm-0">Sukurti klientą</a>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="card-footer small text-muted"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
