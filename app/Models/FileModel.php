<?php 
namespace App\Models;

class FileModel
{
    protected $db;

    public function getNumberOfPages(string $user_id = null)
    {   
        $this->db = db_connect();
        $builder = $this->db->table('files');
        if($user_id != null)
        {
            $result = $builder->select('file_id')->where('user_id', $user_id)->countAllResults(true);
        } else
        {
            $result = $builder->select('file_id')->countAllResults(true);
        }
        $result = ceil($result/10);
        $this->db->close();
        return $result;
    }
    public function getFiles(int $CurrentPage = 1, String $OrderBy = 'file_id', int $numbersOfFiles = 10, string $user_id = null)
    {
        $this->db = db_connect();
        $builder = $this->db->table('files');
        if($user_id != null)
        {
            $result = $builder->select('*')
                            ->join('users', 'files.user_id=users.user_id','inner')
                            ->join('levels', 'levels.level_id=users.level_id', 'inner')
                            ->where('files.user_id', $user_id)
                            ->orderBy('files.'.$OrderBy, 'DESC')
                            ->get($numbersOfFiles, ($CurrentPage - 1)*10)
                            ->getResult();
            
        } else
        {   
            $result = $builder->select('*')
                            ->join('users', 'files.user_id=users.user_id','inner')
                            ->join('levels', 'levels.level_id=users.level_id', 'inner')
                            //->join('comments_posts', 'posts.post_id=comments_posts.post_id')
                            ->orderBy($OrderBy)
                            ->get($numbersOfFiles, ($CurrentPage - 1)*10)
                            ->getResult();
        }
        $this->db->close();
        return $result;
    }
    public function checkFileId($file_id)
    {
        $file_id = (int)$file_id;
        $this->db = db_connect();
        $builder = $this->db->table('files');
        $result = $builder->select('*')
                        ->where('file_id', $file_id)
                        ->countAllResults(true);
        $this->db->close();
        if($result>0) return true;
        else return false;
    }
    public function getFile(int $file_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('files');
        $result = $builder->select('*')
                        ->join('users', 'files.user_id=users.user_id','inner')
                        ->join('levels', 'levels.level_id=users.level_id', 'inner')
                        ->where('file_id', $file_id)
                        ->get()
                        ->getResult();
        $this->db->close();
        return $result;
    }
    public function searchFile(String $content)
    {
        $this->db = db_connect();
        $builder = $this->db->table('files');
        $result = $builder->select('*')
                        ->join('users', 'files.user_id=users.user_id','inner')
                        ->join('levels', 'levels.level_id=users.level_id', 'inner')
                        ->like('title', $content)
                        ->orLike('content', $content)
                        ->get()
                        ->getResult();
        $this->db->close();
        return $result;
    }
    // temp
    public function NewFile($file_title, $file_content, $file_source, $user_id)
    {   
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = 
        [
            'title' => $file_title,
            'content' => $file_content,
            'source' => $file_source,
            'user_id' => $user_id,
            'first_date' => date("Y/m/d H:i:s"),
            'last_date' => date("Y/m/d H:i:s"),
        ];
        $this->db = db_connect();
        $builder = $this->db->table('files');
        $query = $builder->insert($data);
        $this->db->close();
        return $query;
    }
    public function UpdatePost($post_id, $post_title, $post_content, $post_tags)
    {   
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = 
        [
            'title' => $post_title,
            'content' => $post_content,
            'tag_id' => $post_tags,
            'last_date' => date("Y/m/d H:i:s"),
        ];
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        $query = $builder->where('post_id', $post_id)->update($data);
        $this->db->close();
        return $query;
    }
    //

    public function DeleteFile($file_id)
    {   
        $this->DeleteCommentsOnFile($file_id);
        $this->db = db_connect();
        $builder = $this->db->table('files');
        $query = $builder->where('file_id', $file_id)->delete();
        $this->db->close();
        return $query;
    }
    public function DeleteCommentsOnFile($file_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('comments_files');
        $query = $builder->where('file_id', $file_id)->delete();
        $this->db->close();
        return $query;
    }
    public function UpViewOnFile($file_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('files');
        if($builder->set('view_number', 'view_number+1', false)->where('file_id', $file_id)->update()) 
        {
            $this->db->close();
            return TRUE;
        }
        else 
        {
            $this->db->close();
            return FALSE;
        }
    }

