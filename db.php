<?php
// Tạo kết nối database bằng mysqli_connect cần:
// 1. hostname/ip: tên host hoặc IP database server
// - ví dụ: '127.0.0.1' tương đương 'localhost': là địa chỉ máy cục bộ
//   port mặc định khi sử dụng MySQL là 3306
//   nếu sử dụng port khác, ví dụ 3307 thì giá trị truyền vào là '127.0.0.1:3307'
// trong ví dụ này dùng: 'localhost'
// 2. username: tên tài khoản được phép truy cập vào database server
// 3. password: mật khẩu tài khoản được phép truy cập vào database server
// 4. database_name: tên database bạn muốn truy cập đến

$conn = mysqli_connect('localhost', 'root', '', 'doan1');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
