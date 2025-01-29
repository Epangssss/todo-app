<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::orderBy('deadline', 'asc');

        if ($request->has('status') && in_array($request->status, ['pending', 'completed'])) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $nearDeadlineTasks = Task::whereRaw('DATEDIFF(deadline, CURDATE()) <= 1')
            ->where('status', '!=', 'completed') // Pastikan status bukan 'completed'
            ->pluck('id')->toArray();

        $lineteks = Task::whereRaw('DATEDIFF(deadline, CURDATE()) <= 1')
            ->where('status', '!=', 'completed') // Pastikan status bukan 'completed'
            ->get();

        $tasks = $query->paginate(5);

        return view('admin.dashboard', compact('tasks', 'nearDeadlineTasks', 'lineteks'));
    }





    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
        ], [
            'deadline.after_or_equal' => 'Tanggal akhir tidak boleh lebih awal dari tanggal mulai.',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'deadline' => $request->deadline,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Tugas berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('admin.tasks.edit', compact('task')); // Pastikan path ini sesuai
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // Jika hanya status yang ingin diperbarui
        if ($request->has('status')) {
            // Validasi status
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:pending,completed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Memperbarui status saja
            $task->status = $request->status;
            $task->save();

            // Redirect setelah status diperbarui
            return redirect()->route('admin.dashboard')->with('success', 'Status tugas berhasil diperbarui');
        }

        // Jika tidak ada status, perbarui data lainnya
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
        ], [
            'deadline.after_or_equal' => 'Tanggal akhir tidak boleh lebih awal dari tanggal mulai.',
        ]);

        // Memperbarui data lainnya
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Tugas berhasil diperbarui');
    }



    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Tugas berhasil dihapus.');
    }
}
