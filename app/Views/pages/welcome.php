<div class="Body">
    <!-- Preload -->
    <?php 
    //echo date("d/m/Y", strtotime("2021/05/19 20:35:12")); 
    ?>
    <!-- end preload -->
    <div class="Body__one">
    <img src="public/Images/background_body_one.png" alt="">
        <div class="Body__one-a container">
            <div class="Body__one--content">
                <h1>Việc tự học không còn là <span>cực hình</span></h1>
                <p>Mọi thứ dễ dàng hơn với LearnTogether!</p>
            </div>
            <div class="Body__one--register">
                <label for="">
                    Đăng ký mới
                </label>
                <form action="register" method="POST">
                    <input type="text" name="username" placeholder="Tên đăng nhập" maxlength="60" minlength="6" value="<?php echo set_value('username') ?>">
                    <?php if (isset($validation['username'])) { echo "<div class='notify-error'>".$validation['username']."</div>";}?>
                    <input type="email" name="email" placeholder="Email" maxlength="120" minlength="5" value="<?php echo set_value('email') ?>">
                    <?php if (isset($validation['email'])) { echo "<div class='notify-error'>".$validation['email']."</div>";}?>
                    <input type="password" name="password" maxlength="120" minlength="6" placeholder="Mật khẩu">
                    <?php if (isset($validation['password'])) { echo "<div class='notify-error'>".$validation['password']."</div>";}?>
                    <p>Bấm vào <b>Đăng Ký</b> là bạn đã đồng ý với <a href="Notfound">Điều khoản</a> của LearnTogether</p>
                    <button type="submit" name="register">Đăng ký</button>    
                </form>
                <hr>
                <p>Đã có tài khoản? <a id="logIn_btn" style="cursor: pointer;">Đăng nhập</a></p>
            </div>
        </div>
    </div>
    <div class="Bride__one">
        <ul class="Bussiness__logo container">
            <li>
                <img src="public/Images/Logo_saitama.png" alt="">
            </li>
            <li>
                <img src="public/Images/Logo_Hubt.png" alt="">
            </li>
            <li>
                <img src="public/Images/Logo_Panik.png" alt="">
            </li>
            <li>
                <img src="public/Images/Logo_WOF.png" alt="">
            </li>
            <li>
                <img src="public/Images/Logo_softdreams.png" alt="">
            </li>
        </ul>
    </div>
    <div class="Body__two ">

    </div>
    <div class="Bride__two ">
        <img src="public/Images/tech-wallpaper-4k-for-mobile.png" alt="" class="Bride__two-background">
        <div class="Bride__two-container container">
            <div class="Bride__two-content">
                <div class="Bride__two-content-one">
                    <h2>xxxx +</h2>
                    <h3>Bài học</h3>
                </div>
                <div class="Bride__two-content-two">
                    <h2>xxxxxx +</h2>
                    <h3>Thảo luận</h3>
                </div>
                <div class="Bride__two-content-three">
                    <h2>xxxxx +</h2>
                    <h3>Thành viên</h3>
                </div>
            </div>
            <div class="Bride_two-btn">
                <a href="">Tham gia ngay !</a>
        </div>
        </div>
    </div>
    <div class="Body__three ">

    </div>
    <div class="Body__four ">

    </div>
    <div class="Bride__last ">
        <img src="public/Images/banner-last.png" alt="">
        <div class="Bride_last-content container">
            <h2>Không gì là không thể !</h2>
            <h3>Đăng ký tài khoản và tham gia ngay hôm nay !</h3>
            <a href="">Bắt đầu ngay !</a>
        </div>
    </div>
</div>