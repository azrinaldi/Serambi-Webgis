<?php
function Auth()
{
    $UserModel = new \App\Models\UserModel();
    if(session()->get('user_id'))
    {
        $user_id = session()->get('user_id');
        $getUser = $UserModel->where('user_id',$user_id)
                                    ->first();
        if($getUser!=null)
        {
            return $getUser;
        }
        else {
            return false;
        }
    }
    return false;
}
