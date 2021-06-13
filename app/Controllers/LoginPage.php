<?php 
namespace app\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class LoginPage extends Controller
{
    public function index()
    {   
        $data = [];
        helper(['form']);
        echo viewLayout('loginpage', $data);
    }
}


?>