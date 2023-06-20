<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctor')->insert([
            'name' => 'Jonathan',
            'nid' => 'D001',
            'age' => 35,
            'gender' => 'male',
            'phone' => '087782925168',
            'specialization' => 'Dermatologists',
            'address' => 'Jln. Hawaii Cove no 22',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('doctor')->insert([
            'name' => 'Hennry',
            'nid' => 'D002',
            'age' => 24,
            'gender' => 'male',
            'phone' => '087292838192',
            'specialization' => 'Obstetricians and Gynecologists',
            'address' => 'Jln. Kemanggisan Merdeka No. 30B',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
