<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            ['Sunday','တနင်္ဂနွေနေ့'],
            ['Monday','တနင်္လာနေ့'],
            ['Tuesday','အင်္ဂါနေ့'],
            ['Wednesday','ဗုဒ္ဓဟူးနေ့'],
            ['Thursday','ကြာသပတေးနေ့'],
            ['Friday','သောကြာနေ့'],
            ['Saturday','စနေနေ့']
        ];
        foreach ($days as $day) {
            Day::create([
                'name'=>$day[0],
                'name_mm'=>$day[1]
            ]);
        }
    }
}
