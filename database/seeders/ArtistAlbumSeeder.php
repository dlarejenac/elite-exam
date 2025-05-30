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
        fgetcsv($file); // Skip header

        while (($data = fgetcsv($file)) !== false) {
            [$artistName, $albumName, $sales, $dateReleased, $lastUpdate] = $data;

            $artist = Artist::firstOrCreate(
                ['name' => $artistName],
                ['code' => strtoupper(Str::random(5))]
            );

            $year = 2022 ?: date('Y', strtotime($dateReleased));

            $createdAt = \DateTime::createFromFormat('ymd', $dateReleased)?->format('Y-m-d') ?? now();
            $updatedAt = \DateTime::createFromFormat('ymd', $lastUpdate)?->format('Y-m-d') ?? now();
            
            $artist->albums()->create([
                'name' => $albumName,
                'sales' => (int) $sales,
                'year' => $year,
                'cover' => null,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt
            ]);
        }

        fclose($file);
    }
}
