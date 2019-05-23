<?php
echo "<!-- Sidebar -->
            <ul class=\"sidebar userSidebar navbar-nav\">
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"activeTasks.php\">
                        <i class='fas fa-user-circle'></i>
                        <span>Mano užduotys</span>
                    </a>
                </li>
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"myCreatedTasks.php\">
                        <i class='far fa-sticky-note'></i>
                        <span>Mano sukurtos užduotys</span>
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
                <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"myTasksReport.php\">
                        <i class='far fa-sticky-note'></i>
                        <span>Mano užduočių ataskaita</span>
                    </a>
                </li>
                </li>        
            </ul>";