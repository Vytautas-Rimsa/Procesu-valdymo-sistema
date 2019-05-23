<?php
    require_once('../../core/init.php');
    require_once('../../classes/User.php');

    $user = new User();
    if(!$user->exists()){
        //Redirect::to(404);
    } else{

    }
    $data = $user->showUsers();
    $getas = @$_GET['del_user'];
    $search = @$_POST['submit-search'];

    if(!empty($getas)){
        DB::deleteUser($getas);
        header('Location: users.php');
    }

    if(!empty($search)){
        DB::searchUser($search);
        header('Location: search.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
	    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Darbuotojų sąrašas</title>
        <link rel="stylesheet" href="../../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/scripts.js"></script>
        <script type="text/javascript" src="../../js/main.js"></script>
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
        <!-- Dropdown listui -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.14/js/jquery.tablesorter.min.js"></script>
    </head>
<style>

    /*
	Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than 760px and also iPads specifically.
	*/
    @media
    only screen
    and (max-width: 760px), (min-device-width: 768px)
    and (max-device-width: 1024px)  {

        /* Force table to not be like tables anymore */
        table, thead, tbody, th, td, tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            margin: 0 0 1rem 0;
        }

        tr:nth-child(odd) {
            background: #ccc;
        }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {
            /* Now like a table header */
            /*position: absolute;*/
            /*!* Top/left values mimic padding *!*/
            /*top: 0;*/
            /*left: 6px;*/
            /*width: 45%;*/
            padding-right: 15px;
            /*white-space: nowrap;*/
            font-weight: bold;
        }

        /*
        Label the data
    You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
        */
        td:nth-of-type(1):before { content: "Vardas:"; }
        td:nth-of-type(2):before { content: "Pavardė:"; }
        td:nth-of-type(3):before { content: "El. paštas:"; }
        td:nth-of-type(4):before { content: "Skyrius:"; }
        td:nth-of-type(5):before { content: "Pareigos:"; }
        td:nth-of-type(6):before { content: "Keisti:"; }
        td:nth-of-type(7):before { content: "Trinti:"; }
    }

</style>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button type="button" class="btn-circle infoButton" data-toggle="modal" data-target="#myMenu"><i class='fas fa-info-circle' id="logout"></i></a></button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                        <a class="nav-link" href="../../tasks/admin/activeTasks.php">Užduotys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Darbuotojai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Duomenų bazė</a>
                    </li>
                </ul>
                <form class="nav navbar-nav navbar-right" action="search.php" method="POST">
                    <li class="form-inline my-2 my-lg-0" >
                        <input class="form-control mr-sm-2 paieskaField" type="text" placeholder="Paieška" name="search" id="search" onkeyup="enableSearchButton()">
                        <button class="btn btn-secondary mr-sm-4 paieskaButton" type="submit" name="submit-search" id="searchButton" disabled>Paieška</button>
                    </li>
                    <a href="../../logout.php"><i class='fas fa-sign-out-alt' id="logout"></i></a>
                </form>
            </div>
        </nav>
    </header>

	<body id="page-top">
        <div class="container">
            <div><h3>Darbuotojų sąrašas</h3></div>
            <table table class="table table-hover" id="keywords" cellspacing="0" cellpadding="0">
                <thead role="rowgroup">
                    <tr  role="row">
                        <th role="columnheader">Nr.</th>
                        <th role="columnheader">Vardas</th>
                        <th role="columnheader">Pavardė</th>
                        <th role="columnheader">El. paštas</th>
                        <th role="columnheader">Skyrius</th>
                        <th role="columnheader">Pareigos</th>
                        <th role="columnheader"></th>
                        <th role="columnheader"></th>
                    </tr>
                </thead>

                <tbody role="rowgroup">
                <?php if ($data->num_rows > 0) {
                // output data of each row
                    $i =1;
                    while($row = $data->fetch_assoc()){
                 ?>
                    <tr class="table-light" role="row">
                        <th class="employeeList"scope="row"  role="cell"><?php echo $i; ?></th>
                        <td  class="employeeList" role="cell"><?php echo $row['vardas']; ?></td>
                        <td  class="employeeList"role="cell"><?php echo $row['pavarde']; ?></td>
                        <td  class="employeeList"role="cell"><?php echo $row['elpastas']; ?></td>
                        <td  class="employeeList"role="cell"><?php echo $row['skyrius']; ?></td>
                        <td  class="employeeList"role="cell"><?php echo $row['pareigos']; ?></td>
                        <td class="" role="cell"><a href="editUser.php?editUser=<?php echo $row['darb_id']; ?>"><i class='fas fa-edit' id="actions"></i></a></td>
                        <td class="" role="cell">
                            <a onclick="redirect('<?php echo $row['darb_id'];?>')">
                                <i class='fas fa-trash-alt' id="actions"></i>
                            </a>
                        </td>
                    </tr>
                <?php $i++;
                        }
                    } else {
                echo "Nėra įrašų";
                } ?>
                </tbody>
            </table>

            <div class="my-2 my-lg-0 addUser">
                <a href="create_user.php"><button type="submit" class="btn adminButton my-2 my-sm-0" name="addUser_btn">Pridėti darbuotoją</button></a>
            </div>
        </div>
        <div class="scroll-to-top rounded">
            <span><a href=""><i class="fas fa-angle-up upDownButton"></i> </a></span>
        </div>
        <?php require '../../includes/tools/modalAdmin.php';?>
        <script src="../../js/deleteUser.js"></script>
        <script src="../../js/modal.js"></script>
        <script>
            $(function(){
                $('#keywords').tablesorter();
            });
        </script>
    </body>
</html>
