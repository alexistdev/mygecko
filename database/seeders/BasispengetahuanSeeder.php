<?php

namespace Database\Seeders;

use App\Models\Basispengetahuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BasispengetahuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $basis = [
            array('kode'=>'R01','penyakit_id' => '1','gejala_id' => '1','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R01','penyakit_id' => '1','gejala_id' => '2','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R01','penyakit_id' => '1','gejala_id' => '3','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R01','penyakit_id' => '1','gejala_id' => '5','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R01','penyakit_id' => '1','gejala_id' => '7','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R01','penyakit_id' => '1','gejala_id' => '9','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R02','penyakit_id' => '2','gejala_id' => '8','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R02','penyakit_id' => '2','gejala_id' => '9','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R03','penyakit_id' => '3','gejala_id' => '5','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R04','penyakit_id' => '4','gejala_id' => '5','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R04','penyakit_id' => '4','gejala_id' => '6','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R04','penyakit_id' => '4','gejala_id' => '9','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R05','penyakit_id' => '5','gejala_id' => '4','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R05','penyakit_id' => '5','gejala_id' => '9','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R06','penyakit_id' => '6','gejala_id' => '2','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R06','penyakit_id' => '6','gejala_id' => '3','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R06','penyakit_id' => '6','gejala_id' => '5','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R06','penyakit_id' => '6','gejala_id' => '9','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R07','penyakit_id' => '7','gejala_id' => '2','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R07','penyakit_id' => '7','gejala_id' => '3','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R07','penyakit_id' => '7','gejala_id' => '5','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R07','penyakit_id' => '7','gejala_id' => '7','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R07','penyakit_id' => '7','gejala_id' => '9','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R08','penyakit_id' => '8','gejala_id' => '4','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R08','penyakit_id' => '8','gejala_id' => '5','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R08','penyakit_id' => '8','gejala_id' => '9','created_at' => $date,'updated_at' => $date),
            array('kode'=>'R09','penyakit_id' => '9','gejala_id' => '4','created_at' => $date,'updated_at' => $date),
            ];
        Basispengetahuan::insert($basis);
    }
}
