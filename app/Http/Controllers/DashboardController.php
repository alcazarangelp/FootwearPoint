<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->role) {
            return redirect()->route('login');
        }

        $role = $user->role->name;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'distribuidora':
                return redirect()->route('distribuidora.dashboard');
            case 'mayorista':
                return redirect()->route('mayorista.dashboard');
            case 'minorista':
                return redirect()->route('minorista.dashboard');
            case 'empleado':
                return redirect()->route('empleado.dashboard');
            default:
                return redirect()->route('minorista.dashboard');
        }
    }
}