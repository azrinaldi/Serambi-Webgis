<?php

namespace App\Controllers;

class Bangunan extends BaseController
{
    public $title = 'Bangunan';
    public $url = 'bangunan';

    public function index()
    {
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        $data['page'] = 'Data '.$this->title;
        $BangunanModel = new \App\Models\BangunanModel();
        $data['getData'] = $BangunanModel->findAll();

        return view('Bangunan/index_view', $data);
    }
    public function ubah($bangunan_id='')
    {
        $BangunanModel = new \App\Models\BangunanModel();
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        if($bangunan_id!=''){
            $getData = $BangunanModel->asArray()->find($bangunan_id);
        }else{
            $getData =  null;
        }
        $data['getData'] = $getData;
        $data['page'] = 'Ubah Data '.$this->title;
        return view('Bangunan/ubah_view', $data);
    }
    public function save()
    {
        $BangunanModel = new \App\Models\BangunanModel();
        $BangunanModel -> save($this->request->getPost());
        return redirect()->to('Bangunan');
    }
}

