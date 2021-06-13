<?php

namespace App\Controllers;

use App\Models\CustomModel;

class Home extends BaseController
{
	public function index(int $page = 1)
    {   
        $model = new CustomModel;
        $topPosts = $model->getPosts($page, 'score', 3);
        for($index = 0; $index < count($topPosts); $index++)
        {
            $topPosts[$index]->currentVote = $model->getUserCurrentScore($topPosts[$index]->post_id, session()->get('user_id'));
        }
        $data['topPosts'] = $topPosts;
        helper(['form']);
        return viewLayout('home', $data);
    }
}
