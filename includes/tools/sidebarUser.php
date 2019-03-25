<?php
echo "<!-- Sidebar -->
            <ul class=\"sidebar userSidebar navbar-nav\">
                <li class=\"nav-item\">
                    <a class=\"nav-link active\" href=\"activeTasks.php\">                        
                        <i class='fas fa-user-circle'></i>
                        <span>Mano užduotys</span>
                    </a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"pagesDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        <i class='far fa-file-alt'></i>
                        <span>Nauja užduotis</span>
                    </a>
                    <div class=\"dropdown-menu\" aria-labelledby=\"pagesDropdown\">
                        <a class=\"dropdown-item\" href=\"newTaskAdministration.php\">Administracijai</a>
                        <a class=\"dropdown-item\" href=\"newTaskSecurity.php\">Apsaugos skyriui</a>
                        <a class=\"dropdown-item\" href=\"newTaskFinance.php\">Finansų skyriui</a>
                        <a class=\"dropdown-item\" href=\"newTaskCommerce.php\">Komercijos skyriui</a>
                        <a class=\"dropdown-item\" href=\"newTaskPersonal.php\">Personalo skyriui</a>
                        <a class=\"dropdown-item\" href=\"newTaskTech.php\">Techninis skyriui</a>
                    </div>
                </li>
                <li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"pagesDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                    <i class='fas fa-tasks'></i>
                        <span>Užduočių ataskaita</span>
                    </a>
                    <div class=\"dropdown-menu\" aria-labelledby=\"pagesDropdown\">                        
                        <a class=\"dropdown-item\" href=\"#\">Dienos</a>
                        <a class=\"dropdown-item\" href=\"#\">Savaitės</a>
                        <a class=\"dropdown-item\" href=\"#\">Mėnesio</a>                        
                        <a class=\"dropdown-item\" href=\"#\">Pasirinkto laikotarpio</a>
                        <!-- <div class=\"dropdown-divider\"></div> -->
                        <!-- <h6 class=\"dropdown-header\">Other Pages:</h6> -->                        
                    </div>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"charts.html\">
                        <i class=\"fas fa-fw fa-chart-area\"></i>
                        <span>Charts</span>
                    </a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"tables.html\">
                        <i class=\"fas fa-fw fa-table\"></i>
                        <span>Tables</span>
                    </a>
                </li>
            </ul>";