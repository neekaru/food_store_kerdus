<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        * Run the database seeds
        */
        $response = Http::withHeaders([
            // api key raja ongkir
            'key' => config('rajaongkir.api_key'),
        ])->get('https://api.rajaongkir.com/starter/province');

        // loop data from api
        Log::info($response);
        foreach($response['rajaongkir']['results'] as $province){
            Province::create([
                'id' => $province['province_id'],
                'name' => $province['province'],
            ]);
        }
    }
}
