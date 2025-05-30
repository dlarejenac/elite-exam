<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
   public function index()
    {
        $albums = Album::with('artist')->paginate(10);
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        $artists = Artist::all();
        return view('albums.create', compact('artists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'artist_id' => 'required|exists:artists,id',
            'name' => 'required|string|max:255',
            'sales' => 'required|integer|min:0',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'cover' => 'nullable|image|max:2048', // optional album cover image max 2MB
        ]);

        $data = $request->only('artist_id', 'name', 'sales', 'year');

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('album_covers', 'public');
        }

        Album::create($data);

        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function edit(Album $album)
    {
        $artists = Artist::all();
        return view('albums.edit', compact('album', 'artists'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'artist_id' => 'required|exists:artists,id',
            'name' => 'required|string|max:255',
            'sales' => 'required|integer|min:0',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'cover' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('artist_id', 'name', 'sales', 'year');

        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($album->cover) {
                Storage::disk('public')->delete($album->cover);
            }
            $data['cover'] = $request->file('cover')->store('album_covers', 'public');
        }

        $album->update($data);

        return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
    }

    public function destroy(Album $album)
    {
        // Delete cover image if exists
        if ($album->cover) {
            Storage::disk('public')->delete($album->cover);
        }
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
    }
}
