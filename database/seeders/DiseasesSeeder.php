<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiseasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diseases = [
            'ကင်ဆာရောဂါများ',
            'အရေပြားရောဂါများ',
            'ဆီးချိုရောဂါများ',
            'သွေးတိုးရောဂါများ',
            'အသက်ရှုလမ်းကြောင်းဆိုင်ရာ ရောဂါများ',
            'ကူးစက်ရောဂါများ',
            'စိတ်ပိုင်းဆိုင်ရာ လက္ခဏာများ',
        ];

        foreach ($diseases as $key => $disease) {
            Disease::create([
                'name'=>$disease
            ]);
        }

    }
}
