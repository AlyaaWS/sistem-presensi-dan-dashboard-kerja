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

        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .wrapper.toggled #sidebar {
            margin-left: -250px;
        }

        #sidebarCollapse {
            margin-left: -15px;
            order: -1
        }

        #entriesSelect {
            width: 20%;
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

        .top-controls .d-flex.gap-2 {
            gap: 8px;
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

        .table thead th {
            background-color: white;
            color: black;
            border: none;
        }

        .text {
            margin-top: 18px;
            margin-right: 10px;
            margin-left: -4px;
        }

        #searchInput {
            width: 100%;
            padding-left: 35px;
            padding-right: 60px;
        }

        .search-container {
            position: relative;
            width: 100%;
        }

        .search-container .fa-search {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #aaa;
            pointer-events: none;
        }

        .search-container input {
            padding-left: 35px;
        }

        .pagination .page-link {
            background-color: #ffffff;  /* pink */
            color: rgb(0, 0, 0);
        }

        .pagination .page-link:hover {
            background-color: #e0559f;
            border-color: #e0559f;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #e0559f;  /* dark blue */
            color: white;
            border-color: #e0559f;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #ccc;
            color: #777;
            border-color: #ccc;
        }

        .card {
            border-radius: 15px;
        }

        .table-responsive {
            margin-top: -15px;
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
                margin-bottom: 10px;
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
            <li><a href="{{ route('profile.edit') }}"><i class="fas fa-user-cog"></i>Profil</a></li>
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
                    <a href="{{ route('profile.edit') }}">
                        <img src="{{ asset('profile.jpg') }}" alt="Profile" class="rounded-circle" style="width: 70px; height: 40px;">
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <div class="container-fluid mt-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center top-controls mb-3">
                <div class="d-flex align-items-center">
                    <label for="entriesSelect" class="mr-2 mb-0 text-white">Show</label>
                    <select id="entriesSelect" class="form-control form-control-sm mr-3">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <p class="text text-white">entries</p>
                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari admin...">
                    </div>
                </div>
                <div class="d-flex gap-2 mt-2 mt-md-0">
                    <button class="btn btn-pink mr-2" data-toggle="modal" data-target="#tambahRoleModal">
                        Tambah Role
                    </button>
                    <a href="{{ route('tambah.admin') }}" class="btn btn-pink mr-2">Tambah Admin</a>
                    <a href="#" class="btn btn-pink">Unduh</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id_Admin</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="adminTable">
                                <tr>
                                    <td>1</td>
                                    <td>Alya Wahyuning</td>
                                    <td>alya@example.com</td>
                                    <td>13/10/04</td>
                                    <td>kepodong123.</td>
                                    <td>Super Admin</td>
                                    <td>Active</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Muchamad Sanaya Almatin</td>
                                    <td>sanaya@example.com</td>
                                    <td>13/10/04</td>
                                    <td>kepodong123.</td>
                                    <td>Super Admin</td>
                                    <td>Active</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <nav>
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
    </div>
</div>

<div class="footer">@AALYAAS</div>

<!-- Modal -->
<div class="modal fade" id="tambahRoleModal" tabindex="-1" role="dialog" aria-labelledby="tambahRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="POST" action="{{ route('role.store') }}">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahRoleModalLabel">Tambah Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="nama_role">Nama Role</label>
              <input type="text" name="nama_role" class="form-control" placeholder="Contoh: Admin Presensi" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="cancel" class="btn btn-secondary">Cancel</button>
            <button type="cancel" class="btn btn-primary">Lihat Role</button>
            <button type="submit" class="btn btn-pink">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

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
            $('#adminTable tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
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


</body>
</html>
