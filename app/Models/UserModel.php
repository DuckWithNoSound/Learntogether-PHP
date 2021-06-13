<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'email', 'passwrd', 'user_quote', 'fullname', 'phone_number', 'avatar'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];


    protected function beforeInsert(array $data)
    {
        //$data = $this->passwordHash($data);
        return $data;
    }
    protected function beforeUpdate(array $data)
    {
        //$data = $this->passwordHash($data);
        return $data;
    }
    protected function passwordHash(array $data)
    {
        if(isset($data['data']['passwrd']))
        {
            $data['data']['passwrd'] = password_hash($data['data']['passwrd'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}



?>