<?php

    $numsPost = count($topPosts);

?>
<div class="home__body">
        <div class="welcome">
            <div class="container">
                <div class="welcome__quote">
                    <h1>Chào mừng bạn đến với LearnTogether</h1>
                </div>
            </div>
        </div>
        <div class="news">
            <div class="container">
                <h2 class="title">Tin tức</h2>
                <div class="selection">
                    <div class="selection__one">
                        <label for="" class="home__news__trendy__btn">Nổi bật</label>
                        <label for="" class="home__news__new__btn">Mới nhất</label>
                    </div>
                    <a href="<?php echo base_url('News') ?>" class="see_all">Xem tất cả</a>
                </div>
                <div class="news__trendy">
                    <div class="trendy__block_1">
                        <div class="trendy__block__content">
                            <img src="<?php echo base_url('public/Images/thuat-toan-chuoi-nhi-phan-do-dai-n.jpg') ?>" alt="">
                            <a class="a__title" onclick="return notAvaibleFunction()" >Thuật Toán Đưa Ra Chuỗi Nhị Phân...</a>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="block__content">
                            Chắc hẳn ai học về giải thuật cũng đã từng nghe qua và làm về bài toán đưa ra chuỗi nhị phân độ ...
                            </div>
                        </div>
                        <div class="trendy__block__detail">
                            <label for="">Tác giả: ABCCC</label>
                            <label for="">Ngày đăng: 01/08/2021</label>
                        </div>
                    </div>
                    <div class="trendy__block_2">
                    <div class="trendy__block__content">
                            <img src="<?php echo base_url('public/Images/Codeigniter-framework-la-gi.jpg') ?>" alt="">
                            <a class="a__title" href="">Code Igniter là gì ???</a>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="block__content">
                            Codeigniter căn bản chúng ta sẽ tìm hiểu sơ lược cách tổ chức folder trong CI, cách sử dụng các thư viện có sẵn...
                            </div>
                        </div>
                        <div class="trendy__block__detail">
                            <label for="">Tác giả: ABCCC</label>
                            <label for="">Ngày đăng: 01/08/2021</label>
                        </div>
                    </div>
                    <div class="trendy__block_3">
                    <div class="trendy__block__content">
                            <img src="<?php echo base_url('public/Images/mo-hinh-mvc.jpg') ?>" alt="">
                            <a class="a__title" href="">MVC là gì ? Ứng dụng của mô hình MVC.</a>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star nostar"></i>
                            </div>
                            <div class="block__content">
                            MVC (MVC Design Pattern) là viết tắt của Model — View — Controller. Đó là một mẫu kiến ​​trúc, mô hình lập trình...
                            </div>
                        </div>
                        <div class="trendy__block__detail">
                            <label for="">Tác giả: ABCCC</label>
                            <label for="">Ngày đăng: 01/08/2021</label>
                        </div>
                    </div>
                </div>
                <div class="news__new">
                    <div class="new__block_1">
                        <div class="new__block__content">
                            <img src="<?php echo base_url('public/Images/temp_news.png') ?>" alt="">
                            <a class="a__title" href=""></a>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="content"></div>
                        </div>
                        <div class="new__block__detail">
                            <label for="">Tác giả: </label>
                            <label for="">Ngày đăng: </label>
                        </div>
                    </div>
                    <div class="new__block_2">
                        <div class="new__block__content">
                            <img src="<?php echo base_url('public/Images/temp_news.png') ?>" alt="">
                            <a class="a__title" href=""></a>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="content"></div>
                        </div>
                        <div class="new__block__detail">
                            <label for="">Tác giả: </label>
                            <label for="">Ngày đăng: </label>
                        </div>
                    </div>
                    <div class="new__block_3">
                        <div class="new__block__content">
                            <img src="<?php echo base_url('public/Images/temp_news.png') ?>" alt="">
                            <a class="a__title" href=""></a>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="content"></div>
                        </div>
                        <div class="new__block__detail">
                            <label for="">Tác giả: </label>
                            <label for="">Ngày đăng: </label>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        <div class="studies">
            <div class="container">
                <h2 class="title">Bài học</h2>
                <a href="<?php echo base_url('Course') ?>" class="see_all">Xem tất cả</a>
                <div class="studies__content">
                    <div href="" class="studies__content__block_1">
                        <div class="studies__block__content">
                            <img src="<?php echo base_url('public/Images/course_cpp.jpg') ?>" alt="">
                            <div class="studies__content__one">
                                <a class="a__title" href="">C++ cơ bản</a>
                                <div class="block__content">Học lập trình C++ cơ bản đang là một xu hướng của ngành lập trình hiện nay. Bởi vì C++ là ngôn ngữ phổ biến...</div>
                            </div>
                        </div>
                        <div class="studies__block__detail">
                            <div>
                                <label for=""><i class="far fa-clock"></i> 01/08/2021</label>
                                <a href="">Vào học</a>
                            </div>
                        </div>
                    </div>
                    <div class="studies__content__block_2">
                        <div class="studies__block__content">
                            <img src="<?php echo base_url('public/Images/course_java.jpg') ?>" alt="">
                            <div class="studies__content__one">
                                <a class="a__title" href="">Java dành cho người mới</a>
                                <div class="block__content">
                                Java là ngôn ngữ lập trình máy tính có tính chất hướng đối tượng, dựa trên các lớp...
                                </div>
                            </div>
                        </div>
                        <div class="studies__block__detail">
                            <div>
                                <label for=""><i class="far fa-clock"></i> 01/08/2021</label>
                                <a href="">Vào học</a>
                            </div>
                        </div>
                    </div>
                    <div class="studies__content__block_3">
                    <div class="studies__block__content">
                        <img src="<?php echo base_url('public/Images/course_javaoop.jpg') ?>" alt="">
                            <div class="studies__content__one">
                                <a class="a__title" href="">Lập trình java hướng đối tượng</a>
                                <div class="block__content">
                                Khái niệm về lập trình hướng đối tượng trong java. Đối tượng (Object), lớp (Class), kế thừa ...
                                </div>
                            </div>
                        </div>
                        <div class="studies__block__detail">
                            <div>
                                <label for=""><i class="far fa-clock"></i> 01/08/2021</label>
                                <a href="">Vào học</a>
                            </div>
                        </div>
                    </div>
                    <div class="studies__content__block_4">
                    <div class="studies__block__content">
                        <img src="<?php echo base_url('public/Images/course_sql.jpg') ?>" alt="">
                            <div class="studies__content__one">
                                <a class="a__title" href="">SQL cơ bản</a>
                                <div class="block__content">SQL là viết tắt của từ Structured Query Language, nghĩa là ngôn ngữ...

                                </div>
                            </div>
                        </div>
                        <div class="studies__block__detail">
                            <div>
                                <label for=""><i class="far fa-clock"></i> 01/08/2021</label>
                                <a href="">Vào học</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shares">
            <div class="container">
                <h2 class="title" style="text-align: center;">Thảo luận</h2>
                <div class="shares__content--cover">
                <div class="shares__content">
                    <?php for($i = 0; $i<$numsPost; $i++): ?>
                    <div class="shares__content__block_1">
                        <div class="shares__content__one">
                            <img src="<?php echo base_url($topPosts[$i]->avatar) ?>" alt="">
                            <label for="" class="user_level"><?php echo $topPosts[$i]->level_name ?></label>
                            <div class="UpAndDown">
                                <i class="fas fa-caret-up <?php if($topPosts[$i]->currentVote == 1) echo " isActive" ?>"></i>
                                <label for=""><?php echo($topPosts[$i]->score) ?></label>
                                <i class="fas fa-caret-down <?php if($topPosts[$i]->currentVote == -1) echo " isActive" ?>"></i>
                            </div>
                        </div>
                        <div class="shares__content__two">
                            <div class="shares__block__content">
                                <a href="<?php echo base_url('Discussion/post/'.$topPosts[$i]->post_id) ?>"><?php echo $topPosts[$i]->title ?></a>
                                <div>
                                    <?php echo $topPosts[$i]->content ?>
                                </div>
                            </div>
                            <div class="shares__block__detail">
                                <label for="">Tác giả: <?php echo $topPosts[$i]->username ?></label>
                                <label for="">Ngày đăng: <?php echo date("d/m/Y", strtotime($topPosts[$i]->first_date)) ?></label>
                                <i class="far fa-comment-dots">7</i>
                            </div>
                        </div>
                    </div>
                    <?php endfor ?>
                    <a href="<?php echo base_url('Discussion') ?>" class="see_all">Xem thêm</a>
                </div>
            </div>
            </div>
        </div>
    </div>