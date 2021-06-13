<?php 
    include 'app/Libraries/GlobalFunction.php';

    $numsPost = count($allPosts);
    if(!isset($currentPage)) $currentPage=1;
    if(!isset($numberOfPages)) $numberOfPages=1;
?>
<?php if (isset($validation['favt'])) { echo "<div class='notify-error'>".$validation['favt']."</div>";}?>
<div class="personal__body">
    <div class="container">
        <div class="personal__cover">
            <div class="personal__leftnavbar">
                <div class="personal__leftnavbar__avatar">
                    <div class="personal__avatar__border avatar_common">
                        <img src="<?php echo base_url(session()->get('avatar')) ?>" alt="">
                    </div>
                </div>
                <div class="personal__leftnavbar__userinfor">
                    <a href="<?php echo base_url('Personal') ?>">Thông tin cá nhân</a>
                </div>
                <div class="personal__leftnavbar__usershare">
                    <a href="<?php echo base_url('Personal/MyPosts') ?>">Quản lý bài đăng</a>
                </div>
                <div class="personal__leftnavbar__logout">
                    <a href="logOut">Đăng xuất</a>
                </div>
            </div>
            <div class="personal__content">
                <div class="personal__content__quote">
                    <div id="personal__changequote__text">
                        <label for=""><?php echo session()->get('user_quote');?></label>
                        <div>
                            <label for=""><i>~ <?php echo session()->get('username');?></i></label>
                        </div>
                    </div>
                    <form action="changeQuote" style="display: none;" method="POST" id="personal__changequote__form">
                        <input type="text" name="user_quote" id="" placeholder="Viết châm ngôn của bạn..." maxlength="140" minlength="1">
                        <input type="submit" value="Xác nhận">
                    </form>
                    <label for="" id="switch1__quote" class="change change__quote" onclick="js_switch('personal__changequote__text', 'personal__changequote__form', 'switch1__quote', 'switch2__quote')">Chỉnh sửa</label>
                    <label for="" style="display: none;" id="switch2__quote" class="change change__quote" onclick="js_switch('personal__changequote__form', 'personal__changequote__text', 'switch2__quote', 'switch1__quote')">Thôi</label>
                </div>
                <div class="personal__myposts">
                    <h4 style="<?php if($numsPost > 0) echo 'margin: 0px 0px 25px 0px;display: block;color: var(--unseclectableText);'; else echo 'display: none'; ?>">Tổng số bài đăng: <?php echo $numberOfPosts ?></h4>
                    <div class="share__content">
                        <?php for($i = 0; $i<$numsPost; $i++): ?> 
                        <div class="share__content__block">
                            <div class="share__content__one">
                                <img src="<?php echo base_url($allPosts[$i]->avatar) ?>" class="img__avatar__82" alt="">
                                <label for="" class="user_level"><?php echo $allPosts[$i]->level_name ?></label>
                                <div class="UpAndDown">
                                    <i class="fas fa-caret-up <?php if($allPosts[$i]->currentVote == 1) echo " isActive" ?>"></i>
                                    <label for=""><?php echo($allPosts[$i]->score) ?></label>
                                    <i class="fas fa-caret-down <?php if($allPosts[$i]->currentVote == -1) echo " isActive" ?>"></i>
                                </div>
                            </div>
                            <div class="share__content__two">
                                <div class="share__block__content">
                                    <a href="<?php echo base_url('Discussion/post/'.$allPosts[$i]->post_id) ?>"><?php echo $allPosts[$i]->title ?></a>
                                    <pre wrap="true"><?php echo trimContent($allPosts[$i]->content) ?></pre>
                                </div>
                                <div class="share__block__detail">
                                    <label for="">Tác giả: <?php echo $allPosts[$i]->username ?></label>
                                    <label for="">Ngày đăng: <?php echo date("d/m/Y", strtotime($allPosts[$i]->first_date)) ?></label>
                                    <label for="">
                                    <a href="<?php echo base_url('Discussion/post/'.$allPosts[$i]->post_id) ?>">
                                        <i class="far fa-comment-dots"></i>
                                        <?php echo getNumberCommentsOfPost($allPosts[$i]->post_id) ?>
                                    </a>
                                    </label>
                                    <label for="">  
                                        <i class="far fa-eye"></i> 
                                        <?php echo $allPosts[$i]->view_number ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php endfor ?>
                        <h2 style="<?php if($numsPost < 1) echo 'display: block; text-align: center; color: var(--unseclectableText)'; else echo 'display: none'; ?>" >(Hiện chưa có bài viết nào !!!)</h2>
                        <div class="discussion__pagination" style=" <?php if($numsPost < 1) echo 'display: none';?>">
                            <a href="<?php echo base_url('Personal/MyPosts/1') ?>">&#60&#60</a>
                            <a href="<?php echo base_url('Personal/MyPosts/'.($currentPage > 1 ? $currentPage-1 : $currentPage = 1)) ?>">&#60</a>
                            <?php if($numberOfPages >= 5): ?>
                                <?php if($currentPage <= 3): ?>
                                    <a href="<?php echo base_url('Personal/MyPosts/1') ?>">1</a>
                                    <a href="<?php echo base_url('Personal/MyPosts/2') ?>">2</a>
                                    <a href="<?php echo base_url('Personal/MyPosts/3') ?>">3</a>
                                    <a href="<?php echo base_url('Personal/MyPosts/4') ?>">4</a>
                                    <a href="<?php echo base_url('Personal/MyPosts/5') ?>">5</a>
                                <?php else: ?>
                                    <a href="<?php echo base_url('Personal/MyPosts/'.($currentPage-2)) ?>"><?php echo ($currentPage-2) ?></a>
                                    <a href="<?php echo base_url('Personal/MyPosts/'.($currentPage-1)) ?>"><?php echo ($currentPage-1) ?></a>
                                    <a href="<?php echo base_url('Personal/MyPosts/'.($currentPage)) ?>" id="<?php echo 'pagination--activated' ?>"><?php echo ($currentPage) ?></a>
                                    <?php if($currentPage+1 < $numberOfPages): ?>
                                        <a href="<?php echo base_url('Personal/MyPosts/'.($currentPage+1)) ?>"><?php echo ($currentPage+1) ?></a>
                                    <?php endif ?>
                                    <?php if($currentPage+2 < $numberOfPages): ?>
                                        <a href="<?php echo base_url('Personal/MyPosts/'.($currentPage+2)) ?>"><?php echo ($currentPage+2) ?></a>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php else: ?>
                                <?php for($i = 1; $i <= $numberOfPages; $i++): ?>
                                    <a href="<?php echo base_url('Personal/MyPosts/'.$i) ?>" id="<?php if($i == $currentPage) echo 'pagination--activated' ?>"><?php echo $i ?></a>
                                <?php endfor ?>
                            <?php endif ?>
                            <a href="<?php echo base_url('Personal/MyPosts/'.($currentPage < $numberOfPages ? $currentPage+1 : $currentPage = $numberOfPages)) ?>">&#62</a>
                            <a href="<?php echo base_url('Personal/MyPosts/'.$numberOfPages) ?>">&#62&#62</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>