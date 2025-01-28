<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-6">Daftar Tugas</h3>

                    <!-- Tambah Tugas -->
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

                    <!-- Tabel Tugas -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-300 mx-auto">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                    <th class="px-6 py-3 text-left font-medium">Judul</th>
                                    <th class="px-6 py-3 text-left font-medium">Deskripsi</th>
                                    <th class="px-6 py-3 text-left font-medium">Deadline</th>
                                    <th class="px-6 py-3 text-left font-medium">Status</th>
                                    <th class="px-6 py-3 text-left font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="px-6 py-4 text-center">{{ $task->title }}</td>
                                        <td class="px-6 py-4 text-center">{{ $task->description }}</td>
                                        <td class="px-6 py-4 text-center">{{ $task->deadline }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="px-2 py-1 rounded-full text-sm font-medium {{ $task->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                {{ $task->status === 'completed' ? 'Selesai' : 'Belum' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <form
                                                    action="{{ route('tasks.update', $task->id) }}"
                                                    method="POST"
                                                    class="inline"
                                                >
                                                    @csrf
                                                    @method('PUT')
                                                    <input
                                                        type="hidden"
                                                        name="status"
                                                        value="{{ $task->status === 'pending' ? 'completed' : 'pending' }}"
                                                    >
                                                    <button
                                                        type="submit"
                                                        class="text-blue-500 hover:underline"
                                                    >
                                                        {{ $task->status === 'pending' ? 'Tandai Selesai' : 'Tandai Belum' }}
                                                    </button>
                                                </form>
                                                <a
                                                    href="{{ route('tasks.edit', $task->id) }}"
                                                    class="text-green-500 hover:underline"
                                                >
                                                    Edit
                                                </a>
                                                <form
                                                    action="{{ route('tasks.destroy', $task->id) }}"
                                                    method="POST"
                                                    class="inline"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="text-red-500 hover:underline"
                                                    >
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Navigasi Paginasi -->
                    <div class="mt-6">
                        {{ $tasks->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
