<?php
namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['title', 'content', 'image', 'tag_id', 'user_id', 'score', 'view_number'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {

        return $data;
    }
    protected function beforeUpdate(array $data)
    {
        
        return $data;
    }
}