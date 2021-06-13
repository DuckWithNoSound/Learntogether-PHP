<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class NewTopic extends Controller
{
    public function index()
    {
        $data = [];
        helper(['form']);
        echo viewLayout('share_writing', $data);
    }
}