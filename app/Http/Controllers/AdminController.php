<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan seluruh aduan dengan filter
     */
    public function index(Request $request)
    {
        $query = Aspiration::with(['user', 'category']);

        // Filter berdasarkan kategori
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan tanggal
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter berdasarkan bulan
        if ($request->month) {
            $query->whereMonth('created_at', $request->month);
        }

        $aspirations = $query->latest()->get();
        $categories = Category::all();

        return view('admin.aspirations.index', compact('aspirations', 'categories'));
    }

    /**
     * Menampilkan detail aduan
     */
    public function show($id)
    {
        $aspiration = Aspiration::with(['user', 'category', 'feedback'])
            ->findOrFail($id);

        return view('admin.aspirations.show', compact('aspiration'));
    }

    /**
     * Update status aduan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed,canceled'
        ]);

        $aspiration = Aspiration::findOrFail($id);
        $aspiration->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status updated successfully');
    }

    /**
     * Menyimpan feedback untuk aduan
     */
    public function storeFeedback(Request $request, $id)
    {
        $request->validate([
            'response' => 'required'
        ]);

        Feedback::create([
            'response' => $request->response,
            'aspiration_id' => $id,
            'user_id' => data_get(session('user'), 'id') // admin
        ]);

        return back()->with('success', 'Feedback submitted successfully');
    }
}