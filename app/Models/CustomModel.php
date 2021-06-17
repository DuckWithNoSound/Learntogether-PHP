<?php
namespace App\Models;

use function PHPUnit\Framework\isEmpty;

class CustomModel
{
    protected $db;
    // POST
    public function getNumberOfPages(string $user_id = null)
    {   
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        if($user_id != null)
        {
            $result = $builder->select('*')->where('user_id', $user_id)->countAllResults(true);
        } else
        {
            $result = $builder->select('*')->countAllResults(true);
        }
        $result = ceil($result/10);
        $this->db->close();
        return $result;
    }
    /***
     * Get number of user's post
     */
    public function getNumberOfPosts($user_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        $result = $builder->select('*')->where('user_id', $user_id)->countAllResults(true);
        $this->db->close();
        return $result;
    }
    /***
     * Get posts to show...
     */
    public function getPosts(int $CurrentPage = 1, String $OrderBy = 'post_id', int $numbersOfPosts = 10, string $user_id = null)
    {
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        if($user_id != null)
        {
            $result = $builder->select('*')
                            ->join('users', 'posts.user_id=users.user_id','inner')
                            ->join('levels', 'levels.level_id=users.level_id', 'inner')
                            ->where('posts.user_id', $user_id)
                            ->orderBy('posts.'.$OrderBy, 'DESC')
                            ->get($numbersOfPosts, ($CurrentPage - 1)*10)
                            ->getResult();
            
        } else
        {   
            $result = $builder->select('*')
                            ->join('users', 'posts.user_id=users.user_id','inner')
                            ->join('levels', 'levels.level_id=users.level_id', 'inner')
                            //->join('comments_posts', 'posts.post_id=comments_posts.post_id')
                            ->orderBy($OrderBy)
                            ->get($numbersOfPosts, ($CurrentPage - 1)*10)
                            ->getResult();
        }
        $this->db->close();
        return $result;
    }
    /***
     * Check post exist. Return: true if post exist, false if post non exist
     */
    public function checkPostId($post_id)
    {
        $post_id = (int)$post_id;
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        $result = $builder->select('post_id')
                        ->where('post_id', $post_id)
                        ->countAllResults(true);
        $this->db->close();
        if($result>0) return true;
        else return false;
    }
    /***
     * Get post's data
     */
    public function getPost(int $post_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        $result = $builder->select('*')
                        ->join('users', 'posts.user_id=users.user_id','inner')
                        ->join('levels', 'levels.level_id=users.level_id', 'inner')
                        ->where('post_id', $post_id)
                        ->get()
                        ->getResult();
        $this->db->close();
        return $result;
    }
    public function searchPost(String $content)
    {
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        $result = $builder->select('*')
                        ->join('users', 'posts.user_id=users.user_id','inner')
                        ->join('levels', 'levels.level_id=users.level_id', 'inner')
                        ->like('title', $content)
                        ->orLike('content', $content)
                        ->get()
                        ->getResult();
        $this->db->close();
        return $result;
    }
    /***
     * Save new post to database
     * 
     */
    public function NewPost($post_title, $post_content, $post_tags, $user_id)
    {   
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = 
        [
            'title' => $post_title,
            'content' => $post_content,
            'tag_id' => $post_tags,
            'user_id' => $user_id,
            'first_date' => date("Y/m/d H:i:s"),
            'last_date' => date("Y/m/d H:i:s"),
        ];
        $this->db = db_connect();
        $builder = $this->db->table('posts');
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
    
    public function DeletePost($post_id)
    {   
        $this->DeleteCommentsOnPost($post_id);
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        $query = $builder->where('post_id', $post_id)->delete();
        $this->db->close();
        return $query;
    }
    public function UpViewOnPost($post_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        if($builder->set('view_number', 'view_number+1', false)->where('post_id', $post_id)->update()) 
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


    // POST SCORE
    /***
     * Get number of score by User ID
     */
    public function getAllScore($user_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        $query = $builder->select('score')->where('user_id', $user_id)->get()->getResult();
        $sum = 0;
        for($i = 0; $i < count($query); $i++)
        {
            $sum += $query[$i]->score;
        }
        $this->db->close();
        return $sum;
    }
    /***
     * Get current user vote
     */
    public function getUserCurrentScore($post_id, $user_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('scores');
        $currentScore = $builder->select('score_type')->where("post_id='".$post_id."' AND user_id='".$user_id."'")->get()->getResult();
        $this->db->close();
        if(empty($currentScore)) 
        {
            return 0;
        } else 
        {
            return $currentScore[0]->score_type;
        }
    }
    public function upScore($post_id, $user_id)
    {   
        
        $data =
        [
            'score_type' => 1,
            'post_id' => $post_id,
            'user_id' => $user_id
        ];
        $this->db = db_connect();
        $builder = $this->db->table('scores');
        $currentScoreArr = $builder->select('score_type')->where("post_id='".$post_id."' AND user_id='".$user_id."'")->get()->getResult();
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
                $this->UpdateScoreOnPosts($post_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
        if($currentScore == 0){
            if($builder->set('score_type', '1', false)->where("post_id='".$post_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnPosts($post_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        } 
        if($currentScore == -1){
            if($builder->set('score_type', '1', false)->where("post_id='".$post_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnPosts($post_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
        if($currentScore == 1){
            if($builder->set('score_type', '0', false)->where("post_id='".$post_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnPosts($post_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
    }
    public function downScore($post_id, $user_id)
    {
        $data =
        [
            'score_type' => -1,
            'post_id' => $post_id,
            'user_id' => $user_id
        ];
        $this->db = db_connect();
        $builder = $this->db->table('scores');
        $currentScoreArr = $builder->select('score_type')->where("post_id='".$post_id."' AND user_id='".$user_id."'")->get()->getResult();
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
                $this->UpdateScoreOnPosts($post_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
        if($currentScore == 0){
            if($builder->set('score_type', '-1', false)->where("post_id='".$post_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnPosts($post_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        } 
        if($currentScore == -1){
            if($builder->set('score_type', '0', false)->where("post_id='".$post_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnPosts($post_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
        if($currentScore == 1){
            if($builder->set('score_type', '-1', false)->where("post_id='".$post_id."' AND user_id='".$user_id."'")->update())
            {
                $this->db->close();
                $this->UpdateScoreOnPosts($post_id);
                return true;
            } else
            {
                $this->db->close();
                return false;
            }
        }
    }
    private function UpdateScoreOnPosts($post_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('scores');
        $currentScore = ($builder->select('user_id')->where("post_id = '".$post_id."' AND score_type = '1'")->countAllResults()) - ($builder->select('user_id')->where("post_id = '".$post_id."' AND score_type = '-1'")->countAllResults());
        $this->db->close();
        $this->db = db_connect();
        $builder = $this->db->table('posts');
        $query = $builder->set('score', $currentScore, false)->where('post_id', $post_id)->update();
        $this->db->close();
        return true;
    }


    // COMMENT
    public function getNumberCommentsOfPost(int $post_id)
    {
        $this->db = db_connect();
        $builder = $this->db->query("SELECT * FROM `comments_posts` WHERE `post_id` = ".$post_id.";");
        $this->db->close();
        return $builder->resultID->num_rows;
    }
    public function getComments(int $post_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('comments_posts');
        $result = $builder->select('*')
                        ->join('users', 'users.user_id=comments_posts.user_id','inner')
                        ->join('levels', 'levels.level_id=users.level_id', 'inner')
                        ->where('post_id', $post_id)
                        ->orderBy('cmt_score', 'DESC')
                        ->get()
                        ->getResult();
        $this->db->close();
        return $result;
    }
    public function newComment(array $data)
    {
        $this->db = db_connect();
        $builder = $this->db->table('comments_posts');
        $result = $builder->insert($data);
        $this->db->close();
        return $result;
    }



    // COMMENT SCORE
    public function upScoreCmt(int $comment_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('comments_posts');
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
        $builder = $this->db->table('comments_posts');
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



    //  USER
    public function checkValidUserId($user_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('users');
        $query = $builder->select('user_id')->where('user_id', $user_id)->countAllResults();
        $this->db->close();
        if($query > 0) return true;
        else return false;
    }
    public function getUserInfor($user)
    {
        $this->db = db_connect();
        $builder = $this->db->table('users');
        $query = $builder->select('*')
                            ->join('levels', 'levels.level_id=users.level_id', 'inner')
                            ->where("user_id='".$user."' OR username='".$user."'")
                            ->get()
                            ->getResult();
        $this->db->close();
        if(isset($query[0]))
        {
            $result['username'] = $query[0]->username; 
            $result['fullname'] = $query[0]->fullname;
            $result['level_name'] = $query[0]->level_name; 
            $result['email'] = $query[0]->email;
            $result['phone_number'] = $query[0]->phone_number; 
            $result['user_quote'] = $query[0]->user_quote;
            $result['avatar'] = $query[0]->avatar;
            $result['user_id'] = $query[0]->user_id;
            return $result;
        } else
        {
            return false;
        }
    } 
    public function DeleteCommentsOnPost($post_id)
    {
        $this->db = db_connect();
        $builder = $this->db->table('comments_posts');
        $query = $builder->where('post_id', $post_id)->delete();
        $this->db->close();
        return $query;
    }
    

   
}

?>