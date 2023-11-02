<?php
// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once "../db.php";
// 2. Người dùng mới truy cập trang lần đầu tiên (người dùng chưa gởi dữ liệu `add` - chưa nhấn nút Thêm) về Server
// có nghĩa là biến $_POST['add'] chưa được khởi tạo hoặc chưa có giá trị
// => hiển thị Form nhập liệu

// Nếu biến $_POST['add'] đã được khởi tạo
// => Người dùng đã bấm nút "add" để thêm dữ liệu ==> xử lý dữ liệu

if (isset($_POST['add'])) {
    // 3. Nếu người dùng có bấm nút `Thêm` thì thực thi câu lệnh INSERT
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $name = $_POST['name'];
    $description = $_POST['description'];
    $created_at = date('Y-m-d H:i:s'); // Lấy ngày giờ hiện tại theo định dạng `Năm-Tháng-Ngày Giờ-Phút-Giây`. Vd: 2020-02-18 09:12:12
    $updated_at = NULL;

    // 4. Kiểm tra ràng buộc dữ liệu (Validation)
    // Tạo biến lỗi để chứa thông báo lỗi
    $errors = [];

    // --- Kiểm tra Tên của danh mục sản phẩm (validate)
    // required (bắt buộc nhập <=> không được rỗng)
    if (empty($name)) {
        $errors['name'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $name,
            'msg' => 'Vui lòng nhập tên danh mục sản phẩm'
        ];
    }

    // minlength 5 (tối thiểu 5 ký tự)
    if (!empty($name) && strlen($name) < 5) {
        $errors['name'][] = [
            'rule' => 'minlength',
            'rule_value' => true,
            'value' => $name,
            'msg' => 'Tên phải ít nhất 5 ký tự'
        ];
    }
    // maxlength 30 (tối đa 30 ký tự)
    if (!empty($name) && strlen($name) > 30) {
        $errors['name'][] = [
            'rule' => 'maxlength',
            'rule_value' => true,
            'value' => $name,
            'msg' => 'Tên nhiều nhất 30 ký tự'
        ];
    }
    // minlength 5 (tối thiểu 5 ký tự)
    if (!empty($description) && strlen($description) < 5) {
        $errors['name'][] = [
            'rule' => 'minlength',
            'rule_value' => true,
            'value' => $description,
            'msg' => 'Mô tả ít nhất 5 ký tự'
        ];
    }
    // maxlength 30 (tối đa 30 ký tự)
    if (!empty($description) && strlen($description) > 500) {
        $errors['name'][] = [
            'rule' => 'maxlength',
            'rule_value' => true,
            'value' => $description,
            'msg' => 'Mô tả nhiều nhất 30 ký tự'
        ];
    }

    // 5. Thông báo lỗi cụ thể người dùng mắc phải (nếu vi phạm bất kỳ quy luật kiểm tra ràng buộc)
    // var_dump($errors);
    if (!empty($errors)) {
        foreach ($errors as $errorField) {
            foreach ($errorField as $error) {
                echo $error["msg"] . "</br>";
            }
        }
        return;
    }

    // 6. Nếu không có lỗi dữ liệu sẽ thực thi câu lệnh SQL
    // Câu lệnh INSERT

    $queryInsert = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";

    if (mysqli_query($conn, $queryInsert)) {
        // Đóng kết nối
        mysqli_close($conn);

        // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
        header('location:index.php');
    } else {
        echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Create category</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h1 class="mt-5 fs-3 text-uppercase text-primary">Thêm Danh mục sản phẩm</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" name="add" value="Thêm">
                </form>
            </div>

        </div>
    </div>



    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>