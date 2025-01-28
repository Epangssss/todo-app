<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class AdminController extends Controller
{

    public function index()
    {
        $tasks = Task::orderBy('deadline', 'asc')->paginate(10); // Ambil data tugas dengan paginasi
        return view('admin.dashboard', compact('tasks'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        Task::create($request->all());
        return redirect()->route('admin.dashboard')->with('success', 'Tugas berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('admin.edit', compact('task'));
    }


    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);


        if ($request->has('status')) {
            $task->update(['status' => $request->input('status')]);
            return redirect()->route('admin.dashboard')->with('success', 'Status tugas berhasil diperbarui.');
        }


        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        $task->update($request->all());
        return redirect()->route('admin.dashboard')->with('success', 'Tugas berhasil diperbarui.');
    }

  
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Tugas berhasil dihapus.');
    }
}
