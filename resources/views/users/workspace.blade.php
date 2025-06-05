<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Workspace</title>
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
            order: -1;
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

        .top-controls {
            gap: 15px;
            flex-wrap: wrap;
        }

        #entriesSelect {
            width: 80px;
        }

        .text {
            margin-bottom: 0;
            color: #fff;
            margin-right: 10px;
        }

        .search-container {
            position: relative;
            width: 200px;
        }

        .search-container .fa-search {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
        }

        .search-container input {
            padding-left: 32px;
        }

        .btn-pink {
            background-color: #ff69b4;
            font-weight: 600;
            color: white;
            border-radius: 6px;
        }

        .btn-pink:hover {
            background-color: #e0559f;
            color: white;
        }

        .workspace-item {
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dropdown-custom {
    position: relative;
    display: inline-block;
}

.dropdown-custom i {
    cursor: pointer;
    padding: 5px;
}

.dropdown-menu-custom {
    display: none;
    position: absolute;
    top: 25px;
    right: 0;
    background-color: #3f63f7; /* Warna biru */
    border-radius: 12px;
    padding: 16px;
    z-index: 1000;
    width: 200px;
    font-family: 'Segoe UI', sans-serif;
}

.dropdown-menu-custom h6 {
    margin-bottom: 10px;
    font-size: 14px;
    font-weight: bold;
    color: white;
    opacity: 0.9;
}

.dropdown-menu-custom a,
.dropdown-menu-custom button {
    display: block;
    width: 100%;
    padding: 8px 0;
    color: white;
    text-decoration: none;
    background: none;
    border: none;
    text-align: left;
    font-size: 14px;
    cursor: pointer;
}

.workspace-list a {
    color: inherit;
    text-decoration: none;
}

.workspace-list a:hover {
    text-decoration: none;
}


.dropdown-menu-custom a:hover,
.dropdown-menu-custom button:hover {
    text-decoration: underline;
}

/* Tampilkan dropdown saat ada class 'show' */
.dropdown-menu-custom.show {
    display: block;
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

            .top-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .top-controls > div {
                width: 100%;
                margin-bottom: 10px;
            }

            .search-container {
                width: 100%;
            }

            .search-container input {
                width: 100%;
            }

            #entriesSelect {
                width: 100%;
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
                <a href="{{ route('profil.user') }}"><i class="fas fa-user-cog"></i>Profil</a>
            </li>
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
        <!-- Navbar Atas -->
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

        <!-- Konten Workspace -->
        <div class="container mt-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center top-controls mb-3">
                <div class="d-flex align-items-center">
                    <label for="entriesSelect" class="mr-2 mb-0 text-white">Show</label>
                    <select id="entriesSelect" class="form-control form-control-sm mr-2">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <p class="text text-white">entries</p>
                    <div class="search-container ml-3">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari workspace...">
                    </div>
                </div>
                <div class="mt-2 mt-md-0">
                    <a href="#" class="btn btn-pink" data-toggle="modal" data-target="#addWorkspaceModal">Tambah Workspace</a>
                </div>
            </div>

            <!-- Daftar Workspace -->
            <div class="workspace-list">
@forelse ($workspaces as $workspace)
    <div onclick="window.location='{{ route('workspace.boards', $workspace->id_workspace) }}'"
         class="workspace-item d-flex justify-content-between align-items-center mb-3 p-3 bg-white rounded"
         style="cursor: pointer; position: relative;">
        
        <span>{{ $workspace->title }}</span>

        <div class="dropdown-custom" onclick="event.stopPropagation();">
            <i class="fas fa-ellipsis-v text-muted toggle-dropdown"></i>
            <div class="dropdown-menu-custom">
                <h6>Workspace Actions</h6>
                <a href="#" data-toggle="modal" data-target="#addWorkspaceModal">Add workspace</a>
                <form action="{{ route('workspace.copy', $workspace->id_workspace) }}" method="POST">
                    @csrf
                    <button type="submit">Copy workspace</button>
                </form>
                <form action="{{ route('workspace.destroy', $workspace->id_workspace) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus workspace ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete workspace</button>
                </form>
                <a href="#" data-toggle="modal" data-target="#renameModal{{ $workspace->id_workspace }}">Rename workspace</a>
                <a href="#">View members</a>
            </div>
        </div>
    </div>
@empty
    <p class="text-white">Belum ada workspace</p>
@endforelse
</div>


            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
                <br>
                <br>
            </nav>
        </div>
    </div>
</div>

<!-- Footer -->
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

        $('#searchInput').on('keyup', function () {
            let value = $(this).val().toLowerCase();
            $('.workspace-item').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('.toggle-dropdown');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', function () {
                const dropdown = this.nextElementSibling;

                // Tutup semua dropdown dulu
                document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                    if (menu !== dropdown) {
                        menu.classList.remove('show');
                    }
                });

                // Toggle dropdown ini
                dropdown.classList.toggle('show');
            });
        });

        // Tutup dropdown jika klik di luar
        window.addEventListener('click', function (e) {
            if (!e.target.matches('.toggle-dropdown')) {
                document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });
    });
</script>

@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#e0559f'
    });
</script>
@endif

<!-- Modal Tambah Workspace -->
<div class="modal fade" id="addWorkspaceModal" tabindex="-1" aria-labelledby="addWorkspaceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('workspace.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addWorkspaceModalLabel">Tambah Workspace</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Workspace</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-pink">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@foreach ($workspaces as $workspace)
<div class="modal fade" id="renameModal{{ $workspace->id_workspace }}" tabindex="-1" aria-labelledby="renameModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <form method="POST" action="{{ route('workspace.rename', $workspace->id_workspace) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
              <div class="modal-header">
                   <h5 class="modal-title">Ganti Nama Workspace</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
              </div>
              <div class="modal-body">
                   <input type="text" name="title" class="form-control" value="{{ $workspace->title }}" required>
              </div>
              <div class="modal-footer">
                   <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
         </form>
     </div>
</div>
@endforeach

</body>
</html>
