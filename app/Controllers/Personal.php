<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomModel;

class Personal extends Controller
{
    public function index($user=null)
    {
        $data = [];
        helper(['form']);
        $model = new CustomModel;
        if($user != null)
        {   
            if(strcmp($user, session()->get('username')) == 0)
            {
                return redirect()->to(base_url('profile'));
            }
            $user_infor = $model->getUserInfor($user);
            $data['numberOfPosts'] = $model->getNumberOfPosts($user_infor['user_id']);
            $data['totalScore'] = $model->getAllScore($user_infor['user_id']);
            if($user_infor != false)
            {
                $data['user_infor'] = $user_infor;
                echo viewLayout('userpage', $data);
            } else
            {   
                return redirect()->route('profile');
            } 
        } else
        {
            $data['numberOfPosts'] = $model->getNumberOfPosts(session()->get('user_id'));
            $data['totalScore'] = $model->getAllScore(session()->get('user_id'));
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
    public function UserPosts($user = null, $page = 1)
    {
        $page = (int)$page;
        $model = new CustomModel;
        if(!$model->checkValidUser($user) || $user == null)
        {   
            return redirect()->to(base_url('/Notfound'));
        }
        $user_infor = $model->getUserInfor($user);
        $data['user_infor'] = $user_infor;
        $allPosts = $model->getPosts($page, 'post_id', 10, $user_infor['user_id']);
        for($index = 0; $index < count($allPosts); $index++)
        {
            $allPosts[$index]->currentVote = $model->getUserCurrentScore($allPosts[$index]->post_id, session()->get('user_id'));
        }
        $numberOfPages = $model->getNumberOfPages($user_infor['user_id']);
        $numberOfPosts = $model->getNumberOfPosts($user_infor['user_id']);
        $data['numberOfPosts'] = $numberOfPosts;
        $data['allPosts'] = $allPosts;
        $data['numberOfPages'] = $numberOfPages;
        $data['currentPage'] = $page;
        helper(['form']);
        echo viewLayout('userposts', $data);
    }
}