<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/output.css" rel="stylesheet">
    <title></title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h1 class="my-3 text-uppercase text-primary fs-3">Danh sách danh mục sản phẩm</h1>
                <?php
                // Truy vấn database để lấy danh sách
                // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                include_once "../db.php";

                // 2. Chuẩn bị câu truy vấn $query
                $query = "select * from `categories`";

                // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                $result = mysqli_query($conn, $query);

                // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tách để sử dụng
                // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                $categories = [];
                $rowNum = 1;
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $categories[] = array(
                            "index" => $rowNum++,
                            "id" => $row['id'],
                            "name" => $row['name'],
                            "description" => $row['description'],
                            "created_at" => $row['created_at'],
                            "updated_at" => $row['updated_at']
                        );
                    }
                }
                ?>

                <!-- 5. Thể hiện dữ liệu ra màn hình -->

                <!-- Button Thêm mới -->
                <a href="./create.php" class="btn btn-primary d-inline-flex">
                    <i data-lucide="plus"></i>Thêm mới
                </a>

                <!-- tạo table chứa dữ liệu -->

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td>Stt</td>
                            <td>Tên</td>
                            <td>Mô tả</td>
                            <td>Ngày tạo</td>
                            <td>Ngày cập nhật</td>
                            <td>Xử lý</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $cat) { ?>
                        <tr>
                            <td><?php echo $cat['index'] ?></td>
                            <td><?php echo $cat['name'] ?></td>
                            <td><?php echo $cat['description'] ?></td>
                            <td><?php echo $cat['created_at'] ?></td>
                            <td><?php echo $cat['updated_at'] ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $cat['id'] ?>" class="btn btn-success"><i
                                        data-lucide="pencil" class="fs-6"></i></a>
                                <a href="delete.php?id=<?php echo $cat['id'] ?>" class="btn btn-danger"><i
                                        data-lucide="trash-2"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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