<?php 
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $updateTime = (strtotime(date('Y-m-d H:i:s'))-strtotime($file[0]->last_date))/3600;
    if($updateTime < 1) $updateTime = round($updateTime*60) == 0 ? ' vừa xong' : round($updateTime*60) . ' phút trước';
    else if($updateTime > 24 && $updateTime < 720) $updateTime = round($updateTime/24) . ' ngày trước';
    else if($updateTime > 720) $updateTime = round($updateTime/720) . ' tháng trước';
    else $updateTime = round($updateTime) . ' giờ trước';
?>
<div class="post__body">
    <div class="container">
        <div class="post__cover">
            <div class="post__container">
                <div class="post__main">
                    <div class="post__content__one">
                        <img src="<?php echo base_url($file[0]->avatar) ?>" class="img__avatar__82" alt="">
                        <label for="" class="user_level"><?php echo $file[0]->level_name ?></label>
                        <div class="UpAndDown">
                            <?php if($currentVote == 0): ?>
                                <a href="<?php if(session()->get('isLogged')) echo base_url('FileSharing/upScore/'.$file[0]->file_id) ?>">
                                    <i class="fas fa-caret-up" id="button__score"></i>
                                </a>
                                <label for=""><?php echo $file[0]->score ?></label>
                                <a href="<?php if(session()->get('isLogged')) echo base_url('FileSharing/downScore/'.$file[0]->file_id) ?>">
                                    <i class="fas fa-caret-down" id="button__score"></i>
                                </a>
                            <?php endif ?>
                            <?php if($currentVote == 1): ?>
                                <a href="<?php if(session()->get('isLogged')) echo base_url('FileSharing/upScore/'.$file[0]->file_id) ?>">
                                    <i class="fas fa-caret-up isActive" id="button__score"></i>
                                </a>
                                <label for=""><?php echo $file[0]->score ?></label>
                                <a href="<?php if(session()->get('isLogged')) echo base_url('FileSharing/downScore/'.$file[0]->file_id) ?>">
                                    <i class="fas fa-caret-down" id="button__score"></i>
                                </a>
                            <?php endif ?>
                            <?php if($currentVote == -1): ?>
                                <a href="<?php if(session()->get('isLogged')) echo base_url('FileSharing/upScore/'.$file[0]->file_id) ?>">
                                    <i class="fas fa-caret-up" id="button__score"></i>
                                </a>
                                <label for=""><?php echo $file[0]->score ?></label>
                                <a href="<?php if(session()->get('isLogged')) echo base_url('FileSharing/downScore/'.$file[0]->file_id) ?>">
                                    <i class="fas fa-caret-down isActive" id="button__score"></i>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="post__content__two">
                        <div class="post__block__content">
                            <div class="post__block__content__first">
                                <label><?php echo $file[0]->title ?></label>

                                <?php if((session()->get('isLogged')) != null): ?>
                                    <div class="dropdown__postblock">
                                        <button class="dropdownBtn__postblock" onclick="dropdownFunction()">
                                            <i class="fas fa-ellipsis-h post__block__content__more"></i>
                                        </button>
                                        <?php if(session()->get('user_id') == $file[0]->user_id): ?>
                                            <div class="arrow-up" id="Arrow-up"></div>
                                            <div class="dropdown-content__postblock" id="Dropdown-content__postblock">
                                                <a href="<?php echo base_url('Discussion/EditPost/'.$file[0]->file_id) ?>">Sửa</a>
                                                <a href="<?php echo base_url('Discussion/DeletePost/'.$file[0]->file_id) ?>">Xóa</a>
                                                <a href="#">Tắt thông báo</a>
                                            </div>
                                        <?php else: ?>
                                            <div class="arrow-up" id="Arrow-up"></div>
                                            <div class="dropdown-content__postblock" id="Dropdown-content__postblock">
                                                <?php if(session()->get('level_id') <= 3): ?>
                                                    <a href="<?php echo base_url('Discussion/DeletePost/'.$file[0]->file_id) ?>">Xóa</a>
                                                <?php endif ?>
                                                <a href="#">Báo cáo</a>
                                                <a href="#">Bật thông báo</a>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="file_show_file">
                                <div>
                                    <i class="far fa-file-<?php echo $file[0]->icon ?>"></i>
                                    <label for=""><?php echo $file[0]->file_name ?></label>
                                </div>
                                <a href="">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                            <pre wrap="true"><?php echo trim($file[0]->content);?></pre>
                        </div>
                        <div class="post__block__detail">
                            <label for="">Tác giả: <?php echo "<a href='".base_url('profile/'.$file[0]->user_id)."'>".$file[0]->username."</a>" ?></label>
                            <label for="">Ngày đăng: <?php echo date("d/m/Y", strtotime($file[0]->first_date)) ?></label>
                            <?php if(strcmp($file[0]->first_date, $file[0]->last_date) != 0 && strcmp($file[0]->last_date, "0000-00-00 00:00:00") != 0): ?>
                                <?php if($updateTime) ?>
                                <label>Cập nhật lần cuối: <?php echo $updateTime; ?></label>
                            <?php endif ?>
                            <label for="">  
                                Lượt xem: <?php echo $file[0]->view_number ?>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="post__comment">
                    <div class="post__bridge">
                        <div id="post__bridge__text">
                            <label for=""><?php echo $numberofComments ?> Bình luận</label>
                            <?php if(session()->get('isLogged')): ?>
                                <label for="" id="switch1__comment" class="change new__comment" onclick="js_switch('post__bridge__text', 'post__bridge__form', 'switch1__comment', 'switch2__comment')">+ Viết Bình luận</label>
                            <?php else: ?>
                                <div class="check__logged">
                                    <a href=" <?php echo base_url('LoginPage')?>">Vui lòng đăng nhập bình luận !</a>
                                </div>
                            <?php endif ?>
                        </div>
                        <form action="<?php echo base_url('Discussion/new_comment') ?>" method="post" id="post__bridge__form" style="display: none;">
                            <label for="">Bình luận</label>
                            <textarea form="post__bridge__form" name="comment" id="" cols="30" rows="7" placeholder="Nội dung (nên dùng chức năng trên thanh chức năng-bên trên hoặc thẻ HTML để định dạng văn bản)."></textarea>
                            <input type="submit" name="submitComment" value="Đăng">
                            <label for="" id="switch2__comment" class="change" style="display: none;" onclick="js_switch('post__bridge__form', 'post__bridge__text', 'switch2__comment', 'switch1__comment')">Hủy bỏ</label>
                            <input type="hidden" name="file_id" value="<?php echo $file[0]->file_id ?>">
                        </form>
                    </div>

                    <?php for($i = 0; $i < $numberofComments; $i++): ?>
                        <div class="post__comment__block">
                            <div class="post__comment__block__first">
                                <div class="UpAndDown">
                                    <a href="<?php if(session()->get('isLogged')) echo base_url('FileSharing/upScoreCmt/'.$comments[$i]->comment_id.'/'.$file[0]->file_id) ?>">
                                        <i class="fas fa-caret-up" id="button__score"></i>
                                    </a>
                                    <label for=""><?php echo $comments[$i]->scores ?></label>
                                    <a href="<?php if(session()->get('isLogged')) echo base_url('FileSharing/downScoreCmt/'.$comments[$i]->comment_id.'/'.$file[0]->file_id) ?>">
                                        <i class="fas fa-caret-down" id="button__score"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="post__comment__block__second">
                                <div class="comment__block__second__one">
                                    <img src="<?php echo base_url($comments[$i]->avatar)?>" class="img__avatar__52" alt="">
                                    <div>
                                        <label for=""><?php echo "<a href='".base_url('profile/'.$comments[$i]->user_id)."'>".$comments[$i]->username."</a>" ?></label>
                                        <label for="" class="user_level"><?php echo $comments[$i]->level_name ?></label>
                                    </div>
                                    <label for="">Ngày đăng: <?php echo date( "d/m/Y H:i",strtotime($comments[$i]->date)) ?></label>
                                </div>
                                <div class="comment__block__second__two">
                                    <p>
                                        <?php echo $comments[$i]->content ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endfor ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    if(session()->get('error'))
    {   
        echo "<script type='text/javascript'>alert('".session()->get('error')."');</script>";
    }
    if(session()->get('success_comment'))
    {   
        echo "<script type='text/javascript'>alert('".session()->get('success_comment')."');</script>";
    }
?>