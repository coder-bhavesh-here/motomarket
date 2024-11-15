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

    public function show($tourId): View
    {
        $tour = Tour::find($tourId);
        return view('tour-detail', [
            'tour' => $tour
        ]);
    }
    public function book($tourId): View
    {
        $tour = Tour::with(['prices', 'addons'])->where('id', $tourId)->first();
        return view('book', [
            'tour' => $tour,
            'nationalities' => ['India', 'Europe', 'US  '],
            'tourDates' => $tour->prices
        ]);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            return response()->json(['success' => 'File uploaded successfully', 'file' => $fileName]);
        }
        return response()->json(['error' => 'File upload failed'], 500);
    }
}
