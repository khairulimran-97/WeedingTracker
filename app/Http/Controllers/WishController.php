<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;

class WishController extends Controller
{
    public function index()
    {
        $wishes = Wish::where('is_approved', true)
            ->latest()
            ->get();

        return response()->json($wishes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:500',
        ]);

        $wish = Wish::create([
            'name' => $request->name,
            'message' => $request->message,
            'is_approved' => true, // Auto approve
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your wishes!',
            'wish' => $wish
        ]);
    }
}
