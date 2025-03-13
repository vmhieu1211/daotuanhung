<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SystemSetting::create([
        	'name' => 'ToyStory',
        	'description' => 'The best store have toy ',
        	'address' => '43 Tran Duy Hung',
        	'tel' => '+84963077286',
        	'email' => 'cavaldos1211@gmail.com',
        	'slug' => 'company-info',
            'logo' => asset('frontend/img/logo.png'),
        ]);
    }
}
