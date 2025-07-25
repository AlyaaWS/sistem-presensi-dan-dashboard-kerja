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
    /* Sidebar responsif */
    #sidebar {
        position: fixed;
        height: 100%;
        z-index: 999;
        top: 0;
        left: 0;
        margin-left: -250px;
        transition: all 0.3s;
    }

    #sidebar.active {
        margin-left: 0;
    }

    .wrapper.toggled #sidebar {
        margin-left: 0px;
    }

    #sidebarCollapse {
    transition: all 0.3s ease;
    position: absolute;
    left: 20px;
    top: 15px;
    z-index: 1050;
    }

    .wrapper.toggled #sidebarCollapse {
    left: 270px;
    }


    /* Tombol toggle */
    #sidebarCollapse span {
        display: none;
    }

    /* Konten menyesuaikan */
    #content {
        padding: 10px;
    }

    /* Navbar lebih fleksibel */
    .navbar .container-fluid {
        flex-direction: row;
        justify-content: space-between;
    }

    .navbar .d-flex {
        margin-top: 10px;
        width: 100%;
        justify-content: flex-end;
    }

    /* Kartu dan teks jadi lebih kecil */
    .card .card-title {
        font-size: 1rem;
    }

    .card .card-text.display-4 {
        font-size: 1.5rem;
    }

    /* Footer di mobile */
    .footer {
        font-size: 0.8rem;
        padding: 8px;
    }

    /* Tombol scroll to top */
    #backToTop {
        bottom: 60px;
        right: 15px;
        padding: 8px 12px;
        font-size: 16px;
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
                    <a href="{{ route('profil') }}">
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px;">
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main content goes here -->
        <div class="container mt-4">
    <h2 class="text-white mb-4">Selamat datang, {{ Auth::user()->name }} 👋</h2>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Workspace</h5>
                    <p class="card-text display-4">{{ $workspaceCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Board</h5>
                    <p class="card-text display-4">{{ $boardCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Selesai</h5>
                    <p class="card-text display-4">{{ $completedTasks }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Belum Selesai</h5>
                    <p class="card-text display-4">{{ $pendingTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($pendingInvites->count())
    <div class="alert alert-info mt-4">
        <h5>Undangan Workspace</h5>
        <ul class="list-group">
            @foreach($pendingInvites as $invite)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $invite->title }}</strong><br>
                        <small>Diundang oleh: {{ $invite->user->name ?? 'Tidak diketahui' }}</small>
                    </div>
                    <div>
                        <form action="{{ route('workspace.accept', $invite->id_workspace) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Terima</button>
                        </form>
                        <form action="{{ route('workspace.reject', $invite->id_workspace) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin tolak undangan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endif


    <!-- Presensi Hari Ini -->
    <div class="card mt-4">
        <div class="card-header bg-dark text-white">
            Jadwal Presensi Hari Ini
        </div>
        <div class="card-body">
            @if ($todaySchedule)
                <p><strong>Jam:</strong> {{ $todaySchedule->start_time }} - {{ $todaySchedule->end_time }}</p>
                <p><strong>Hari Aktif:</strong> {{ ucfirst($todaySchedule->active_day) }}</p>
            @else
                <p class="text-muted">Tidak ada jadwal aktif saat ini.</p>
            @endif
        </div>
    </div>
</div>
<br>
<br>



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
            $('#overlay').toggleClass('active');
        });

        $('#overlay').on('click', function () {
            $('#sidebar').removeClass('active');
            $('.wrapper').removeClass('toggled');
            $(this).removeClass('active');
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
