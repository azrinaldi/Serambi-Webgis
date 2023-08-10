<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = 'Beranda';
        $BangunanModel = new \App\Models\BangunanModel();
        $data['getData'] = $BangunanModel->findAll();
        return view('Home/index_view', $data);
    }
    public function tampilkan_bangunan(){
        $data['title'] = 'Beranda';
        $BangunanModel = new \App\Models\BangunanModel();
        $data['getData'] = $BangunanModel->findAll();
        return view('Home/index_view', $data);   
    }
}
