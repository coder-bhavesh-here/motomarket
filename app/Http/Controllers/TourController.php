<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TourController extends Controller
{
    public function index(): View
    {
        return view('livewire.tours.tour-wizard', [
            'tours' => auth()->user()->tours()->get()
        ]);
    }

    function create(): View
    {
        return view('tours.create');
    }
}
