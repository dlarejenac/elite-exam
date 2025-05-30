<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
   public function index()
    {
        $artists = Artist::paginate(10);
        return view('artists.index', compact('artists'));
    }

    public function create()
    {
        return view('artists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:artists,code',
            'name' => 'required|string|max:255',
        ]);

        Artist::create($request->only('code', 'name'));

        return redirect()->route('artists.index')->with('success', 'Artist created successfully.');
    }

    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }

    public function edit(Artist $artist)
    {
        return view('artists.edit', compact('artist'));
    }

    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'code' => 'required|unique:artists,code,' . $artist->id,
            'name' => 'required|string|max:255',
        ]);

        $artist->update($request->only('code', 'name'));

        return redirect()->route('artists.index')->with('success', 'Artist updated successfully.');
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect()->route('artists.index')->with('success', 'Artist deleted successfully.');
    }
}
