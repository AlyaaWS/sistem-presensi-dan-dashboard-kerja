<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #151D4B;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .wrapper {
            display: flex;
            width: 100%;
            flex-grow: 1;
            transition: all 0.3s;
        }

        #sidebar {
            width: 250px;
            background: #fff;
            color: #666;
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -250px;
        }

        #sidebar .sidebar-header {
            text-align: center;
            padding: 10px;
        }

        #sidebar .sidebar-header img {
            width: 200px;
        }

        #sidebar ul.components {
            padding-left: 0;
            margin-top: -40px;
        }

        #sidebar ul li a,
        .logout-link {
            display: flex;
            align-items: center;
            padding: 13px 20px;
            font-size: 0.9em;
            color: #666;
            text-decoration: none;
            margin-bottom: 10px;
            transition: all 0.2s ease;
        }

        #sidebar ul li a i,
        .logout-link i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }

        #sidebar ul li a:hover,
        .logout-link:hover {
            color: #fff !important;
            background-color: #151D4B;
            font-weight: 600;
        }

        #sidebar ul li.active > a {
            background-color: #151D4B;
            color: #fff !important;
            font-weight: 600;
        }

        #sidebar ul li a:hover i,
        .logout-link:hover i {
            color: #fff;
        }

        #sidebarCollapse {
            margin-left: -15px;
            order: -1
        }

        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #007bff !important;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
            background-color: #415dd0;
            color: white;
            font-weight: 700;
        }

        .card h6 {
            font-weight: 600;
        }

        .card input[type="checkbox"] {
            transform: scale(1.2);
            cursor: default;
        }

        .badge {
            font-size: 0.75rem;
            padding: 4px 8px;
            background-color: #eee;
            color: #333;
        }

        .btn-primary {
            background-color: #ff69b4;
            border: none;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #e0559f;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -230px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #sidebarCollapse span {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('logo_putih.png') }}" alt="Logo">
        </div>
        <ul class="list-unstyled components">
            <li class="{{ Route::is('dashboard.user') ? 'active' : '' }}">
                <a href="{{ route('dashboard.user') }}"><i class="fas fa-home mr-2"></i>Home</a>
            </li>
            <li class="{{ Route::is('presensi') ? 'active' : '' }}">
                <a href="{{ route('presensi') }}"><i class="fas fa-user-shield mr-2"></i>Presensi</a>
            </li>
            <li>
                <a href="#workspaceSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-layer-group mr-2"></i>Work
                </a>
                <ul class="collapse list-unstyled {{ (request()->is('workspace*') || request()->is('board*')) ? 'show' : '' }}" id="workspaceSubmenu">
                    <li class="{{ Route::is('workspace') ? 'active' : '' }}">
                        <a href="{{ route('workspace') }}"><i class="fas fa-user-shield mr-2"></i>Workspace</a>
                    </li>
                    <li class="{{ Route::is('board') ? 'active' : '' }}">
                        <a href="{{ route('board') }}"><i class="fas fa-user-shield mr-2"></i>Board</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Route::is('profil.user') ? 'active' : '' }}">
                <a href="{{ route('profil.user') }}"><i class="fas fa-user-cog"></i>Profil</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i>Logouttt
                    </a>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #151D4B;">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
                <div class="d-flex align-items-center">
                    <a href="#" class="text-white mr-3" title="Notifications">
                        <i class="fas fa-bell fa-lg"></i>
                    </a>
                    <a href="{{ route('profil') }}">
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px;">
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <div class="container mt-4">
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <label for="entriesSelect" class="mr-2 text-white">Show</label>
                    <select id="entriesSelect" class="form-control form-control-sm mr-2" style="width: 70px;">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                    <span class="text-white">entries</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="input-group mr-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <button class="btn btn-primary">Tambah Board</button>
                </div>
            </div>

            <div class="row">
                <!-- Contoh Board (copas ini untuk tambah lainnya) -->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card shadow-sm rounded p-3 position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 font-weight-bold">Task Week 1</h6>
                            <i class="fas fa-ellipsis-v text-muted" style="cursor:pointer;"></i>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2 d-flex align-items-center justify-content-between">
                                <div>
                                    <input type="checkbox" checked disabled class="mr-2">Membuat tampilan admin
                                    <div class="badge badge-light mt-1">1 dec 2024 – 5 dec 2024</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img src="https://i.pravatar.cc/30?img=1" class="rounded-circle mr-1" width="24">
                                    <img src="https://i.pravatar.cc/30?img=2" class="rounded-circle mr-1" width="24">
                                    <img src="https://i.pravatar.cc/30?img=3" class="rounded-circle" width="24">
                                </div>
                            </li>
                            <li class="mb-2 d-flex align-items-center justify-content-between">
                                <div><input type="checkbox" disabled class="mr-2">Membuat tampilan pengguna</div>
                                <span>
                                    <i class="fas fa-pen mr-2 text-dark"></i>
                                    <i class="fas fa-trash text-danger"></i>
                                </span>
                            </li>
                        </ul>
                        <button class="btn btn-sm btn-primary mt-2">Add +</button>
                    </div>
                </div>
                <!-- /Contoh Board -->
            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="footer">@AALYAAS</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $('.wrapper').toggleClass('toggled');
        });
    });
</script>

</body>
</html>
