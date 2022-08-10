<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $gejala = [
            array('kode'=>'G01','name' => 'berat badan kurus','created_at' => $date,'updated_at' => $date),
            array('kode'=>'G02','name' => 'nafsu makan tidak lancar','created_at' => $date,'updated_at' => $date),
            array('kode'=>'G03','name' => 'bentuk poop cair','created_at' => $date,'updated_at' => $date),
            array('kode'=>'G04','name' => 'kondisi kulit tidak normal','created_at' => $date,'updated_at' => $date),
            array('kode'=>'G05','name' => 'keaktifan pasif','created_at' => $date,'updated_at' => $date),
            array('kode'=>'G06','name' => 'kondisi fisik bengkok','created_at' => $date,'updated_at' => $date),
            array('kode'=>'G07','name' => 'kondisi poop bau','created_at' => $date,'updated_at' => $date),
            array('kode'=>'G08','name' => 'kondisi kelamin keluar','created_at' => $date,'updated_at' => $date),
            array('kode'=>'G09','name' => 'kondisi berjalan tidak normal','created_at' => $date,'updated_at' => $date),
            ];
        Gejala::insert($gejala);
    }
}
