<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $penyakit = [
            array('kode'=>'P01','name' => 'Crypto','created_at' => $date,'updated_at' => $date),
            array('kode'=>'P02','name' => 'Prolapse','created_at' => $date,'updated_at' => $date),
            array('kode'=>'P03','name' => 'Egg binding','created_at' => $date,'updated_at' => $date),
            array('kode'=>'P04','name' => 'MBD','created_at' => $date,'updated_at' => $date),
            array('kode'=>'P05','name' => 'Tumor','created_at' => $date,'updated_at' => $date),
            array('kode'=>'P06','name' => 'Impaction','created_at' => $date,'updated_at' => $date),
            array('kode'=>'P07','name' => 'Diare','created_at' => $date,'updated_at' => $date),
            array('kode'=>'P08','name' => 'Luka Luar','created_at' => $date,'updated_at' => $date),
            array('kode'=>'P09','name' => 'Gagal Shading','created_at' => $date,'updated_at' => $date),
            ];
        Penyakit::insert($penyakit);
    }
}
