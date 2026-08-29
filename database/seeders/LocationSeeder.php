<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    private const CITIES = [
        'Prishtinë', 'Prizren', 'Ferizaj', 'Pejë', 'Gjakovë', 'Gjilan', 'Mitrovicë', 'Vushtrri',
        'Suharekë', 'Rahovec', 'Lipjan', 'Podujevë', 'Drenas', 'Skenderaj', 'Istog', 'Klinë',
        'Deçan', 'Malishevë', 'Kamenicë', 'Viti', 'Dragash', 'Shtërpcë', 'Novobërdë', 'Junik',
        'Mamushë', 'Hani i Elezit', 'Kaçanik', 'Shtime', 'Fushë Kosovë', 'Obiliq', 'Graçanicë',
        'Ranillug', 'Partesh', 'Kllokot', 'Zubin Potok', 'Zveçan', 'Leposaviq', 'Mitrovicë e Veriut',
    ];

    public function run(): void
    {
        foreach (self::CITIES as $city) {
            Location::updateOrCreate(['city' => $city, 'country' => 'Kosovë']);
        }
    }
}
