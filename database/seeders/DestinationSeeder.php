<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studyDestinations = [
            ['name' => 'China', 'emoji' => '🇨🇳'],
            ['name' => 'India', 'emoji' => '🇮🇳'],
            ['name' => 'Thailand', 'emoji' => '🇹🇭'],
            ['name' => 'Malaysia', 'emoji' => '🇲🇾'],
            ['name' => 'Uzbekistan', 'emoji' => '🇺🇿'],
            ['name' => 'Poland', 'emoji' => '🇵🇱'],
            ['name' => 'Germany', 'emoji' => '🇩🇪'],
            ['name' => 'Georgia', 'emoji' => '🇬🇪'],
            ['name' => 'Russia', 'emoji' => '🇷🇺'],
            ['name' => 'Ukraine', 'emoji' => '🇺🇦'],
            ['name' => 'Lithuania', 'emoji' => '🇱🇹'],
            ['name' => 'Bosnia & Herzegovina', 'emoji' => '🇧🇦'],
            ['name' => 'Spain', 'emoji' => '🇪🇸'],
            ['name' => 'Hungary', 'emoji' => '🇭🇺'],
            ['name' => 'Latvia', 'emoji' => '🇱🇻'],
            ['name' => 'Romania', 'emoji' => '🇷🇴'],
            ['name' => 'Turkey', 'emoji' => '🇹🇷'],
            ['name' => 'North Cyprus', 'emoji' => '🇹🇷'],
            ['name' => 'South Cyprus', 'emoji' => '🇨🇾'],
            ['name' => 'Malta', 'emoji' => '🇲🇹'],
            ['name' => 'United Kingdom', 'emoji' => '🇬🇧'],
            ['name' => 'Ireland', 'emoji' => '🇮🇪'],
            ['name' => 'Australia', 'emoji' => '🇦🇺'],
            ['name' => 'Canada', 'emoji' => '🇨🇦'],
            ['name' => 'United States', 'emoji' => '🇺🇸'],
            ['name' => 'Mauritius', 'emoji' => '🇲🇺'],
        ];

        $workDestinations = [
            ['name' => 'Poland', 'emoji' => '🇵🇱'],
            ['name' => 'Croatia', 'emoji' => '🇭🇷'],
            ['name' => 'Slovakia', 'emoji' => '🇸🇰'],
            ['name' => 'Serbia', 'emoji' => '🇷🇸'],
            ['name' => 'Albania', 'emoji' => '🇦🇱'],
            ['name' => 'Latvia', 'emoji' => '🇱🇻'],
            ['name' => 'Belarus', 'emoji' => '🇧🇾'],
            ['name' => 'Germany', 'emoji' => '🇩🇪'],
            ['name' => 'Portugal', 'emoji' => '🇵🇹'],
            ['name' => 'Russia', 'emoji' => '🇷🇺'],
            ['name' => 'Romania', 'emoji' => '🇷🇴'],
            ['name' => 'Bulgaria', 'emoji' => '🇧🇬'],
            ['name' => 'Ukraine', 'emoji' => '🇺🇦'],
            ['name' => 'Qatar', 'emoji' => '🇶🇦'],
        ];

        foreach ($studyDestinations as $dest) {
            Destination::firstOrCreate(
                ['name' => $dest['name'], 'category' => 'study'],
                ['flag_emoji' => $dest['emoji'], 'description' => 'Explore fully funded and self-funded study programs in ' . $dest['name'] . '.']
            );
        }

        foreach ($workDestinations as $dest) {
            Destination::firstOrCreate(
                ['name' => $dest['name'], 'category' => 'work'],
                ['flag_emoji' => $dest['emoji'], 'description' => 'Discover incredible work abroad opportunities in ' . $dest['name'] . '.']
            );
        }
    }
}
