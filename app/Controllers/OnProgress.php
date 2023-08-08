<?php

namespace App\Controllers;

class OnProgress extends BaseController
{
    public function index()
    {
        $data['title'] = 'On Progress';
        return view('OnProgress/index_view', $data);
    }
}
