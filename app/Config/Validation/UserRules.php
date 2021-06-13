<?php
namespace App\Validation;
use App\Models\UserModel;

class UserRules 
{
    public function validateUser(string $str, string $field, array $data)
    {
        $model = new UserModel();
        $user=$model->where('username', $data['username'])
                    ->first();
        if(!isset($user))
        {
            return false;
        } else
        {
            return password_verify($data['password'], $user['passwrd']);
        }
    }
}