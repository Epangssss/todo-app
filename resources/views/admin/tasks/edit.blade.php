<form id="editTaskForm" action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Judul Tugas</label>
        <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <input type="text" name="description" class="form-control" value="{{ $task->description }}">
    </div>
    <div class="mb-3">
        <label for="start_date" class="form-label">Tanggal Mulai</label>
        <input type="date" name="start_date" class="form-control" value="{{ $task->start_date }}" required>
    </div>
    <div class="mb-3">
        <label for="deadline" class="form-label">Tanggal Akhir</label>
        <input type="date" name="deadline" class="form-control" value="{{ $task->deadline }}" required>
    </div>

    <!-- Tambahkan tombol submit -->
    <div class="text-end">
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </div>
</form>
