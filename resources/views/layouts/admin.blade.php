<!DOCTYPE html>
@include('components.chat')
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISTEMA DE ARCHIVOS VIACHA</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--jquery -->
    <script src="{{asset('plugins/jquery/jquery.js')}}"></script>
    <!-- tablas  -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- sweetarlet2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini">
    @yield('scripts')

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{url('/')}}" class="nav-link">SISTEMA DE ARCHIVOS VIACHA</a>
                </li>
                <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>-->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('/')}}" class="brand-link">
                <img src="{{url('/dist/img/logo1.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">SISTEMA ARCHIVOS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{url('/dist/img/usuario.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <!-- Unidades -->
                        <style>
                        /* Estilo general del menú formal */
                        .nav-sidebar .nav-link {
                            color: #2c3e50;
                            /* azul oscuro elegante */
                            font-weight: 500;
                            font-size: 0.95rem;
                            transition: background 0.3s, color 0.3s;
                        }

                        .nav-sidebar .nav-link.active {
                            background-color: #34495e;
                            /* fondo gris oscuro */
                            color: #ecf0f1;
                            /* texto blanco */
                            font-weight: bold;
                        }

                        .nav-sidebar .nav-link:hover {
                            background-color: #2c3e50;
                            color: #ffffff;
                        }

                        .nav-sidebar .nav-treeview {
                            padding-left: 15px;
                        }

                        .nav-sidebar .nav-treeview .nav-link {
                            font-size: 0.9rem;
                            color: #34495e;
                        }

                        .nav-sidebar .nav-treeview .nav-link:hover {
                            color: #1abc9c;
                            /* color verde formal para resaltar */
                            font-weight: 600;
                        }

                        /* Iconos */
                        .nav-link i {
                            margin-right: 10px;
                            font-size: 1.1rem;
                        }

                        /* Submenús con borde suave */
                        .nav-sidebar .nav-treeview {
                            border-left: 2px solid #bdc3c7;
                            margin-left: 5px;
                            padding-left: 10px;
                        }
                        </style>

                        <!-- Unidades -->
                        @hasanyrole('administrador|central|smaf')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-diagram-2-fill"></i>
                                <p>Unidades Viacha <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('unidades/create') }}" class="nav-link">
                                        <i class="bi bi-plus-circle"></i>
                                        <p>Crear Unidad</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('unidades') }}" class="nav-link">
                                        <i class="bi bi-list-ul"></i>
                                        <p>Listado Unidades</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
                        <!-- Archivos -->
                        @hasanyrole('administrador|central')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-folder2-open"></i>
                                <p>Archivos Viacha <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('archivos/create') }}" class="nav-link">
                                        <i class="bi bi-plus-circle"></i>
                                        <p>Crear Archivo</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('archivos') }}" class="nav-link">
                                        <i class="bi bi-list-ul"></i>
                                        <p>Listado Archivos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('prestamo_central.index') }}" class="nav-link">
                                        <i class="bi bi-key"></i>
                                        <p>Prestamos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
                        <!-- Categorías -->
                        @hasanyrole('administrador|central')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-archive"></i>
                                <p>Categorías Documentos <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('categorias/create') }}" class="nav-link">
                                        <i class="bi bi-plus-circle"></i>
                                        <p>Crear Categoría</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('categorias') }}" class="nav-link">
                                        <i class="bi bi-list-ul"></i>
                                        <p>Listado Categorías</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
                        <!-- Archivos Financieros -->
                        @role('administrador')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-bank2"></i>
                                <p>Archivos Financieros <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('financieras/create') }}" class="nav-link">
                                        <i class="bi bi-plus-circle"></i>
                                        <p>Crear Financiera</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('financieras') }}" class="nav-link">
                                        <i class="bi bi-list-ul"></i>
                                        <p>Listado Financieros</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endrole
                        <!-- Administración SMAF -->
                        @hasanyrole('administrador|smaf')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-bank"></i>
                                <p>Administración SMAF <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">

                                    <a href="{{ route('smaf.financieras.index') }}" class="nav-link">
                                        <i class="bi bi-gear"></i>
                                        <p>Gestión Financiera</p>
                                    </a>

                                </li>


                                <li class="nav-item">
                                    <a href="{{ url('areas') }}" class="nav-link">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <p>Actas SMAF</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endhasanyrole
                        <!-- Administración Despacho -->
                        @hasanyrole('administrador|despacho')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-briefcase-fill"></i>
                                <p>Administración Despacho <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">


                                <!-- Registros enviados Despacho -->
                                <li class="nav-item">

                                    <a href="{{ route('despacho.financieras.index') }}" class="nav-link">
                                        <i class="bi bi-journal-check"></i>
                                        <p>Registros enviados Despacho</p>
                                    </a>
                                </li>

                                <!-- Actas Despacho -->
                                <li class="nav-item">
                                    <a href="{{ route('areas-despacho.index') }}" class="nav-link">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <p>Actas Despacho</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
                        @hasanyrole('administrador|tesoreria')
                        <!-- Tesorería -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-wallet2"></i>
                                <p>Administración Tesorería <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('tesoreria.financieras.index') }}" class="nav-link">
                                        <i class="bi bi-gear"></i>
                                        <p>Gestión de Registros</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('areas-archivos.index') }}" class="nav-link">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <p>Actas Tesorería</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
                        <!-- Archivos -->
                        @hasanyrole('administrador|archivos')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-wallet2"></i>
                                <p>Administración Archivos <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('financieras.archivos.index') }}" class="nav-link">
                                        <i class="bi bi-archive-fill"></i>
                                        <p>Archivos Financieros</p>
                                    </a>

                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
                        <!-- GESTION DE ARCHIVOS-->
                        @hasanyrole('administrador|archivos')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-archive"></i>
                                <p>Gestion Archivos <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('ubicaciones.index') }}" class="nav-link">
                                        <i class="bi bi-layout-text-sidebar-reverse"></i>
                                        <p>Ubicación de Archivos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('prestamos.index') }}" class="nav-link">
                                        <i class="bi bi-box-arrow-in-down"></i>
                                        <p>Préstamos de Archivos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole

                        <!-- SMAF Registros -->
                        @role('administrador')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-journal-text"></i>
                                <p>SMAF <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('preventivos') }}" class="nav-link">
                                        <i class="bi bi-list-check"></i>
                                        <p>Registros SMAF</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endrole
                        <!-- Historial Archivos -->
                        @role('administrador')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-bar-chart-line-fill"></i>
                                <p>Historial Archivos <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('historial-archivos/create') }}" class="nav-link">
                                        <i class="bi bi-plus-circle"></i>
                                        <p>Crear Historial</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('historial-archivos') }}" class="nav-link">
                                        <i class="bi bi-list-ul"></i>
                                        <p>Listado Historial</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endrole

                        <!-- Administración Usuarios -->
                        @role('administrador')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-shield"></i>
                                <p>Administración <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="bi bi-person"></i>
                                        <p>Usuarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link">
                                        <i class="bi bi-person-badge"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('permissions.index') }}" class="nav-link">
                                        <i class="bi bi-key"></i>
                                        <p>Permisos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endrole
                        <!-- Usuarios 
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-people-fill"></i>
                                <p>Usuarios <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('usuarios/create') }}" class="nav-link">
                                        <i class="bi bi-person-plus"></i>
                                        <p>Crear Usuario</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('usuarios') }}" class="nav-link">
                                        <i class="bi bi-list-ul"></i>
                                        <p>Listado Usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>-->


                        <!-- ..-->
                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" style="background-color: #FF6666">


                                <i class="nav-icon">
                                    <i class="bi bi-lock-fill"></i>
                                </i>
                                Cerrar Sesion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <!-- aqui arriba para cerrar sesion-->

                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <br>

            <div class="content">
                @yield('content')

            </div>

            <div class="content">
                @yield('footer')
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        <!-- /.control-sidebar -->


        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2025 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>


    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->

    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>



    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Bootstrap JS y dependencias Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <!-- Opcional: Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</body>

</html>