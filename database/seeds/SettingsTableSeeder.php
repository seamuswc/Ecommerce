<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'key' => 'basic_info',
            'value' => json_encode([
                'email' => 'service@email.com',
                'currency' => 'USD'

            ]),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
