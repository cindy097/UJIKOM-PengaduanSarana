<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Category;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    /**
     * Menampilkan seluruh aduan siswa
     */
    public function index()
    {
        $user = session('user');

        $aspirations = Aspiration::with(['category', 'feedback'])
            ->where('user_id', data_get($user, 'id'))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.aspirations.index', compact('aspirations'));
    }

    /**
     * Menampilkan form input aduan
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('student.aspirations.create', compact('categories'));
    }

    /**
     * Menyimpan aduan yang baru dibuat
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'supporting_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $photoPath = null;

        if ($request->hasFile('supporting_photo')) {
            $photoPath = $request->file('supporting_photo')
                ->store('aspirations', 'public');
        }

        Aspiration::create([
            'title'            => $request->title,
            'description'      => $request->description,
            'category_id'      => $request->category_id,
            'supporting_photo' => $photoPath,
            'user_id'          => data_get(session('user'), 'id'),
            'status'           => 'pending'
        ]);

        return redirect()
            ->route('aspirations.index')
            ->with('success', 'Your aspiration has been submitted successfully.');
    }

    /**
     * Menampilkan detail aduan
     */
    public function show($id)
    {
        $user = session('user');

        $aspiration = Aspiration::with(['category', 'feedback'])
            ->where('id', $id)
            ->where('user_id', data_get($user, 'id'))
            ->firstOrFail();

        return view('student.aspirations.show', compact('aspiration'));
    }
}