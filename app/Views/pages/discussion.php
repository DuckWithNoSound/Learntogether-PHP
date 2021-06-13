<?php

    include 'app/Libraries/GlobalFunction.php';

    $numsPost = count($allPosts);
    if(!isset($currentPage)) $currentPage=1;
    if(!isset($numberOfPages)) $numberOfPages=1;

?>
<div class="share__body">
    <div class="container">
        <div class="share__container">
            <div class="share__first">
                <div class="share__search">
                    <form class="share__search__block" onsubmit="return validateForm()" name="discussion_search_form" action="<?php echo base_url('Discussion/DiscussionSearch') ?>" method="GET">
                        <input type="text" name="discussionSearch" value="" class="searchTerm" placeholder="Nhập nội dung tìm kiếm?">
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <?php if(!session()->get('username')): ?>
                    <div class="check__logged">
                        <a href=" <?php echo base_url('LoginPage')?>">Vui lòng đăng nhập để đăng bài thảo luận !</a>
                    </div>
                <?php else: ?>
                    <div class="share__create">
                        <a href=" <?php echo base_url('Discussion/NewPost')?>">+ Viết bài thảo luận mới</a>
                    </div>
                <?php endif ?>
            </div>

            <div class="discussion__orderby">
                <a href="<?php echo base_url('Discussion/filter/top') ?>">Nổi bật</a>
                <a href="<?php echo base_url('Discussion/filter/new') ?>">Mới nhất</a>
            </div>

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
                            <div class="discussion__block__content__fisrt">
                                <a href="<?php echo base_url('Discussion/post/'.$allPosts[$i]->post_id) ?>"><?php echo $allPosts[$i]->title ?></a>

                            </div>
                            <pre wrap="true"><?php echo trimContent($allPosts[$i]->content) ?></pre>
                        </div>
                        <div class="share__block__detail">
                            <label for="">Tác giả: <?php echo "<a href='".base_url('Personal/'.$allPosts[$i]->user_id)."'>".$allPosts[$i]->username."</a>" ?></label>
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

                <div class="discussion__pagination">
                    <a href="<?php echo base_url('Discussion/1') ?>">&#60&#60</a>
                    <a href="<?php echo base_url('Discussion/'.($currentPage > 1 ? $currentPage-1 : $currentPage = 1)) ?>">&#60</a>
                    <?php if($numberOfPages >= 5): ?>
                        <?php if($currentPage <= 3): ?>
                            <a href="<?php echo base_url('Discussion/1') ?>">1</a>
                            <a href="<?php echo base_url('Discussion/2') ?>">2</a>
                            <a href="<?php echo base_url('Discussion/3') ?>">3</a>
                            <a href="<?php echo base_url('Discussion/4') ?>">4</a>
                            <a href="<?php echo base_url('Discussion/5') ?>">5</a>
                        <?php else: ?>
                            <a href="<?php echo base_url('Discussion/'.($currentPage-2)) ?>"><?php echo ($currentPage-2) ?></a>
                            <a href="<?php echo base_url('Discussion/'.($currentPage-1)) ?>"><?php echo ($currentPage-1) ?></a>
                            <a href="<?php echo base_url('Discussion/'.($currentPage)) ?>" id="<?php echo 'pagination--activated' ?>"><?php echo ($currentPage) ?></a>
                            <?php if($currentPage+1 < $numberOfPages): ?>
                                <a href="<?php echo base_url('Discussion/'.($currentPage+1)) ?>"><?php echo ($currentPage+1) ?></a>
                            <?php endif ?>
                            <?php if($currentPage+2 < $numberOfPages): ?>
                                <a href="<?php echo base_url('Discussion/'.($currentPage+2)) ?>"><?php echo ($currentPage+2) ?></a>
                            <?php endif ?>
                        <?php endif ?>
                    <?php else: ?>
                        <?php for($i = 1; $i <= $numberOfPages; $i++): ?>
                            <a href="<?php echo base_url('Discussion/'.$i) ?>" id="<?php if($i == $currentPage) echo 'pagination--activated' ?>"><?php echo $i ?></a>
                        <?php endfor ?>
                    <?php endif ?>
                    <a href="<?php echo base_url('Discussion/'.($currentPage < $numberOfPages ? $currentPage+1 : $currentPage = $numberOfPages)) ?>">&#62</a>
                    <a href="<?php echo base_url('Discussion/'.$numberOfPages) ?>">&#62&#62</a>
                </div>
            </div>
        </div>    
    </div>
</div>