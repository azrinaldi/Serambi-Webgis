<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        if (Auth() != false) {
            return redirect()->to('Home');
        }
        $data['title'] = 'Beranda';
        return view('Auth/index_view', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('Auth');
    }

    public function login()
    {
        $userModel = new \App\Models\UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $getUser = $UserModel->where('username',$username)->first();
        if($getUser!=null)
        {
            if(password_verify($password, $getUser->password))
            {
                if($getUser->level_id=='1')
                {
                    session()->set('user_id', $getUser->user_id);
                    return redirect()->to('home');
                }
            }
            else {
                session()->setFlashData(['info' => 'error', 'message' => 'Username atau password salah']);
            }

        }
        else {
            session()->setFlashData(['info' => 'error', 'message' => 'Username atau password salah']);
        }
        return redirect()->to('auth');
    }
}
