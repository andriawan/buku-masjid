<?php

namespace Database\Seeders;

use App\Models\LecturingSchedule;
use Illuminate\Database\Seeder;

class LecturingScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        factory(LecturingSchedule::class)->create();
    }
}
