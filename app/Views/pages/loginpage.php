<div class="login__body">
    <div class="container">
        <div class="modal__body--login">
            <label for="">
                Đăng nhập
            </label>
            <form action="login" method="POST">
                <input type="text" placeholder="Tài khoản" name="username" maxlength="60" minlength="6">
                <?php if (isset($validation['username'])) { echo "<div class='notify-error'>".$validation['username']."</div>";}?>
                <input type="password" name="password" placeholder="Mật khẩu" maxlength="120" minlength="6">
                <?php if (isset($validation['password'])) { echo "<div class='notify-error'>".$validation['password']."</div>";}?>
                <button type="submit" name="logIn">Đăng nhập</button>
                <div class="zxz">
                    <a href="Notfound">Quên mật khẩu?</a>
                </div>
            </form>
            <?php
                if(isset($logInError))
                {   
                    echo "<div class='notify-error'>".$logInError."</div>";
                }
            ?>
            <p>Chưa có tài khoản? <a href="welcom">Đăng ký ngay</a></p>
        </div>
    </div>
</div>