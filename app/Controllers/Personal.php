<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomModel;

class Personal extends Controller
{
    public function index($userid=null)
    {
        $data = [];
        helper(['form']);
        if($userid != null)
        {   
            $model = new CustomModel;
            $user_infor = $model->getUserInfor($userid);
            if($user_infor != false)
            {
                $data['user_infor'] = $user_infor;
                echo viewLayout('userpage', $data);
            } else
            {   
                return redirect()->route('/');
            } 
        } else
        {
            echo viewLayout('personal', $data);
        }
    }
    public function MyPosts($page = 1)
    {
        $page = (int)$page;
        $model = new CustomModel;
        $user_id = session()->get('user_id');
        $allPosts = $model->getPosts($page, 'post_id', 10, $user_id);
        for($index = 0; $index < count($allPosts); $index++)
        {
            $allPosts[$index]->currentVote = $model->getUserCurrentScore($allPosts[$index]->post_id, session()->get('user_id'));
        }
        $numberOfPages = $model->getNumberOfPages($user_id);
        $numberOfPosts = $model->getNumberOfPosts($user_id);
        $data['allPosts'] = $allPosts;
        $data['numberOfPages'] = $numberOfPages;
        $data['numberOfPosts'] = $numberOfPosts;
        $data['currentPage'] = $page;
        helper(['form']);
        echo viewLayout('myposts', $data);
    }
    public function UserPosts($user_id = null, $page = 1)
    {
        $page = (int)$page;
        $model = new CustomModel;
        if(!$model->checkValidUserId($user_id) || $user_id == null)
        {   
            return redirect()->to('/Notfound');
        }
        $user_infor = $model->getUserInfor($user_id);
        $data['user_infor'] = $user_infor;
        $allPosts = $model->getPosts($page, 'post_id', 10, $user_id);
        for($index = 0; $index < count($allPosts); $index++)
        {
            $allPosts[$index]->currentVote = $model->getUserCurrentScore($allPosts[$index]->post_id, session()->get('user_id'));
        }
        $numberOfPages = $model->getNumberOfPages($user_id);
        $numberOfPosts = $model->getNumberOfPosts($user_id);
        $data['numberOfPosts'] = $numberOfPosts;
        $data['allPosts'] = $allPosts;
        $data['numberOfPages'] = $numberOfPages;
        $data['currentPage'] = $page;
        $data['user_id'] = $user_id;
        helper(['form']);
        echo viewLayout('userposts', $data);
    }
}