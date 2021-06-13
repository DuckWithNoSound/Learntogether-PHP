<?php
namespace App\Controllers;

use App\Models\CustomModel;
use App\Models\PostModel;
use CodeIgniter\Controller;

class Discussion extends Controller
{   
    // function for view
    public function index($page = 1)
    {   
        //echo "<script type='text/javascript'>alert('".$page."');</script>";
        $page = (int)$page;
        $model = new CustomModel;
        $allPosts = $model->getPosts($page, 'posts.`post_id` DESC');
        for($index = 0; $index < count($allPosts); $index++)
        {
            $allPosts[$index]->currentVote = $model->getUserCurrentScore($allPosts[$index]->post_id, session()->get('user_id'));
        }
        $numberOfPages = $model->getNumberOfPages();
        $data['allPosts'] = $allPosts;
        $data['numberOfPages'] = $numberOfPages;
        $data['currentPage'] = $page;
        helper(['form']);
        return viewLayout('discussion', $data);
    }
    public function filter($orderby = 'new', $page = 1)
    {
        $page = (int)$page;
        $model = new CustomModel;
        if($orderby == 'new')
        {
            $orderby = 'posts.`post_id` DESC';
        } 
        if($orderby == 'top')
        {
            $orderby = 'posts.`score` DESC, posts.`view_number` DESC';
        }
        $allPosts = $model->getPosts($page, $orderby);
        for($index = 0; $index < count($allPosts); $index++)
        {
            $allPosts[$index]->currentVote = $model->getUserCurrentScore($allPosts[$index]->post_id, session()->get('user_id'));
        }
        $data['numberOfPages'] = $model->getNumberOfPages();
        $data['allPosts'] = $allPosts;
        $data['currentPage'] = $page;
        helper(['form']);
        return viewLayout('discussion', $data);
    }
    public function NewPost()
    {
        $data = [];
        helper(['form']);
        echo viewLayout('newpost_writing', $data);
    }
    public function Post($post_id)
    {
        helper(['form']);
        helper('date');
        $model = new CustomModel();
        if($model->checkPostId($post_id))
        {   
            $post = $model->getPost($post_id);
            if(!$model->UpViewOnPost($post_id))
            {
                session()->setFlashData('error', 'Đã xảy ra lỗi !');
            }
            $data['post'] = $post;
            $data['currentVote'] = $model->getUserCurrentScore($post_id, session()->get('user_id'));
            $numberofComments = $model->getNumberCommentsOfPost($post_id);
            $data['numberofComments'] = $numberofComments; 
            $comments = $model->getComments($post_id);
            $data['comments'] = $comments; 
            return viewLayout('post', $data);
        } else
        {
            return $this->index();
        }
    }

