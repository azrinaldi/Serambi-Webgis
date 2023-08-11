<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = 'Beranda';
        $BangunanModel = new \App\Models\BangunanModel();
        $data['getDataBangunan'] = $BangunanModel->findAll();
        $KecamatanModel = new \App\Models\KecamatanModel();
        $data['getDataKecamatan'] = $KecamatanModel->findAll();
        return view('Home/index_view', $data);
    }
}
