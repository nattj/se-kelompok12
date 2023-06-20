<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient')->insert([
            'name' => 'jonathan',
            'nik' => '1',
            'age' => 17,
            'gender' => 'male',
            'phone' => '087782925168',
            'address' => 'jln. kemanggisan raya no 21',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('patient')->insert([
            'name' => 'jason',
            'nik' => '2',
            'age' => 17,
            'gender' => 'male',
            'phone' => '08123123412',
            'address' => 'jln. kemanggisan raya no 22',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
