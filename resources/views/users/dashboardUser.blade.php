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

        .wrapper.toggled #sidebar {
            margin-left: -250px;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #007bff !important;
        }

        #sidebar ul li.active > a {
            background-color: #151D4B;
            color: #fff !important;
            font-weight: 600;
        }

        #sidebar ul li.active > a i {
            color: #fff;
        }

        #backToTop {
            position: fixed;
            bottom: 70px;
            right: 20px;
            display: none;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }

        

#backToTop:hover {
    background-color: #0056b3;
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
                <ul class="collapse list-unstyled {{ request()->is('workspace*') ? 'show' : '' }}" id="workspaceSubmenu">
                    <li class="{{ Route::is('workspace') ? 'active' : '' }}">
                        <a href="{{ route('workspace') }}"><i class="fas fa-user-shield mr-2"></i>Workspace</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Route::is('profil.user') ? 'active' : '' }}">
                <a href="{{ route('profil.user') }}"><i class="fas fa-user-cog"></i>Profil</a></li>
            <li>
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

        <!-- Main content goes here -->
        <h5 class="text-white mt-4">Undangan Workspace</h5>
    @foreach(Auth::user()->workspaces()->wherePivot('status', 'pending')->get() as $workspace)
        <div class="workspace-item p-3 bg-light rounded mb-2">
            <strong>{{ $workspace->title }}</strong>
            <form method="POST" action="{{ route('workspace.accept', $workspace->id_workspace) }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Terima</button>
            </form>
            <form method="POST" action="{{ route('workspace.reject', $workspace->id_workspace) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
            </form>
        </div>
    @endforeach

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

<button onclick="scrollToTop()" id="backToTop" title="Kembali ke atas"><i class="fas fa-arrow-up"></i></button>

<script>
    // Tampilkan tombol ketika scroll turun 100px
    window.onscroll = function () {
        const btn = document.getElementById("backToTop");
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    };

    // Fungsi scroll ke atas
    function scrollToTop() {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    }
</script>

</body>
</html>
