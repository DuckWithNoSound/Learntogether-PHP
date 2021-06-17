<?php 
namespace app\Controllers;

use App\Models\FileModel;
use CodeIgniter\Controller;

class FileSharing extends Controller
{
    public function index($page = 1)
    {
        $page = (int)$page;
        $model = new FileModel;
        $allPosts = $model->getFiles($page, 'files.`file_id` DESC');
        for($index = 0; $index < count($allPosts); $index++)
        {
            $allPosts[$index]->currentVote = $model->getUserCurrentScore($allPosts[$index]->file_id, session()->get('user_id'));
            $allPosts[$index]->numberOfComments = $model->getNumberCommentsOfFile($allPosts[$index]->file_id);
        }
        $numberOfPages = $model->getNumberOfPages();
        $data['allPosts'] = $allPosts;
        $data['numberOfPages'] = $numberOfPages;
        $data['currentPage'] = $page;
        helper(['form']);
        return viewLayout('filesharing', $data);
    }
    public function new()
    {
        $data = [];
        helper(['form']);
        viewLayout('filesharing_writing', $data);
    }
    public function file($file_id)
    {
        helper(['form']);
        helper('date');
        $model = new FileModel;
        if($model->checkFileId($file_id))
        {   
            $file = $model->getFile($file_id);
            if(!$model->UpViewOnFile($file_id))
            {
                session()->setFlashData('error', 'Đã xảy ra lỗi !');
            }
            $data['file'] = $file;
            $data['currentVote'] = $model->getUserCurrentScore($file_id, session()->get('user_id'));
            $numberofComments = $model->getNumberCommentsOfFile($file_id);
            $data['numberofComments'] = $numberofComments; 
            $comments = $model->getComments($file_id);
            $data['comments'] = $comments; 
            return viewLayout('file', $data);
        } else
        {
            return $this->index();
        }
    }

    public function Search()
    {
        $data = [];
        helper(['form']);
        if($this->request->getGet('search'))
        {   
            $content = $this->request->getGet('search');
            if($content == '') return $this->index();
            $model = new FileModel();
            $allPosts = $model->searchFile($content);
            for($index = 0; $index < count($allPosts); $index++)
            {
                $allPosts[$index]->currentVote = $model->getUserCurrentScore($allPosts[$index]->post_id, session()->get('user_id'));
            }
            $data['allPosts'] = $allPosts;
            $data['searchContent'] = $content;
            return viewLayout('filesharing', $data);
        }
    }

    public function upScore($file_id)
    {
        $model = new FileModel;
        if($model->upScore($file_id, session()->get('user_id')))
        {
            return redirect()->to( base_url('Discussion/post/'.$file_id));
        } else
        {
            session()->setFlashData('fail', 'Đã xảy ra lỗi !');
        }
        $data['file'] = $model->getFile($file_id);
        helper(['form']);
        return viewLayout('file', $data);
    }
    public function downScore($file_id)
    {
        $model = new FileModel;
        if($model->downScore($file_id, session()->get('user_id')))
        {
            return redirect()->to( base_url('Discussion/post/'.$file_id));
        } else
        {
            session()->setFlashData('error', 'Đã xảy ra lỗi !');
        }
        $data['file'] = $model->getFile($file_id);
        helper(['form']);
        return viewLayout('file', $data);
    }
    public function upScoreCmt($comment_id, $file_id)
    {
        $model = new FileModel;
        if($model->upScoreCmt($comment_id))
        {
            return redirect()->to( base_url('FileSharing/file/'.$file_id));
        } else
        {
            session()->setFlashData('error', 'Đã xảy ra lỗi !');
        }
        $data['post'] = $model->getFile($file_id);
        helper(['form']);
        return viewLayout('file', $data);
    }
    public function downScoreCmt($comment_id, $file_id)
    {
        $model = new FileModel;
        if($model->downScoreCmt($comment_id))
        {
            return redirect()->to( base_url('FileSharing/file/'.$file_id));
        } else
        {
            session()->setFlashData('error', 'Đã xảy ra lỗi !');
        }
        $data['post'] = $model->getFile($file_id);
        helper(['form']);
        return viewLayout('post', $data);
    }
}