<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //Menampilkan form login
    public function loginForm() {
        return view('auth.login');
    }

    //Mengvalidasi input login
    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,student',
            'name' => 'required',
            'password' => 'required',
        ]);

        $query = User::where('name', $request->name)
                    ->where('role', $request->role);

        // Mengecek role
        if ($request->role === 'student') {
            $request->validate([
                'class' => 'required'
            ]);

            $query->where('class', $request->class);
        }

        $user = $query->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Invalid login credentials']);
        }

        session(['user' => $user]);

        return redirect('/dashboard');
    }


    public function logout() {
        session()->forget('user');
        return redirect('/login');
    }

}