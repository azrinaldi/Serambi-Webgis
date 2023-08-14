<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        if (Auth() != false) {
            return redirect()->to('Home');
        }
        $data['title'] = 'Dashboard';
        return view('Auth/index_view', $data);
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth');
    }

    public function login()
    {
        $UserModel = new \App\Models\UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $getuser = $UserModel->where('username', $username)->first();
        if ($getuser != null) {
            if ($password == $getuser->password) {
                session()->set('user_id', $getuser->user_id);
                return redirect()->to('home');
            } else {
                session()->setFlashData(['info' => 'error', 'message' => 'Username atau password salah']);
            }
        } else {
            session()->setFlashData(['info' => 'error', 'message' => 'Username atau password salah']);
        }
        return redirect()->to('auth');
    }
}
