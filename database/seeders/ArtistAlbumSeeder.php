<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Artist;
use App\Models\Album;
use Illuminate\Support\Str;

class ArtistAlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
    $file = fopen(database_path('seeders/artists_albums.csv'), 'r');
    fgetcsv($file);

    while (($data = fgetcsv($file)) !== false) {
        [$artistName, $albumName, $sales, $dateReleased, $lastUpdate] = $data;

        $artist = Artist::firstOrCreate(
            ['name' => $artistName],
            ['code' => strtoupper(Str::random(5))]
        );

        $artist->albums()->create([
            'name' => $albumName,
            'sales' => (int) $sales,
            'year' => date('Y', strtotime($dateReleased)),
            'cover' => null,
            'created_at' => $lastUpdate,
            'updated_at' => $lastUpdate
        ]);
    }

    fclose($file);
    }
}
