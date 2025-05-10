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

        .btn-pink {
            background-color: #ff69b4;
            color: white;
            border-radius: 6px;
            font-weight: 540;
        }

        .btn-pink:hover {
            background-color: #e0559f;
            color: white;
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

        h3 {
            text-align: center;
            padding-bottom: 5px;
        }

        button .btn-secondary {
            margin-top: 10px;
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
            <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fas fa-home mr-2"></i>Home</a>
            </li>
            <li class="{{ Route::is('kelola.admin') ? 'active' : '' }}">
                <a href="{{ route('kelola.admin') }}"><i class="fas fa-user-shield mr-2"></i>Kelola Admin</a>
            </li>
            <li class="{{ Route::is('kelola.pengguna') ? 'active' : '' }}">
                <a href="{{ route('kelola.pengguna') }}"><i class="fas fa-user mr-2"></i>Kelola Pengguna</a>
            </li>
            <li class="{{ Route::is('kelola.presensi') ? 'active' : '' }}">
                <a href="{{ route('kelola.presensi') }}"><i class="fas fa-calendar-alt mr-2"></i>Kelola Presensi</a>
            </li>
            <li><a href="{{ route('profil') }}"><i class="fas fa-user-cog"></i>Profil</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="logout-link">
                        <i class="fas fa-sign-out-alt"></i>Logout
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
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px;">
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main content goes here -->
    <div class="container mt-4">
    <h3 class="text-white font-weight-bold mb-4">Tambah Presensi</h3>
    <form action="{{ route('tambah.presensi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Pengguna</label>
            <select name="id_user" class="form-control rounded" required>
                <option value="">Pilih Pengguna</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nama_lengkap }} - {{ $user->role->nama_role ?? '-' }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="date" class="form-control rounded" required>
        </div>
        <div class="form-group">
            <label>Waktu</label>
            <div class="d-flex">
                <input type="time" name="time" id="time" class="form-control rounded" step="1">
                <button type="button" class="btn btn-secondary ml-2" onclick="isiWaktuSekarang()">Sekarang</button>
            </div>
        </div>        
        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="location" class="form-control rounded" placeholder="Masukkan lokasi" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-pink px-4">Simpan</button>
        </div>
    </form>    
    <br>
    <br>
    <br> 
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
<script>
    function isiWaktuSekarang() {
        const timeInput = document.getElementById('time');
        const now = new Date();

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        timeInput.value = `${hours}:${minutes}:${seconds}`;
    }
</script>

</body>
</html>
