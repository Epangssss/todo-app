<form action="{{ route('tasks.store') }}" method="POST" class="mb-8">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <input
            type="text"
            name="title"
            placeholder="Judul Tugas"
            class="rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 w-full p-2"
            required
        >
        <input
            type="text"
            name="description"
            placeholder="Deskripsi (Opsional)"
            class="rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 w-full p-2"
        >
        <input
            type="date"
            name="deadline"
            class="rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 w-full p-2"
            required
        >
    </div>
    <button
        type="submit"
        class="px-6 py-2 bg-blue-600 text-black font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-lg"
    >
        Tambah Tugas
    </button>
</form>
