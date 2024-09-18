<?php

namespace App\Controllers;

use App\Models\CobaModel;

class Coba extends BaseController
{   
    protected $cobaModel;
    public function __construct()
    {
        $this->cobaModel = new CobaModel;
    }

    public function index($nama = "", $umur = 0)
    {
        echo "Nama Saya $nama , umur saya $umur tahun" ;
    }

    public function coba()
    {
        return view('welcome_message');
    }

    public function cobaview()
    {   
        $coba = $this->cobaModel->FindAll();
        $data = [
            'title' => "Mahasiswa",
            'mahasiswa' => $coba
        ];
        return view('cobaview',$data);
    }

}
