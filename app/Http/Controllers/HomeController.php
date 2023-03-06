<?php

namespace App\Http\Controllers;

use App\Models\Serial;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $context = [];
        $context['users'] = User::all()->count();
        $context['serials'] = Serial::all()->count();
        $context['avg_rates'] = Serial::query()->avg('rate');
        $context['reviews'] = Serial::query()->with('reviews')->get()->map(function ($serial) {
            return $serial->reviews->count();
        })->sum();

        return view('home', $context);
    }
}
