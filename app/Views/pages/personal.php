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
                    <a href="">Thông tin cá nhân</a>
                </div>
                <div class="personal__leftnavbar__usershare">
                    <a href="<?php echo base_url('profile/posts') ?>">Quản lý bài đăng</a>
                </div>
                <div class="personal__leftnavbar__logout">
                    <a href="<?php echo base_url('logOut') ?>">Đăng xuất</a>
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
                <div class="personal__content__userinfor">
                    <div class="personal__content__userinfor__block1">
                        <div id="personal__changeAvatar__text">
                            <div class="personal__avatar__border avatar_common">
                                <img src="<?php echo base_url(session()->get('avatar')) ?>" alt="">
                            </div>
                            <div class="userinfor__block1__content">
                                <label for=""><?php echo session()->get('username');?></label>
                                <label for=""><?php echo session()->get('user_level') ?></label>
                            </div>
                        </div>
                        <form style="display: none;" action="changeAvatar" enctype="multipart/form-data" id="personal__changeAvatar__form" method="post">
                            <input type="file" name="favt" id="" class="inputFile">
                            <input type="submit" value="Xác nhận">
                        </form>
                        <label for="" id="switch1__avatar" class="change change__avatar" onclick="js_switch('personal__changeAvatar__text', 'personal__changeAvatar__form', 'switch1__avatar', 'switch2__avatar')">Thay đổi ảnh đại diện</label>
                        <label for="" id="switch2__avatar" class="change change__avatar" style="display: none;" onclick="js_switch('personal__changeAvatar__form', 'personal__changeAvatar__text', 'switch2__avatar', 'switch1__avatar')">Thôi</label>
                    </div>
                    <div class="personal__content__userinfor__block2">
                        <div class="userinfor__block2__content">
                            <div id="personal__changeinfor__text">
                                <label for="">Họ và tên: <?php echo session()->get('fullname'); ?></label>
                                <label for="">Email: <?php echo session()->get('email'); ?></label>
                                <label for="">Số điện thoại: <?php echo session()->get('phone_number'); ?></label>
                            </div>
                            <form style="display: none;" id="personal__changeinfor__form" action="changeInfor" method="post">
                                <input type="text" name="fullname" id="" placeholder="Họ và tên">
                                <input type="text" name="phone_number" id="" placeholder="Số điện thoại">
                                <input type="submit" value="Xác nhận">
                            </form>
                        </div>
                        <label for="" id="switch1__infor" class="change change__infor" onclick="js_switch('personal__changeinfor__text', 'personal__changeinfor__form', 'switch1__infor', 'switch2__infor')">Thay đổi</label>
                        <label for="" id="switch2__infor" class="change change__infor" style="display: none;" onclick="js_switch('personal__changeinfor__form', 'personal__changeinfor__text', 'switch2__infor', 'switch1__infor')">Thôi</label>
                    </div>
                    <div class="personal__content__userinfor__block3">
                        <div class="userinfor__block3__content">
                            <label for="" id="personal__changepassword__text">Mật khẩu: **********</label>
                            <form  id="personal__changepassword__form" action="changePassword" method="POST" style="display: none;">
                                <input type="password" name="password" id="" placeholder="Mật khẩu hiện tại">
                                <input type="password" name="new_password" id="" placeholder="Mật khẩu mới">
                                <input type="password" name="password_confirm" id="" placeholder="Nhập lại mật khẩu mới">
                                <input type="submit" name="change_password" id="" value="Xác nhận">
                            </form>
                        </div>
                        <label for="" id="switch1__password" class="change change__password" onclick="js_switch('personal__changepassword__text', 'personal__changepassword__form', 'switch1__password', 'switch2__password')">Thay đổi</label>
                        <label for="" id="switch2__password" class="change change__password" style="display: none;" onclick="js_switch('personal__changepassword__form', 'personal__changepassword__text', 'switch2__password', 'switch1__password')">Thôi</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>