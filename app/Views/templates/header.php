<?php 
    
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="alternate" hreflang="vi" href="https://learntogether.ihostfull.com/">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('public/CSS/resetCSS.css') ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('public/ASSET/fontawesome-5.15.2/css/all.min.css')?>">
    <!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">
	<!-- Custom stlylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('public/CSS/stylesheet.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/CSS/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/CSS/personal.css') ?>">
    <!--[if lte IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
    <title>Learn together | Khó đâu - Hỏi đấy - Cùng giải quyết vấn đề.</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('public/Images/square-logo.png')?>">
</head>
<body>
    <!-- Preload -->
    <?php 
    if(session()->get('log')) echo session()->get('log');
    //echo current_url();
    ?>
    <div class="app">
        <div class="page_overlay"></div>
        <div class="modal">         
            <div class="modal__body--login">
                <label for="">
                    Đăng nhập
                </label>
                <form action="login" method="POST">
                    <input type="text" placeholder="Tài khoản" name="username">
                    <input type="password" name="password" placeholder="Mật khẩu">
                    <input type="hidden" name="anchor" value="<?php echo current_url();?>">
                    <button type="submit" name="logIn">Đăng nhập</button>
                    <div class="zxz">
                        <a href="#">Quên mật khẩu?</a>
                    </div>
                </form>
                <p>Chưa có tài khoản? <a href="<?php echo base_url('Welcome')?>">Đăng ký ngay</a></p>
            </div>
        </div>
        <header>
            <div class="Space_for_navbar"></div>
            <nav class="Nav_bar"> 
                <div class="Nav_Logo"> 
                    <a id="Logo" href="<?php if(session()->get('username')){ echo base_url('Home');} else {echo base_url('Welcome');} ?>">
                        <img src="<?php echo base_url('public/Images/main_logo.png')?>" alt="Logo">
                    </a>
                </div>
                <div class="Nav__items">
                    <div class="Nav__items-a">
                        <div class="hide-on-res hide-on-res-62em" id="Nav_Home">
                            <a href=" <?php echo base_url('Course')?>">Bài học</a> 
                        </div>
                        <div class="hide-on-res" id="Nav_Subject">
                            <a href=" <?php echo base_url('News')?>">Tin tức</a>
                        </div>
                        <div class="hide-on-res" id="Nav_Teacher">
                            <a href=" <?php echo base_url('Discussion')?>">Thảo luận</a>
                        </div>
                    </div>
                    <div class="Nav_Sign">
                        <?php if(session()->get('isLogged')): ?>
                        <div class="Signed">
                        <div class="Personal">
                            <a id="userInfor">
                                <img src="<?= base_url(session()->get('avatar')); ?>" class="small-avatar"> <label><?= session()->get('username') ?></label>
                            </a>
                            <div class="Personal-hover">
                                <div class="arrow"></div>
                                <a href=" <?php echo base_url('Personal')?>">Trang cá nhân</a>
                                <?php if(session()->get('level_id')<4): ?>
                                    <a href="http://localhost/admin_learntogether">Trang quản trị</a>
                                <?php endif ?>
                                <a href=" <?php echo base_url('logOut')?>">Đăng xuất</a>
                            </div>
                        </div>
                        |
                        <a href="" id="logOut">
                            <label><i class="fas fa-bell"></i></label>
                        </a>
                        </div>
                        <?php else: ?>
                        <a id="Sign_Login">
                            <label> Đăng nhập </label>
                        </a>
                        <a href=" <?php echo base_url('welcome')?>" id="Sign_Signup">
                            <label> Đăng ký </label>
                        </a>
                        <?php endif ?>
                    </div>
                    <div class="Nav_Search">
                        <form method="GET" action="#" onsubmit="return errorForm()">
                            <input type="text" placeholder="Bạn muốn tìm kiếm gì ?" id="Text">
                            <a href="" id="Button"><i class="fas fa-search"></i></a>
                        </form>
                    </div>
                </div>
                <div class="space_for_btn"></div>
            </nav>
            <div class="Nav__mobile-btn">
                <i id="btn-x" class="fas fa-times"></i>
                <i id="btn-bars" class="fas fa-bars"></i>
            </div>
            <nav class="Nav__mobile">
                <div class="Mobile__sign">
                    <a class="Login__mobile">Đăng nhập</a>
                    <a href="" class="Register__mobile">Đăng ký</a>
                </div>
                <a href=" <?php echo base_url('Course" class="Home__mobile')?>">Bài học</a>
                <a href=" <?php echo base_url('News" class="Course__mobile')?>">Tin tức</a>
                <a href=" <?php echo base_url('Discussion" class="Teacher__mobile')?>">Thảo luận</a>
                <div class="Language__mobile">
                    <a href="" class="Language__en">
                        <img src="<?php echo base_url('public/Images/icon-en.png')?>" alt="">
                        English
                    </a>
                    <a href="" class="Language__Vi">
                        <img src="<?php echo base_url('public/Images/icon_vn.png')?>" alt="">    
                        Tiếng Việt
                    </a>
                </div>
            </nav>
        </header>
        <!-- Aftload -->
        <?php  
            if(session()->get('success_register'))
            {   
                echo "<script type='text/javascript'>alert('".session()->get('success_register')."');</script>";
            }
            if(session()->get('success_login'))
            {   
                echo "<script type='text/javascript'>alert('".session()->get('success_login')."');</script>";
            }
            if(session()->get('success_changequote'))
            {   
                echo "<script type='text/javascript'>alert('".session()->get('success_changequote')."');</script>";
            }
            if(session()->get('success_posting'))
            {   
                echo "<script type='text/javascript'>alert('".session()->get('success_posting')."');</script>";
            }
            if(session()->get('fail_password'))
            {   
                echo "<script type='text/javascript'>alert('".session()->get('fail_password')."');</script>";
            }
            if(session()->get('fail_avatarImg'))
            {   
                echo "<script type='text/javascript'>alert('".session()->get('fail_avatarImg')."');</script>";
            }
            if(session()->get('failed'))
            {
                echo "<script type='text/javascript'>alert('".session()->get('failed')."');</script>";
            }
            if(session()->get('success'))
            {
                echo "<script type='text/javascript'>alert('".session()->get('success')."');</script>";
            }
            
        ?>