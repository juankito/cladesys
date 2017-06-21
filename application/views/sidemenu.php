<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->

        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">

        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-accordion-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

                <li class="nav-item start">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-dashboard"></i>
                        <span class="title">Escritorio</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start">
                            <a href="#" class="nav-link">
                                <span class="title">Estadistícas</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-database"></i>  
                        <span  class="title">Almacén</span>
                        <span class="arrow"></span>
                    </a href="javascript:;" class="nav-link nav-toggle">
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/stock');">
                                Almacenes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/product');">
                                Productos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/packing');">
                            Paquetes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/brand');">
                            Marcas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/category');">
                                Categorías
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/supplier');" >
                                Proveedores
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-truck"></i>  
                        <span  class="title">Entradas</span>
                        <span class="arrow"></span>
                    </a href="javascript:;" class="nav-link nav-toggle">
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/orders');">
                                Requerimientos
                            </a>
                        </li>
                        <li class="nav-item"><a href="#">Cotización</a></li>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/input');">
                                Compras
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-shopping-cart"></i>  
                        <span  class="title">Salidas</span>
                        <span class="arrow"></span>
                    </a href="javascript:;" class="nav-link nav-toggle">
                    <ul class="sub-menu">
                      <li class="nav-item"><a href="#">Distribuciones</a></li>
                      <li class="nav-item"><a href="#">Kardex</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>  
                        <span  class="title">Configuración</span>
                        <span class="arrow"></span>
                    </a href="javascript:;" class="nav-link nav-toggle">
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="#">
                                Comprobantes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/identity');" >
                                Documentos
                            </a>
                        </li>
                      <li class="nav-item">
                        <a href="javascript:;" onclick="route('logistics/location');" >
                            Unidades
                        </a>
                      </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-users"></i>  
                        <span  class="title">Acceso</span>
                        <span class="arrow"></span>
                    </a href="javascript:;" class="nav-link nav-toggle">
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="javascript:;" onclick="route('logistics/user');">
                                Usuarios
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-question-circle"></i>  
                        <span  class="title">Ayuda</span>
                        <span class="arrow"></span>
                    </a href="javascript:;" class="nav-link nav-toggle">
                    <ul class="sub-menu">
                      <li class="nav-item"><a href="#">FAQ</a></li>
                    </ul>
                </li>

            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->