<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicine')->insert([
            'mid' => 'MD001',
            'name' => 'Stinopi 10 Kaplet',
            'dosage' => 'Dewasa & anak > 11 tahun : 1 kaplet Anak 6-11 tahun : 0.5-1 kaplet ; Anak 1-5 tahun : 0.25-0.5 kaplet ; Semua dosis diberikan 3 x sehari',
            'usage' => 'Pain and fever relief',
            'price' => 27500,
            'qty' => 120,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
