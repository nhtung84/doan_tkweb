<?php
// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once "../db.php";

// 2. Chuẩn bị câu truy vấn $querySelect, lấy dữ liệu ban đầu của record cần update
if (!isset($_GET['id'])) {
    header('location:index.php');
}
$id = $_GET['id'];
$queryCat = "SELECT * FROM categories WHERE id=$id";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record cần update
$result = mysqli_query($conn, $queryCat);
$categoryRow = $result->fetch_assoc();
// Nếu không tìm thấy dữ liệu -> thông báo lỗi
if (empty($categoryRow)) {
    echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update category</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h1 class="mt-5 fs-3 text-uppercase text-primary">Sửa Danh mục sản phẩm</h1>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input value="<?php echo $categoryRow["id"]; ?>" readonly type="text" name="id" class="form-control" id="id">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input value="<?php echo $categoryRow["name"]; ?>" type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo $categoryRow["description"]; ?></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" name="save" value="Lưu">
                </form>
            </div>

        </div>
    </div>
    <?php
    if (isset($_POST['save'])) {
        // 4. Nếu người dùng có bấm nút `Lưu` thì thực thi câu lệnh INSERT
        // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
        $name = $_POST['name'];
        $description = $_POST['description'];
        $updated_at = date('Y-m-d H:i:s');;

        // 5. Kiểm tra ràng buộc dữ liệu (Validation)
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

        // 6. Thông báo lỗi cụ thể người dùng mắc phải (nếu vi phạm bất kỳ quy luật kiểm tra ràng buộc)
        // var_dump($errors);
        if (!empty($errors)) {
            foreach ($errors as $errorField) {
                foreach ($errorField as $error) {
                    echo $error["msg"] . "</br>";
                }
            }
            return;
        }

        // 7. Nếu không có lỗi dữ liệu sẽ thực thi câu lệnh SQL
        // Câu lệnh INSERT

        $queryUpdate = "UPDATE categories SET name = '$name', description = '$description', updated_at= '$updated_at' WHERE id='$id'";

        if (mysqli_query($conn, $queryUpdate)) {
            // Đóng kết nối
            mysqli_close($conn);

            // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
            header('location:index.php');
        } else {
            echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
        }
    }
    ?>


    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>