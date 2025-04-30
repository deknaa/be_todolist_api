<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Tampilkan semua task milik user yang sedang login
    public function index(Request $request)
    {
        // ambil semua task berdasarkan user yang sedang login
        $tasks = $request->user()->tasks;

        // berikan response dalam bentuk json dan kirim data
        return response()->json($tasks);
    }

    // Simpan task baru
    public function store(Request $request)
    {
        // lakukan validasi
        $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'nullable|string',
        ]);

        // simpan task yang telah di buat oleh user
        $task = $request->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // kirim response dalam bentuk json dengan mengirim message dan data task dengan http status code 201
        return response()->json([
            'message' => 'Task baru berhasil dibuat',
            'task' => $task,
        ], 201);
    }

    // Tampilkan task spefisik berdasarkan id
    public function show(Request $request, $id)
    {
        // ambil task user yang sedang login berdasarkan id
        $task = $request->user()->tasks()->findOrFail($id);

        // kirim response dalam bantuk json beserta data
        return response()->json([
            'message' => 'Berhasil mendapatkan task berdasarkan id',
            'task' => $task,
        ], 200);
    }

    // Update data task berdasarkan id
    public function update(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255|min:3',
            'description' => 'nullable|string',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Sukses melakukan update data task',
            'task' => $task,
        ], 200);
    }

    // Hapus data task milik user
    public function destroy(Request $request, $id)
    {
        $task = $request->user()->tasks()->findOrFail($id);
        $task->delete();

        return response()->json([
            'message' => 'Berhasil menghapus task',
            'task' => $task,
        ], 200);
    }
}
