<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Board - {{ $workspace->title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

/* Dropdown Custom */
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
    background-color: #3f63f7;
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

.dropdown-menu-custom a:hover,
.dropdown-menu-custom button:hover {
    text-decoration: underline;
}

.dropdown-menu-custom.show {
    display: block;
}

/* Board Column Style */
.card-column {
    width: 100%;
    background: #fff;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 20px;
}

/* Task Box Style */
.task-box {
    background-color: #f5f5f5;
    border-radius: 8px;
    padding: 8px;
    margin-bottom: 10px;
}

.dropdown-menu-custom {
     display: none;
     position: absolute;
     top: 30px;
     right: 0;
     background-color: #4d60f0;
     border-radius: 12px;
     padding: 16px;
     z-index: 1000;
     width: 200px;
     color: white;
     box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.completed-task {
     background-color: #d4edda !important; /* hijau muda */
     opacity: 0.85;
}

.completed-task .task-text {
     text-decoration: line-through;
     color: #4b4b4b;
}


.dropdown-menu-custom h6 {
     margin-bottom: 12px;
     font-size: 16px;
     font-weight: bold;
}

.dropdown-menu-custom button {
     background: none;
     border: none;
     color: white;
     padding: 6px 0;
     width: 100%;
     text-align: left;
     font-size: 15px;
     font-family: inherit;
     cursor: pointer;
}

.dropdown-menu-custom button:hover {
     text-decoration: underline;
}

.dropdown-menu-custom.show {
     display: block;
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


/* Responsive */
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

    .card-column {
        background: #fff;
         border-radius: 12px;
         padding: 16px;
         height: auto;
         min-height: 200px;
         box-shadow: 0 4px 8px rgba(0,0,0,0.05);
         width: 100%; /* ✅ biar sesuai col-md-6 */
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

        <!-- Konten Board -->
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-white">{{ $workspace->title }}</h2>
                <button class="btn btn-pink" data-toggle="modal" data-target="#addBoardModal">Tambah Board</button>
            </div>

            <div class="d-flex justify-content-between flex-wrap">
    @foreach ($boards as $board)
        <div class="col-md-6 mb-4">
     <div class="card-column position-relative">
         <!-- Header Board + Titik Tiga -->
         <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="font-weight-bold mb-0">{{ $board->title }}</h5>
            <div class="dropdown-custom">
              <i class="fas fa-ellipsis-h text-muted" onclick="toggleDropdown(this)"></i>
              <div class="dropdown-menu-custom">
                   <h6>Board Actions</h6>
                   <button type="button" data-toggle="modal" data-target="#addBoardModal">Add board</button>
                   <form method="POST" action="{{ route('board.copy', $board->id_board) }}">
                     @csrf
                     <button type="submit">Copy board</button>
                    </form>
                   <form method="POST" action="{{ route('board.destroy', $board->id_board) }}">
                     @csrf
                     @method('DELETE')
                     <button type="submit" onclick="return confirm('Hapus board ini?')">Delete board</button>
                    </form>
                   <button type="button" data-toggle="modal" data-target="#renameBoardModal"
                     onclick="$('#renameBoardForm').attr('action', '/boards/{{ $board->id_board }}'); $('#board-title').val('{{ $board->title }}')">
                     Rename board
                    </button>
                   <button type="button">Change color</button>
              </div>
            </div>
         </div>

         <!-- Task List -->
         <div class="task-list">
     @foreach ($board->tasks as $task)
         <div class="task-box bg-light p-2 rounded mb-2 {{ $task->status_progress === 'selesai' ? 'completed-task' : '' }}">
     <div class="d-flex justify-content-between align-items-center">
         <div class="d-flex align-items-center">
            <input type="checkbox"
             class="mr-2 task-check"
             data-id="{{ $task->id_task }}"
             {{ $task->status_progress === 'selesai' ? 'checked' : '' }}>
            <span class="task-text">{{ $task->description }}</span>
         </div>
         <div>
            <i class="fas fa-pencil-alt edit-task"
             data-id="{{ $task->id_task }}"
             data-description="{{ $task->description }}"
             data-date="{{ $task->due_date }}"
             data-toggle="modal" data-target="#editTaskModal"
             style="cursor: pointer;"></i>
            <i class="fas fa-trash delete-task ml-2" data-id="{{ $task->id_task }}" style="cursor:pointer;"></i>
         </div>
     </div>
     <div class="badge badge-dark mt-2">
         Tenggat: {{ \Carbon\Carbon::parse($task->due_date)->translatedFormat('d M Y') }}
     </div>
</div>

     @endforeach
</div>


         <!-- Tombol Add Task -->
         <button class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#addTaskModal" data-board="{{ $board->id_board }}">Add +</button>
     </div>
</div>
    @endforeach

    {{-- Kolom tambah board --}}
    <div class="card-column d-flex align-items-center justify-content-center" style="cursor: pointer;" data-toggle="modal" data-target="#addBoardModal">
        <div class="text-center text-muted">
            <i class="fas fa-plus fa-2x d-block mb-2"></i>
            <span>Tambah Board</span>
        </div>
    </div>
</div>

            <nav aria-label="Page navigation">
                <div class="mt-4 d-flex justify-content-center">
                     {{ $boards->links('pagination::bootstrap-4') }}
                </div>
            </nav><br><br>
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
        });
    });
</script>

<!-- Modal Edit Task -->
<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <form method="POST" action="" id="editTaskForm">
   @csrf
   @method('PATCH')
   <div class="modal-content rounded-4" style="background-color: #ff69b4; color: white;">
    <div class="modal-header border-0">
     <h5 class="modal-title font-weight-bold" id="editTaskModalLabel">Edit Tugas</h5>
     <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
     </button>
    </div>
    <div class="modal-body">
     <div class="form-group">
      <label for="edit-description" class="font-weight-bold">Deskripsi</label>
      <textarea name="description" class="form-control rounded" id="edit-description" rows="3" required></textarea>
     </div>
     <div class="form-group">
      <label for="edit-due-date" class="font-weight-bold">Tenggat Berakhir</label>
      <input type="date" name="due_date" class="form-control rounded-pill" id="edit-due-date" required>
     </div>
    </div>
    <div class="modal-footer border-0">
     <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">Batal</button>
     <button type="submit" class="btn btn-dark rounded-pill px-4">Simpan</button>
    </div>
   </div>
  </form>
 </div>
</div>


<!-- Modal Tambah Board -->
<div class="modal fade" id="addBoardModal" tabindex="-1" role="dialog" aria-labelledby="addBoardModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ route('board.store') }}">
      @csrf
      <input type="hidden" name="id_workspace" value="{{ $workspace->id_workspace }}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBoardModalLabel">Tambah Board</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="title">Judul Board</label>
            <input type="text" class="form-control" name="title" id="title" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Rename Board -->
<div class="modal fade" id="renameBoardModal" tabindex="-1" role="dialog" aria-labelledby="renameBoardModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form method="POST" action="" id="renameBoardForm">
            @csrf
            @method('PATCH')
            <div class="modal-content rounded-4">
              <div class="modal-header">
                   <h5 class="modal-title font-weight-bold" id="renameBoardModalLabel">Rename Board</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
              </div>
              <div class="modal-body">
                   <div class="form-group">
                       <label for="board-title">Judul Board</label>
                       <input type="text" class="form-control" name="title" id="board-title" required>
                   </div>
              </div>
              <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                   <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
         </form>
     </div>
</div>


<!-- Modal Tambah Task -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form method="POST" action="{{ route('task.store') }}">
            @csrf
            <input type="hidden" name="id_board" id="task-board-id">
            <input type="hidden" name="status_progress" value="belum">
            <input type="hidden" name="color" value="ijo">
            <div class="modal-content rounded-4" style="background-color: #ff69b4; color: white;">
              <div class="modal-header border-0">
                   <h5 class="modal-title font-weight-bold" id="addTaskModalLabel">Tambah Tugas</h5>
                   <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
              </div>
              <div class="modal-body">
                   <div class="form-group">
                       <label for="description" class="font-weight-bold">Deskripsi</label>
                       <textarea name="description" class="form-control rounded" rows="3" required></textarea>
                   </div>
                   <div class="form-group">
                       <label for="due_date" class="font-weight-bold">Due to</label>
                       <input type="date" name="due_date" class="form-control rounded-pill" required>
                   </div>
              </div>
              <div class="modal-footer border-0">
                   <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-dark rounded-pill px-4">Simpan</button>
              </div>
            </div>
         </form>
     </div>
</div>

<script>
let currentBoard = null;

$('#addTaskModal').on('show.bs.modal', function (event) {
     const button = $(event.relatedTarget);
     const boardId = button.data('board');
     $('#task-board-id').val(boardId);
});
</script>


<script>
     function toggleDropdown(icon) {
         const dropdown = icon.nextElementSibling;
         document.querySelectorAll('.dropdown-menu-custom').forEach(el => {
            if (el !== dropdown) el.classList.remove('show');
         });
         dropdown.classList.toggle('show');
     }

     // Tutup jika klik di luar
     document.addEventListener('click', function(e) {
         if (!e.target.closest('.dropdown-custom')) {
            document.querySelectorAll('.dropdown-menu-custom').forEach(el => el.classList.remove('show'));
         }
     });
</script>

<script>
     function toggleDropdown(icon) {
         const dropdown = icon.nextElementSibling;
         document.querySelectorAll('.dropdown-menu-custom').forEach(el => {
            if (el !== dropdown) el.classList.remove('show');
         });
         dropdown.classList.toggle('show');
     }

     document.addEventListener('click', function (e) {
         if (!e.target.closest('.dropdown-custom')) {
            document.querySelectorAll('.dropdown-menu-custom').forEach(el => el.classList.remove('show'));
         }
     });

     // Add task to list
     $(document).on('click', '.add-task-btn', function () {
         const input = $(this).closest('.input-group').find('.new-task-input');
         const taskText = input.val().trim();
         if (taskText === '') return;

         const taskHTML = `
            <div class="task-box d-flex justify-content-between align-items-center mb-2 bg-light">
              <div class="d-flex align-items-center">
                   <input type="checkbox" class="task-check mr-2">
                   <span class="task-text">${taskText}</span>
              </div>
              <div>
                   <i class="fas fa-pencil-alt mr-2"></i>
                   <i class="fas fa-trash"></i>
              </div>
            </div>
         `;

         $(this).closest('.card-column').find('.task-list').append(taskHTML);
         input.val('');
     });

     // Checklist styling (optional)
     $(document).on('change', '.task-check', function () {
     const id = $(this).data('id');
     $.ajax({
         url: `/tasks/${id}/check`,
         method: 'PATCH',
         data: {
            _token: '{{ csrf_token() }}'
         },
         success: function () {
            // opsional: centang garis tengah
         }
     });
});

$(document).on('click', '.delete-task', function () {
     const id = $(this).data('id');
     if (confirm('Yakin ingin hapus task ini?')) {
         $.ajax({
            url: `/tasks/${id}`,
            type: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function () {
              location.reload();
            }
         });
     }
});

// Edit Task
$('.edit-task').on('click', function () {
     const id = $(this).data('id');
     $('#edit-description').val($(this).data('description'));
     $('#edit-due-date').val($(this).data('date'));
     $('#editTaskForm').attr('action', `/tasks/${id}`);
});

$(document).on('change', '.task-check', function () {
     const id = $(this).data('id');
     const checkbox = $(this);
     const box = checkbox.closest('.task-box');

     $.ajax({
         url: `/tasks/${id}/toggle`,
         method: 'POST',
         data: {
            _token: '{{ csrf_token() }}',
            _method: 'PATCH'
         },
         success: function (res) {
            if (res.status === 'selesai') {
              box.addClass('completed-task');
            } else {
              box.removeClass('completed-task');
            }
         }
     });
});




</script>

<button onclick="scrollToTop()" id="backToTop" title="Kembali ke atas"><i class="fas fa-arrow-up"></i></button>

<script>
    window.onscroll = function () {
        const btn = document.getElementById("backToTop");
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            btn.style.display = "block";
        } else {
            btn.style.display = "none";
        }
    };

    function scrollToTop() {
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    }
</script>

</body>
</html>
