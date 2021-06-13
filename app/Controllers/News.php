<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

class News extends Controller
{
    public function index()
    {
        return viewLayout('news');
    }
}