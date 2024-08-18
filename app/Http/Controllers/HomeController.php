<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(){
        $merchant = Merchant::with('menus')->paginate(15, ['id', 'name', 'address', 'phone', 'description', 'slug']);

        return Inertia::render('Welcome', [
            'merchants' => $merchant,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
