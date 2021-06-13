<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use app\Models\PostModel;

class PostFuntion extends Controller
{
    public function NewPost()
    {
        $data = [];
        helper(['form']);
        echo 'da';
        if($this->request->getPost('post_upload'))
        {
            $rules = 
            [
                'title' => 'required|min_length[14]|max_length[250]',
                'content' => 'required|min_length[140]',
                
            ];
            $error_messages =
            [

            ];
            if(!$this->validate($rules, $error_messages))
            {

            } else 
            {
                $model = new PostModel();
                $newData = 
                [
                    'title' => $this->request->getPost('title'),
                    'content'=> $this->request->getPost('content'),
                    'image' => 'none',
                    'date' => date('d-m').'20'.date('y'),
                    'tag_id' => '1', 
                    'user_id' => session()->get('user_id'),
                ];
                $model->save($newData);
                session()->setFlashData('success_posting', 'Đăng bài thành công !');
                return redirect()->to('share');
            }
        }
        echo viewLayout('Share');
    }
    public function abc()
    {
        echo 'ok';
    }
}