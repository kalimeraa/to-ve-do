<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $developers = [
            [
                'name' => 'DEV1',
                'seniority' => 1,
            ],
            [
                'name' => 'DEV2',
                'seniority' => 2,
            ],
            [
                'name' => 'DEV3',
                'seniority' => 3,
            ],
            [
                'name' => 'DEV4',
                'seniority' => 4,
            ],
            [
                'name' => 'DEV5',
                'seniority' => 5,
            ],
        ];

        foreach ($developers as $developer) {
            Developer::create($developer);
        }
    }
}
