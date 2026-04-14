<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = data_get(session('user'), 'role');

        if ($role === 'admin') {
            return redirect()->route('admin.aspirations.index');
        }

        return redirect()->route('aspirations.index');
    }
}