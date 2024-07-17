<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:45',
            'description' => 'required|max:110',
            'link' => 'required|url',
            'image' => 'required|image|mimes:webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('cards', 'public');

        Card::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('superadmin.mindsync')->with('success', 'Card criado com sucesso!');
    }

    public function index()
    {
        $cards = Card::all();
        return view('Blog', compact('cards'));
    }
}
