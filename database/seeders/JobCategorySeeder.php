<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    private const CATEGORIES = [
        'Administratë', 'Agrikulturë dhe Industri Ushqimore', 'Arkitekturë', 'Art dhe Kulturë', 'Bankat',
        'Industria Automobilistike', 'Retail dhe Distribuim', 'Ndërtimtari & Patundshmëri',
        'Mbështetje e Konsumatorëve & Call Center', 'Ekonomi, Financë, Kontabilitet',
        'Edukim, Shkencë & Hulumtim', 'Punë të Përgjithshme', 'Burime Njerëzore',
        'Teknologji e Informacionit', 'Sigurim', 'Gazetari, Shtyp & Media', 'Ligj & Legjislacion',
        'Menaxhment', 'Marketing, Reklamim & PR', 'Shëndetësi', 'Turizëm & Mikpritje',
        'Prodhim & Industri', 'Transport & Logjistikë', 'Energji', 'Telekomunikacion',
        'Organizata Joqeveritare (OJQ)', 'Farmaci', 'Ndërtim Inxhinierik', 'Modë & Tekstil',
        'Sport & Argëtim', 'Siguri & Mbrojtje', 'Konsulencë Biznesi', 'Shërbime Publike',
        'Arsim Profesional dhe Trajnime', 'Zejtari & Artizanat',
    ];

    public function run(): void
    {
        foreach (self::CATEGORIES as $name) {
            JobCategory::updateOrCreate(['name' => $name]);
        }
    }
}
