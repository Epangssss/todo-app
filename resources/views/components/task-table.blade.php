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
