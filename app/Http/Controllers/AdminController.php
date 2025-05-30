<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\Artist;
use App\Models\Album;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $admin = Admin::where('username', $credentials['username'])->first();
        
        // Success Login
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            session(['admin_id' => $admin->id]);
            return redirect()->route('admin.dashboard');
        }

        // Failed Login
        return back()->withErrors([
            'login' => 'Invalid username or password.',
        ]);
    }

    public function dashboard()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard');
    }

    // 1. Total number of albums sold per artist
    public function totalAlbumsSold()
    {
        $data = Artist::withCount('albums')
            ->get(['id', 'name'])
            ->map(function($artist) {
                return [
                    'artist' => $artist->name,
                    'total_albums' => $artist->albums_count,
                ];
            });

        return response()->json($data);
    }

    // 2. Combined album sales per artist
    public function combinedSales()
    {
        $data = Artist::with('albums')
            ->get()
            ->map(function($artist) {
                return [
                    'artist' => $artist->name,
                    'combined_sales' => $artist->albums->sum('sales'),
                ];
            });

        return response()->json($data);
    }

    // 3. Top 1 artist by combined sales
    public function topArtist()
    {
        $artist = Artist::with('albums')
            ->get()
            ->map(function($artist) {
                return [
                    'artist' => $artist->name,
                    'combined_sales' => $artist->albums->sum('sales'),
                ];
            })
            ->sortByDesc('combined_sales')
            ->first();

        return response()->json($artist);
    }

    // 4. Top 10 albums per year by sales (grouped by year)
    public function topAlbumsYear()
    {
        $albums = Album::select('year', 'name', 'sales', 'artist_id')
            ->with('artist:id,name')
            ->orderByDesc('sales')
            ->get()
            ->groupBy('year')
            ->map(function($albums, $year) {
                return [
                    'year' => $year,
                    'top_albums' => $albums->take(10)->map(function($album) {
                        return [
                            'album' => $album->name,
                            'artist' => $album->artist->name,
                            'sales' => $album->sales,
                        ];
                    }),
                ];
            });

        return response()->json($albums);
    }

    // Search albums by artist name
    public function searchAlbumsByArtist(Request $request)
    {
        $artistName = $request->query('artist');

        $albums = Album::whereHas('artist', function($query) use ($artistName) {
            $query->where('name', 'like', "%$artistName%");
        })->with('artist')->get();

        return response()->json($albums);
    }

    public function logout()
    {
        session()->forget('admin_id');
        return redirect()->route('admin.login');
    }
}
