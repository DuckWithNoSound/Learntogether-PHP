<?php if (isset($validation['favt'])) { echo "<div class='notify-error'>".$validation['favt']."</div>";}?>

<div class="personal__body">
    <div class="container">
        <div class="personal__cover">
            <div class="personal__leftnavbar">
                <div class="personal__leftnavbar__avatar">
                    <div class="personal__avatar__border avatar_common">
                        <img src="<?php echo base_url($user_infor['avatar']) ?>" alt="">
                    </div>
                </div>
                <div class="personal__leftnavbar__userinfor">
                    <a href="">Thông tin cá nhân</a>
                </div>
                <div class="personal__leftnavbar__usershare">
                    <a href="<?php echo base_url('profile/'.$user_infor['username'].'/posts') ?>">Xem bài đăng</a>
                </div>
            </div>
            <div class="personal__content">
                <div class="personal__content__quote">
                    <div id="personal__changequote__text">
                        <label for=""><?php echo $user_infor['user_quote'];?></label>
                        <div>
                            <label for=""><i>~ <?php echo $user_infor['username'];?></i></label>
                        </div>
                    </div>
                </div>
                <div class="personal__content__userinfor">
                    <div class="personal__content__userinfor__block1">
                        <div id="personal__changeAvatar__text">
                            <div class="personal__avatar__border avatar_common">
                                <img src="<?php echo base_url($user_infor['avatar']) ?>" alt="">
                            </div>
                            <div class="userinfor__block1__content">
                                <label for=""><?php echo $user_infor['username'];?></label>
                                <label for=""><?php echo $user_infor['level_name'] ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="personal__content__userinfor__block2">
                        <div class="userinfor__block2__content">
                            <div id="personal__changeinfor__text">
                                <label for="">Họ và tên: <?php echo $user_infor['fullname']; ?></label>
                                <label for="">Email: <?php echo $user_infor['email']; ?></label>
                                <label for="">Số điện thoại: <?php echo $user_infor['phone_number']; ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="personal__content__userinfor__blocklast">
                        <div class="userinfor__blocklast__content">
                            <label for="">Tổng số bài đăng: <a class='link__profile' href="<?php echo base_url('Personal/UserPosts/'.$user_infor['user_id']) ?>"><?php echo $numberOfPosts ?></a></label>
                            <label for="">Tổng điểm: <?php echo $totalScore ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>