    public function getUserCurrentScore($file_id, $user_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('scores_file');
        $currentScore = $builder->select('score_type')->where("file_id='".$file_id."' AND user_id='".$user_id."'")->get()->getResult();
        $this->db->close();
        if(empty($currentScore)) 
        {
            return 0;
        } else 
        {
            return $currentScore[0]->score_type;
        }
    }
    public function upScore($file_id, $user_id)
    {   
        
        $data =
        [
            'score_type' => 1,
            'file_id' => $file_id,
            'user_id' => $user_id
        ];
        $this->db = db_connect();
        $builder = $this->db->table('files');
        $currentScoreArr = $builder->select('score_type')->where("file_id='".$file_id."' AND user_id='".$user_id."'")->get()->getResult();
        if(empty($currentScoreArr)) 
        {
            $currentScore = 'empty';
        } else 
        {
            $currentScore = $currentScoreArr[0]->score_type;
        }
    
        // xử lý dựa theo điểm hiện tại
        if($currentScore == 'empty')
        {   
            if($builder->insert($data))
            {
                $this->db->close();
                $this->UpdateScoreOnFiles($file_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
        if($currentScore == 0){
            if($builder->set('score_type', '1', false)->where("file_id='".$file_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnFiles($file_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        } 
        if($currentScore == -1){
            if($builder->set('score_type', '1', false)->where("post_id='".$file_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnFiles($file_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
        if($currentScore == 1){
            if($builder->set('score_type', '0', false)->where("post_id='".$file_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnFiles($file_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
    }
    public function downScore($file_id, $user_id)
    {
        $data =
        [
            'score_type' => -1,
            'post_id' => $file_id,
            'user_id' => $user_id
        ];
        $this->db = db_connect();
        $builder = $this->db->table('files');
        $currentScoreArr = $builder->select('score_type')->where("post_id='".$file_id."' AND user_id='".$user_id."'")->get()->getResult();
        if(empty($currentScoreArr)) 
        {
            $currentScore = 'empty';
        } else 
        {
            $currentScore = $currentScoreArr[0]->score_type;
        }

        // xử lý dựa theo điểm hiện tại
        if($currentScore == 'empty')
        {   
            if($builder->insert($data))
            {
                $this->db->close();
                $this->UpdateScoreOnFiles($file_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
        if($currentScore == 0){
            if($builder->set('score_type', '-1', false)->where("post_id='".$file_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnFiles($file_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        } 
        if($currentScore == -1){
            if($builder->set('score_type', '0', false)->where("post_id='".$file_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnFiles($file_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
        if($currentScore == 1){
            if($builder->set('score_type', '-1', false)->where("post_id='".$file_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnFiles($file_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
    }
    private function UpdateScoreOnFiles($file_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('scores_file');
        $currentScore = ($builder->select('user_id')->where("file_id = '".$file_id."' AND score_type = '1'")->countAllResults()) - ($builder->select('user_id')->where("file_id = '".$file_id."' AND score_type = '-1'")->countAllResults());
        $this->db->close();
        $this->db = db_connect();
        $builder = $this->db->table('files');
        $query = $builder->set('score', $currentScore, false)->where('file_id', $file_id)->update();
        $this->db->close();
        return true;
    }


    public function getNumberCommentsOfFile(int $file_id)
    {
        $this->db = db_connect();
        $builder = $this->db->query("SELECT `comment_id` FROM `comments_files` WHERE `file_id` = ".$file_id.";");
        $this->db->close();
        return $builder->resultID->num_rows;
    }
    public function getComments(int $file_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('comments_files');
        $result = $builder->select('*')
                        ->join('users', 'users.user_id=comments_files.user_id','inner')
                        ->join('levels', 'levels.level_id=users.level_id', 'inner')
                        ->where('file_id', $file_id)
                        ->orderBy('scores', 'DESC')
                        ->get()
                        ->getResult();
        $this->db->close();
        return $result;
    }
    public function newComment(array $data)
    {
        $this->db = db_connect();
        $builder = $this->db->table('comments_files');
        $result = $builder->insert($data);
        $this->db->close();
        return $result;
    }

    // COMMENT SCORE
    public function upScoreCmt(int $comment_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('comments_files');
        if($builder->set('cmt_score', 'cmt_score+1', false)->where('cmt_id', $comment_id)->update())  
        {
            $this->db->close();
            return TRUE;
        }
        else 
        {
            $this->db->close();
            return FALSE;
        }
    }
    public function downScoreCmt(int $comment_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('comments_files');
        if($builder->set('cmt_score', 'cmt_score-1', false)->where('cmt_id', $comment_id)->update()) 
        {
            $this->db->close();
            return TRUE;
        }
        else 
        {
            $this->db->close();
            return FALSE;
        }
    }
}