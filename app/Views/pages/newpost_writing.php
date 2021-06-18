<?php 
    if(session()->get('error'))
    {
        $error = session()->get('error');
    }
    $post_title = $post_tag = $post_content = '';
    $post_action_title = 'Đăng bài';
    $post_action = 'Posting';
    $post_id = '';
    if(isset($post[0]))
    {
        $post_title = $post[0]->title;
        $post_content = $post[0]->content;
        $post_id = $post[0]->post_id;
        $post_tag = 'Hỏi đáp/chia sẻ';
        $post_action_title = 'Cập nhật';
        $post_action = 'UpdatePost';
    }
?>
<div class="question__body">
    <div class="container">
        <div class="question__cover">
            <div class="question__content">
                <h1>Viết bài</h1>
                <form action="<?php echo base_url('Discussion/'.$post_action) ?>" id="question_form" method="POST">
                    <label for="">Tiêu đề<i class="fas fa-asterisk asterisk--rule"></i></label>
                    <input type="text" name="title" placeholder="Tiêu đề bài viết... " value="<?php echo $post_title ?>">
                    <?php if (isset($error['title'])) { echo "<div class='notify-error'>".$error['title']."</div>";}?>
                    <label for="">Tags<i class="fas fa-asterisk asterisk--rule"></i></label>
                    <?php if (isset($error['tags'])) { echo "<div class='notify-error'>".$error['tags']."</div>";}?>
                    <input type="text" name="tags" placeholder="Hỏi đáp, chia sẻ, ..." value="<?php echo $post_tag ?>">
                    <label for="">Nội dung<i class="fas fa-asterisk asterisk--rule"></i></label>
                    <div class="textarea">
                        <div class="textarea__buttons">
                            <button title="Strong text" onclick="notAvaibleFunction()"><i class="fas fa-bold"></i></button>
                            <button title="Italic text" onclick="notAvaibleFunction()"><i class="fas fa-italic"></i></button>
                            <button title="Hyper link" onclick="notAvaibleFunction()"><i class="fas fa-link"></i></button>
                            <button title="High light text" onclick="notAvaibleFunction()"><i class="fas fa-code"></i></button>
                            <button title="Quote" onclick="notAvaibleFunction()"><i class="fas fa-quote-right"></i></button>
                            <button title="Image" onclick="notAvaibleFunction()"><i class="far fa-image"></i></button>
                            <div></div>
                        </div>
                        <textarea form="question_form" name="content" id="question_textaria" placeholder="Nội dung (nên dùng chức năng trên thanh chức năng (phía trên) để định dạng văn bản)."><?php echo $post_content ?></textarea>
                    </div>
                    <?php if (isset($error['content'])) { echo "<div class='notify-error'>".$error['content']."</div>";}?>
                    <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                    <div>
                        <input type="submit" name="post_upload" value="<?php echo $post_action_title ?>" id="question_submit">
                        <a href=" <?php echo base_url('Discussion') ?>"><button type="button" id="question_cancel">Hủy bỏ</button></a>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>