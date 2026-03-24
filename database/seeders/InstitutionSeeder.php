<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutions = [
            // Ukraine
            ['name' => 'International European University', 'country' => 'Ukraine'],
            ['name' => 'Donetsk National Medical University', 'country' => 'Ukraine'],
            ['name' => 'Odesa National Medical University', 'country' => 'Ukraine'],
            ['name' => 'South Ukrainian National Pedagogical University', 'country' => 'Ukraine'],
            ['name' => 'National Pirogov Memorial Medical University', 'country' => 'Ukraine'],
            ['name' => 'Bogomolets National Medical University', 'country' => 'Ukraine'],
            ['name' => 'Ternopil State Medical University', 'country' => 'Ukraine'],
            ['name' => 'Ivano Frankivsk National Medical University', 'country' => 'Ukraine'],
            ['name' => 'Danylo Halytsky Lviv National Medical University', 'country' => 'Ukraine'],
            ['name' => 'Ivano-Frankivsk National Technical University', 'country' => 'Ukraine'],
            ['name' => 'Sumy State University', 'country' => 'Ukraine'],
            ['name' => 'Petro Mohyla Black Sea National University', 'country' => 'Ukraine'],
            ['name' => 'Poltava State Medical and Dental University', 'country' => 'Ukraine'],
            
            // Poland
            ['name' => 'Nicolaus Copernicus University, Toruń', 'country' => 'Poland'],
            ['name' => 'Collegium da Vinci, Poznan', 'country' => 'Poland'],
            ['name' => 'Medical University of Silesia, Katowice', 'country' => 'Poland'],
            ['name' => 'SWPS University, Warsaw', 'country' => 'Poland'],
            
            // Latvia
            ['name' => 'Riga Stradins University', 'country' => 'Latvia'],
            ['name' => 'Turiba University, Riga', 'country' => 'Latvia'],
            ['name' => 'Transport and Telecommunication Institute, Riga', 'country' => 'Latvia'],
            ['name' => 'Liepaja University, Liepaja', 'country' => 'Latvia'],
            ['name' => 'Ekonomikas un Kultūras augstskola, Riga', 'country' => 'Latvia'],
            ['name' => 'Isma University of Applied Science, Riga', 'country' => 'Latvia'],
            
            // Uzbekistan
            ['name' => 'Tashkent Medical Academy', 'country' => 'Uzbekistan'],
            ['name' => 'Andijan State Medical Institute', 'country' => 'Uzbekistan'],
            ['name' => 'Gulistan State University', 'country' => 'Uzbekistan'],
            ['name' => 'Bukhara State Medical Institute', 'country' => 'Uzbekistan'],
            ['name' => 'Jizzakh State Pedagogical Institute', 'country' => 'Uzbekistan'],
            ['name' => 'Uzbek State University Of Physical Education', 'country' => 'Uzbekistan'],
            ['name' => 'Termez Branch of Tashkent Medical Academy', 'country' => 'Uzbekistan'],
            
            // Georgia
            ['name' => 'Alte University', 'country' => 'Georgia'],
            ['name' => 'Caucasus International University', 'country' => 'Georgia'],
            ['name' => 'East European University', 'country' => 'Georgia'],
            ['name' => 'Georgian National University SEU', 'country' => 'Georgia'],
            ['name' => 'Petre Shotadze Tbilisi Medical Academy', 'country' => 'Georgia'],
            ['name' => 'Ken Walker International University', 'country' => 'Georgia'],
        ];

        foreach ($institutions as $inst) {
            Institution::firstOrCreate(
                ['name' => $inst['name']], 
                [
                    'country' => $inst['country'],
                    'accreditation' => true,
                ]
            );
        }
    }
}
