<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Sertakan SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script> <!-- Menambahkan Bahasa Indonesia -->


        {{-- <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- Moment.js untuk format tanggal -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script> --}}



        {{-- <!-- Kalender langsung tampil -->
                <div class="d-flex justify-content-center">
                    <div id="calendar-container"></div>
                </div>

                <!-- Modal Tambah Tugas -->
                <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTaskModalLabel">Tambah Tugas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('tasks.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="title" class="form-label">Judul Tugas</label>
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Judul Tugas" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="description" class="form-label">Deskripsi</label>
                                            <input type="text" name="description" class="form-control"
                                                placeholder="Deskripsi (Opsional)">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                                            <input type="text" id="start_date" name="start_date" class="form-control"
                                                required readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="deadline" class="form-label">Tanggal Akhir</label>
                                            <input type="text" id="deadline" name="deadline" class="form-control"
                                                required readonly>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-end">
                                        <button type="submit" class="btn btn-success">Tambah Tugas</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Inisialisasi kalender flatpickr
                    var calendar = flatpickr("#calendar-container", {
                        inline: true, // Menampilkan kalender inline
                        locale: "id", // Menggunakan bahasa Indonesia
                        dateFormat: "Y-m-d", // Format tanggal
                        mode: "range", // Pilihan mode range untuk memilih dua tanggal
                        onChange: function(selectedDates, dateStr, instance) {
                            if (selectedDates.length === 2) {
                                var startDate = selectedDates[0].toISOString().split('T')[0];
                                var deadlineDate = selectedDates[1].toISOString().split('T')[0];

                                document.getElementById('start_date').value = startDate;
                                document.getElementById('deadline').value = deadlineDate;

                                // Tampilkan modal setelah memilih tanggal
                                $('#addTaskModal').modal('show');
                            }

                            // Ambil data tugas berdasarkan tanggal yang dipilih
                            var selectedDate = selectedDates[0].toISOString().split('T')[0];
                            fetch(`/tasks/${selectedDate}`)
                                .then(response => response.json())
                                .then(tasks => {
                                    // Menandai tanggal yang memiliki tugas
                                    tasks.forEach(task => {

                                        instance.markDate(task.start_date);
                                    });
                                })
                                .catch(error => console.error('Error fetching tasks:', error));
                        }
                    });
                });
            </script>

            <style>
                #calendar-container {
                    max-width: 350px;
                    background: white;
                    border-radius: 10px;
                    padding: 10px;
                }
            </style> --}}




        <div class="container mt-4">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Tugas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label">Judul Tugas</label>
                                <input type="text" name="title" class="form-control" placeholder="Judul Tugas"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="form-label">Deskripsi</label>
                                <input type="text" name="description" class="form-control"
                                    placeholder="Deskripsi (Opsional)">
                            </div>

                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="text" id="start_date" name="start_date" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="deadline" class="form-label">Tanggal Akhir</label>
                                <input type="text" id="deadline" name="deadline" class="form-control" required>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-success">Tambah Tugas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Mendapatkan waktu saat ini di zona waktu Asia/Jakarta
                var now = new Date();
                var jakartaTime = new Date(now.toLocaleString("en-US", {
                    timeZone: "Asia/Jakarta"
                }));

                // Formatkan tanggal dan waktu saat ini untuk Flatpickr (YYYY-MM-DDTHH:MM)
                var currentDateTime = jakartaTime.toISOString().slice(0, 16); // Waktu saat ini tanpa tanggal

                // Inisialisasi Flatpickr untuk start_date (hanya menampilkan waktu saat ini)
                flatpickr("#start_date", {
                    // defaultDate: currentDateTime, // Set waktu saat ini (zona waktu Asia/Jakarta)
                    dateFormat: "Y-m-d H:i", // Format dengan waktu (datetime)
                    locale: "id", // Bahasa Indonesia
                    allowInput: true, // Memungkinkan input manual
                    enableTime: true, // Mengaktifkan pemilihan waktu
                    time_24hr: true, // Menggunakan format 24 jam
                    noCalendar: false, // Memungkinkan pemilihan tanggal
                });

                flatpickr("#deadline", {
                    dateFormat: "Y-m-d H:i", // Format dengan waktu (datetime)
                    locale: "id", // Bahasa Indonesia
                    allowInput: true, // Memungkinkan input manual
                    enableTime: true, // Mengaktifkan pemilihan waktu
                    time_24hr: true, // Menggunakan format 24 jam
                });
            });
        </script>




        @if ($errors->any())
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ $errors->first() }}', // Menampilkan pesan kesalahan pertama
                        confirmButtonText: 'Tutup',
                        locale: 'id' // Bahasa Indonesia
                    });
                });
            </script>
        @endif

        @if ($lineteks->isNotEmpty())
            <script>
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Ada tugas yang deadline-nya mendekati 1 hari!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif



        <!-- Tabel Tugas -->
        <div class="container mt-4">
            <div class="card">
                <div class="d-flex justify-content-between mb-4">
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex gap-3" id="filterForm">
                        <select name="status" class="form-select" style="width: auto;" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>Belum Selesai
                            </option>
                            <option value="completed" {{ request()->status == 'completed' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
                    </form>
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex gap-2" id="searchForm">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari tugas..."
                                value="{{ request()->search }}" oninput="this.form.submit()" aria-label="Search">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </form>

                </div>
                <div class="card-header bg-secondary text-white">Daftar Tugas</div>
                <div class="card-body">

                    <table class="table table-bordered table-striped text-center">
                        <thead class="table-white">
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Mulai</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $key => $task)
                               <td>{{ $tasks->firstItem() + $key }}</td>    
                                <td>
                                    @if (in_array($task->id, $nearDeadlineTasks))
                                        <span class="badge bg-warning">{{ $task->title }}</span>
                                    @else
                                        {{ $task->title }}
                                    @endif
                                </td>
                                <td>
                                    @if (in_array($task->id, $nearDeadlineTasks))
                                        <span class="badge bg-warning">{{ $task->description }}</span>
                                    @else
                                        {{ $task->description }}
                                    @endif
                                </td>
                                <td>
                                    @if (in_array($task->id, $nearDeadlineTasks))
                                        <span class="badge bg-warning">{{ $task->start_date }}</span>
                                    @else
                                        {{ $task->start_date }}
                                    @endif
                                </td>
                                <td>
                                    @if (in_array($task->id, $nearDeadlineTasks))
                                        <span class="badge bg-warning">{{ $task->deadline }}</span>
                                    @else
                                        {{ $task->deadline }}
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="badge {{ $task->status === 'completed' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $task->status === 'completed' ? 'Selesai' : 'Belum' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status"
                                                value="{{ $task->status === 'pending' ? 'completed' : 'pending' }}">
                                            <button type="submit" class="btn btn-sm btn-info">
                                                {{ $task->status === 'pending' ? 'Tandai Selesai' : 'Tandai Belum' }}
                                            </button>
                                        </form>

                                        <a href="#" class="btn btn-sm btn-warning edit-task-btn"
                                            data-id="{{ $task->id }}">Edit</a>

                                        <!-- CSRF Token untuk keamanan -->
                                        <meta name="csrf-token" content="{{ csrf_token() }}">

                                        <!-- Sertakan SweetAlert2 -->
                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                document.querySelectorAll(".edit-task-btn").forEach(button => {
                                                    button.addEventListener("click", function(event) {
                                                        event.preventDefault();
                                                        let taskId = this.getAttribute("data-id");
                                                        openEditModal(taskId);
                                                    });
                                                });
                                            });

                                            function openEditModal(taskId) {
                                                fetch(`/admin/tasks/${taskId}/edit`)
                                                    .then(response => response.text())
                                                    .then(html => {
                                                        Swal.fire({
                                                            title: 'Edit Tugas',
                                                            html: `<div id="editTaskContainer">${html}</div>`,
                                                            width: '90vwx',
                                                            showCancelButton: true,
                                                            cancelButtonText: 'Batal',
                                                            allowOutsideClick: false,
                                                            preConfirm: () => {
                                                                const form = document.querySelector("#editTaskContainer form");
                                                                if (!form) {
                                                                    Swal.showValidationMessage("Gagal memuat form.");
                                                                    return false;
                                                                }


                                                                let taskName = form.querySelector("input[name='task_name']").value.trim();
                                                                if (taskName === "") {
                                                                    Swal.showValidationMessage("Nama tugas tidak boleh kosong.");
                                                                    return false;
                                                                }

                                                                return fetch(`/admin/tasks/${taskId}`, {
                                                                        method: "PUT",
                                                                        body: new FormData(form),
                                                                        headers: {
                                                                            "X-CSRF-TOKEN": document.querySelector(
                                                                                "meta[name='csrf-token']").content
                                                                        }
                                                                    })
                                                                    .then(response => response.json())
                                                                    .then(data => {
                                                                        if (data.success) {
                                                                            Swal.fire("Berhasil!", "Tugas berhasil diperbarui.", "success")
                                                                                .then(() => {
                                                                                    location
                                                                                        .reload();
                                                                                });
                                                                        } else {
                                                                            Swal.showValidationMessage(data.message ||
                                                                                "Gagal memperbarui tugas.");
                                                                        }
                                                                    })
                                                                    .catch(error => {
                                                                        Swal.fire("Error", "Terjadi kesalahan saat menyimpan tugas.",
                                                                            "error");
                                                                        console.error("Error:", error);
                                                                    });
                                                            }
                                                        });
                                                    })
                                                    .catch(error => {
                                                        Swal.fire("Error", "Gagal mengambil data tugas", "error");
                                                        console.error("Error:", error);
                                                    });
                                            }
                                        </script>

                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $task->id }}">Hapus</button>
                                    </div>
                                </td>
                                </tr>
                                <!-- Modal Konfirmasi Hapus -->
                                <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus tugas "{{ $task->title }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('tasks.destroy', $task->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>



                    <!-- Paginasi -->
                    <div class="mt-3 d-flex justify-content-center">
                        {{ $tasks->appends(['status' => request()->status, 'search' => request()->search])->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
        </div>
    </x-app-layout>
</body>

</html>
