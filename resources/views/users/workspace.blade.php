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
            z-index: 3;
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
                        <a href="{{ route('workspace.boards', Auth::user()->workspaces->first()->id_workspace ?? 0) }}">
                         <i class="fas fa-user-shield mr-2"></i>Workspace</a>
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
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
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
            <div class="workspace-item d-flex justify-content-between align-items-center mb-3 p-3 bg-white rounded"
     data-title="{{ strtolower($workspace->title) }}"
     style="cursor: pointer; position: relative;"
     onclick="window.location='{{ route('workspace.boards', $workspace->id_workspace) }}'">
    <span>{{ $workspace->title }}</span>

        <!-- Dropdown Actions -->
        <div class="dropdown-custom" onclick="event.stopPropagation();">
            <i class="fas fa-ellipsis-v text-muted toggle-dropdown"></i>
            <div class="dropdown-menu-custom">
                <h6>Workspace Actions</h6>

                <!-- Copy -->
                <form action="{{ route('workspace.copy', $workspace->id_workspace) }}" method="POST">
                    @csrf
                    <button type="submit">Copy workspace</button>
                </form>

                <!-- Delete -->
                <form action="{{ route('workspace.destroy', $workspace->id_workspace) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus workspace ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete workspace</button>
                </form>

                <!-- Rename -->
                <a href="#" onclick="$('#renameModal{{ $workspace->id_workspace }}').modal('show'); return false;">Rename workspace</a>


                <!-- View & Invite -->
                <a href="#" class="view-invite-btn" data-target="#viewMembersModal{{ $workspace->id_workspace }}">View & Invite</a>
            </div>
        </div>
    </div>

    <!-- Modal Rename -->
    <div class="modal fade" id="renameModal{{ $workspace->id_workspace }}" tabindex="-1" aria-labelledby="renameModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('workspace.rename', $workspace->id_workspace) }}">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Rename Workspace</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Nama Baru</label>
                            <input type="text" name="title" class="form-control" value="{{ $workspace->title }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-pink">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal View + Invite -->
    <div class="modal fade" id="viewMembersModal{{ $workspace->id_workspace }}" tabindex="-1" aria-labelledby="viewMembersModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Anggota Workspace</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Daftar Anggota --}}
                    <ul class="list-group mb-3">
                        @forelse ($workspace->members as $member)
<li class="list-group-item d-flex justify-content-between align-items-center">
    {{ $member->name }}
    <div class="d-flex align-items-center">
        <span class="badge badge-secondary mr-2">{{ $member->pivot->role_in_workspace }}</span>

        @if(Auth::id() === $workspace->id_user && $member->id !== $workspace->id_user)
        <form action="{{ route('workspace.removeMember', [$workspace->id_workspace, $member->id]) }}" method="POST" onsubmit="return confirm('Hapus member ini?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-user-times"></i></button>
        </form>
        @endif
    </div>
</li>
@empty
<p class="text-muted">Belum ada member</p>
@endforelse


                    {{-- Form Invite Member --}}
                    <form method="POST" action="{{ route('workspace.invite') }}">
                        @csrf
                        <input type="hidden" name="id_workspace" value="{{ $workspace->id_workspace }}">
                        <div class="form-group">
                            <label for="email">Invite via Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="Email pengguna yang terdaftar">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-pink">Undang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@empty
    <p class="text-white">Belum ada workspace</p>
@endforelse
</div>


            <!-- Pagination -->
            <!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $workspaces->links() }}
</div><br><br>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Buka modal manual untuk elemen .view-invite-btn
    document.querySelectorAll('.view-invite-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const target = this.getAttribute('data-target');
            $(target).modal('show');
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const items = Array.from(document.querySelectorAll('.workspace-item'));
    const entriesSelect = document.getElementById('entriesSelect');
    const searchInput = document.getElementById('searchInput');
    const pagination = document.getElementById('pagination');

    let currentPage = 1;
    let itemsPerPage = parseInt(entriesSelect.value);

    function filterItems() {
        const keyword = searchInput.value.toLowerCase();
        return items.filter(item =>
            item.getAttribute('data-title').includes(keyword)
        );
    }

    function render(filteredItems) {
        items.forEach(item => item.style.display = 'none');

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        filteredItems.slice(start, end).forEach(item => {
            item.style.display = '';
        });

        renderPagination(filteredItems.length);
    }

    function renderPagination(totalItems) {
        const pageCount = Math.ceil(totalItems / itemsPerPage);
        pagination.innerHTML = '';

        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.className = 'btn btn-sm mx-1 ' + (i === currentPage ? 'btn-primary' : 'btn-light');
            btn.addEventListener('click', () => {
                currentPage = i;
                render(filterItems());
            });
            pagination.appendChild(btn);
        }
    }

    entriesSelect.addEventListener('change', function () {
        itemsPerPage = parseInt(this.value);
        currentPage = 1;
        render(filterItems());
    });

    searchInput.addEventListener('input', function () {
        currentPage = 1;
        render(filterItems());
    });

    render(filterItems());
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const entriesSelect = document.getElementById('entriesSelect');

    entriesSelect.addEventListener('change', function () {
        const selected = this.value;
        const params = new URLSearchParams(window.location.search);
        params.set('per_page', selected);
        window.location.href = window.location.pathname + '?' + params.toString();
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    let debounceTimer;

    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const search = searchInput.value;
            const params = new URLSearchParams(window.location.search);
            params.set('search', search);
            params.set('page', 1); // reset ke halaman 1 saat search baru
            window.location.href = window.location.pathname + '?' + params.toString();
        }, 500); // delay 500ms setelah user berhenti ngetik
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
