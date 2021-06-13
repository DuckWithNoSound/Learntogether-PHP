<?php 
namespace app\Controllers;

use CodeIgniter\Controller;

class FileSharing extends Controller
{
    public function index()
    {
        $data = [];
        helper(['form']);
        viewLayout('filesharing_writing', $data);
    }
}