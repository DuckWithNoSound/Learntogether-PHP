<?php
namespace app\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Welcome extends Controller
{
    public function index()
    {   
        $data = [];
        helper(['form']);
        echo viewLayout('welcome', $data);
    }
    
}