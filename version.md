vers: 1.3.5:
- Thêm chức năng sửa/xóa bài đăng.

vers: 1.3.9:
- Database: sửa field `date` -> `first_date`, thêm field `last_date` bảng `posts`.
- Thêm chức năng ngày sửa đổi bài viết.
- Hiển thị thời gian sửa đổi cuối cùng (tháng trước/ ngày trước/ giờ trước/ phút trước/ vừa xong).
- Sửa lỗi đăng bài (404).

vers: 1.4.3:
- Database: xóa cột `score` bảng `posts`, thêm bảng `scores`:
    + `score_id` int NOT NULL PRIMARY KEY
    + `user_id` int NOT NULL foreign key `users`
    + `post_id` int NOT NULL foreign key `posts`
- Sửa chức năng vote điểm bài đăng. (Mỗi người chỉ được vote 1 điểm(lên/xuống/không)).
- Thêm chức năng hiển thị vote hiện tại trên các bài đăng.
- Thêm hiển thị lượt xem.

vers: 1.4.8:
- Database: thêm cột `score`(int NOT NULL DEFAULT 0) bảng `posts`, thêm 2 [trigger] bảng `scores`:
    + Thêm dữ liệu tự động cập nhật lại số điểm tại `posts`.`score` dựa theo `scores`.`post_id` vừa thêm.
    + Sửa dữ liệu tự động cập nhật lại số điểm tại `posts`.`score` dựa theo `scores`.`post_id` vừa thêm.
- Thêm chức năng lưu địa chỉ(url anchor) khi đăng nhập bằng modal hoặc đăng xuất.
- Sửa lỗi lọc bài đăng(top) theo điểm giảm dần.
- Sửa lỗi không hiện top 3 bài đăng tại trang Home.
- Thêm chức năng hiển thị vote hiện tại của người dùng trên trang Home.
## public host(learntogether.ihostfull.com) không hỗ trợ tạo trigger lên sẽ cập nhật lại điểm tại phần xử lý UP & DOWN score (CustomModel.php). Thêm hàm UpdateScoreOnPosts($post_id) thay cho trigger

vers: 1.4.9:
- Sửa đổi thư mục lưu trữ avatar của người dùng từ [public/Uploads] thành [public/Uploads/Avatar].
- Thêm thanh chức năng và biểu tượng cho giao diện viết bài (chỉ có giao diện, chưa có chức năng).
## thêm phần file - làm đồ án điện toán di động

vers: 1.5.0:
- Nhận dữ liệu người dùng nhập vào(tắt HTML) tại phần đăng bài.
- Thay thẻ <P> thành thẻ <Pre> tại phần hiển thị nội dung bài đăng.
- Thêm thuộc tính css overflow: hidden để tránh tràn nội dung bài đăng.
- Sửa lỗi/thay đổi giao diện tại trang quản lý bài đăng (của tôi/người dùng).
- Sửa một số lỗi nhỏ.

vers: 1.5.2:
- Validate lại tất cả text input:
    + User quote.
    + Fullname.
    + Phone number.
    + Comment.

vers: 1.5.4:
- Sửa lỗi phân trang tại quản lý bài đăng/xem bài đăng.
- Sửa lỗi nhập user_id tại xem bài đăng không tồn tại:
    + Thêm hàm checkValidUserId trong CustomModel.