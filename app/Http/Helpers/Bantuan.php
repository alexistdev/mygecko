<?php

namespace App\Http\Helpers;

use App\Models\Basispengetahuan;
use App\Models\Gejala;
use App\Models\Penyakit;

class Bantuan
{
    public $tipe;

    public function __construct($tipe)
    {
        $this->tipe = $tipe;
    }

    public function generateKode()
    {
        if($this->tipe == 1){
            $str = $this->getKodePenyakit();
        } else if($this->tipe == 2){
            $str = $this->getKodeGejala();
        } else {
            $str = $this->getKodeRule();
        }
        return $str;
    }

    /** kode Penyakit , tipe = 1*/
    private function getKodePenyakit()
    {
        $penyakit = Penyakit::latest('id')->first();


        if($penyakit !== null){
            $kode = $penyakit->kode;
            $kodeAngka = (int) filter_var($kode, FILTER_SANITIZE_NUMBER_INT);
            $kodeAngka += 1;
            if(strlen($kodeAngka) == 1){
                $angka = "P0";
            } else {
                $angka = "P";
            }
            return $angka.$kodeAngka;
        } else {
            return "P01";
        }
    }

    /** kode Gejala , tipe = 2 */
    private function getKodeGejala()
    {
        $gejala = Gejala::latest('id')->first();


        if($gejala !== null){
            $kode = $gejala->kode;
            $kodeAngka = (int) filter_var($kode, FILTER_SANITIZE_NUMBER_INT);
            $kodeAngka += 1;
            if(strlen($kodeAngka) == 1){
                $angka = "G0";
            } else {
                $angka = "G";
            }
            return $angka.$kodeAngka;
        } else {
            return "G01";
        }
    }

    /** kode Rule , tipe = 3 */
    private function getKodeRule()
    {
        $basis = Basispengetahuan::latest('id')->first();


        if($basis !== null){
            $kode = $basis->kode;
            $kodeAngka = (int) filter_var($kode, FILTER_SANITIZE_NUMBER_INT);
            $kodeAngka += 1;
            if(strlen($kodeAngka) == 1){
                $angka = "R0";
            } else {
                $angka = "R";
            }
            return $angka.$kodeAngka;
        } else {
            return "R01";
        }
    }
}
