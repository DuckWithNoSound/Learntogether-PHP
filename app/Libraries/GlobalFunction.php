<?php 

$version = '1.3.5'; 

function trimContent(String $content, int $wordNumbers =  425)
{   
    // $enter = str_word_count('<br>');
    if(strlen($content) > $wordNumbers)
    {
        $content = substr_replace($content,' ...', $wordNumbers);
    }
    return $content;
}
function validateInput($data, int $mode = 0) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if($mode = 1){ $data = preg_replace('/\s+/', '', $data);  }
    return $data;
}
function getNumberCommentsOfPost(int $post_id)
{
    $db = db_connect();
    $builder = $db->query("SELECT * FROM `comments_posts` WHERE `post_id` = ".$post_id.";");
    $db->close();
    return $builder->resultID->num_rows;
}