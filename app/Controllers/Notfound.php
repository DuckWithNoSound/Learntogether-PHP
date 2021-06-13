<?php namespace app\Controllers;

use CodeIgniter\Controller;

class Notfound extends Controller
{
    public function index() 
    { 
        return viewLayout('404-not-found');
    } 
}

?>