    // function for action
    public function Posting()
    {
        $data = [];
        helper(['form']);
        if(session()->get('isLogged'))
        {
            if ($this->request->getPost('post_upload')) {
                $rules =
                [
                    'title' => 'required|min_length[14]|max_length[250]',
                    'content' => 'required|min_length[40]',
                ];
                $error_messages =
                [
                    'title' => ['required' => 'Vui lòng nhập đầy đủ nội dung !', 'min_length' => 'Vui lòng nhập tiêu đề > 14 ký tự !', 'max_length' => 'Vui lòng nhập tiêu đề < 250 ký tự !'],
                    'content' => ['required' => 'Vui lòng nhập đầy đủ nội dung !', 'min_length' => 'Vui lòng nhập nội dung > 40 ký tự !']
                ];
                if (!($this->validate($rules, $error_messages))) {
                    session()->setFlashData('error', $this->validator->getErrors());
                    session()->setFlashData('failed', 'Đăng bài thất bại !');
                } else {
                    $model = new CustomModel();
                    $title = htmlspecialchars(trim($this->request->getPost('title')));
                    $content = htmlspecialchars(trim($this->request->getPost('content')));
                    $model->NewPost($title, $content, 1, session()->get('user_id'));
                    session()->setFlashData('success_posting', 'Đăng bài thành công !');
                    return redirect()->to(base_url('Discussion'));
                }
            }
        }
        echo viewLayout('newpost_writing', $data);
    }
    public function EditPost($post_id)
    {
        $data = [];
        helper(['form']);
        $model = new CustomModel();
        if($model->checkPostId($post_id))
        {
            $post = $model->getPost($post_id);
            if(session()->get('user_id') == $post[0]->user_id)
            {
                $data['post'] = $post;
            } else
            {
                return redirect()->to('/Discussion');
            }
        }
        return viewLayout('newpost_writing', $data);
    }
    public function UpdatePost()
    {
        $data = [];
        helper(['form']);
        if(session()->get('isLogged'))
        {
            if ($this->request->getPost('post_upload')) {
                $rules =
                [
                    'title' => 'required|min_length[14]|max_length[250]',
                    'content' => 'required|min_length[40]',
                ];
                $error_messages =
                [
                    'title' => ['required' => 'Vui lòng nhập đầy đủ nội dung !', 'min_length' => 'Vui lòng nhập tiêu đề > 14 ký tự !', 'max_length' => 'Vui lòng nhập tiêu đề < 250 ký tự !'],
                    'content' => ['required' => 'Vui lòng nhập đầy đủ nội dung !', 'min_length' => 'Vui lòng nhập nội dung > 40 ký tự !']
                ];
                if (!($this->validate($rules, $error_messages))) {
                    session()->setFlashData('error', $this->validator->getErrors());
                    return $this->EditPost($this->request->getPost('post_id'));
                    //print_r($data['validation']);
                    //echo "<script type='text/javascript'>alert('da');</script>";
                } else {
                    $model = new CustomModel();
                    $title = htmlspecialchars(trim($this->request->getPost('title')));
                    $content = htmlspecialchars(trim($this->request->getPost('content')));
                    $model->UpdatePost($this->request->getPost('post_id'), $title, $content, 1);
                    session()->setFlashData('success_posting', 'Sửa bài thành công !');
                    return redirect()->to( base_url('Discussion/post/'.$this->request->getPost('post_id')));
                }
            }
            echo viewLayout('newpost_writing');
        }
    }
    public function DeletePost($post_id)
    {
        helper(['form']);
        $model = new CustomModel();
        if($model->checkPostId($post_id))
        {   
            $post = $model->getPost($post_id);
            if(session()->get('user_id') == $post[0]->user_id || session()->get('level_id') <= 3)
            {   
                $model->DeletePost($post_id);
                session()->setFlashData('success', 'Xóa bài thành công !');
                return redirect()->to('/Discussion');
            } else
            {   
                session()->setFlashData('error', 'Xóa bài thất bại !');
                return redirect()->to('/Discussion');
            }
        }
        return $this->index();
    }
    public function upScore($post_id)
    {
        $model = new CustomModel();
        if($model->upScore($post_id, session()->get('user_id')))
        {
            return redirect()->to( base_url('Discussion/post/'.$post_id));
        } else
        {
            session()->setFlashData('fail', 'Đã xảy ra lỗi !');
        }
        $data['post'] = $model->getPost($post_id);
        helper(['form']);
        return viewLayout('post', $data);
    }
    public function downScore($post_id)
    {
        $model = new CustomModel();
        if($model->downScore($post_id, session()->get('user_id')))
        {
            return redirect()->to( base_url('Discussion/post/'.$post_id));
        } else
        {
            session()->setFlashData('error', 'Đã xảy ra lỗi !');
        }
        $data['post'] = $model->getPost($post_id);
        helper(['form']);
        return viewLayout('post', $data);
    }
    public function upScoreCmt($comment_id, $post_id)
    {
        $model = new CustomModel();
        if($model->upScoreCmt($comment_id))
        {
            return redirect()->to( base_url('Discussion/post/'.$post_id));
        } else
        {
            echo "<script type='text/javascript'>alert('da');</script>";
            session()->setFlashData('error', 'Đã xảy ra lỗi !');
        }
        $data['post'] = $model->getPost($post_id);
        helper(['form']);
        return viewLayout('post', $data);
    }
    public function downScoreCmt($comment_id, $post_id)
    {
        $model = new CustomModel();
        if($model->downScoreCmt($comment_id))
        {
            return redirect()->to( base_url('Discussion/post/'.$post_id));
        } else
        {
            session()->setFlashData('error', 'Đã xảy ra lỗi !');
        }
        $data['post'] = $model->getPost($post_id);
        helper(['form']);
        return viewLayout('post', $data);
    }
    public function new_comment()
    {
        $data = [];
        helper(['form']);
        $post_id = $this->request->getPost('post_id');
        if($this->request->getPost('submitComment'))
        {
            $rules =
            [

            ];
            $error_mesages =
            [

            ];
            $model = new CustomModel();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data = [
                'cmt_content' => htmlspecialchars(trim($this->request->getPost('comment'))),
                'user_id' => session()->get('user_id'),
                'post_id' => $post_id,
                'cmt_date' => date('Y-m-d H:i:s'),
            ];
            if($model->newComment($data))
            {
                session()->setFlashData('success_comment', 'Đăng bình luận thành công !');
            }
            else 
            {
                session()->setFlashData('error', 'Đã xảy ra lỗi !');
            }
        }
        $this->Post($post_id);
    }
    public function DiscussionSearch()
    {
        $data = [];
        helper(['form']);
        if($this->request->getGet('discussionSearch'))
        {   
            $content = $this->request->getGet('discussionSearch');
            if($content == '') return $this->index();
            $model = new CustomModel();
            $allPosts = $model->searchPost($content);
            for($index = 0; $index < count($allPosts); $index++)
            {
                $allPosts[$index]->currentVote = $model->getUserCurrentScore($allPosts[$index]->post_id, session()->get('user_id'));
            }
            $data['allPosts'] = $allPosts;
            $data['searchContent'] = $content;
            return viewLayout('discussion', $data);
        }
    }
}

?>