<?php
include_once "../db.php";
include_once "../functions.php";
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $created_at = date('Y-m-d H:i:s'); // Lấy ngày giờ hiện tại theo định dạng `Năm-Tháng-Ngày Giờ-Phút-Giây`. Vd: 2020-02-18 09:12:12
    $updated_at = NULL;
    createCategory($name, $description);
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