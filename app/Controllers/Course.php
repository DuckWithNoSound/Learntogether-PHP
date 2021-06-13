<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Course extends Controller
{
    public function index()
    {
        return viewLayout('course');
    }
}




?>