<?php
include_once "../db.php";
include_once "../functions.php";
$users = showAllUsers();
?>


<?php include_once("../includes/header.php") ?>
<h1 class="my-3 text-uppercase text-primary fs-3">Danh sách Người dùng</h1>
<a href="./create.php" class="btn btn-primary d-inline-flex">
    <i data-lucide="plus"></i>Thêm mới
</a>

<!-- tạo table chứa dữ liệu -->
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <td>Stt</td>
            <td>Username</td>
            <td>Email</td>
            <td>Password</td>
            <td>Ngày tạo</td>
            <td>Ngày cập nhật</td>
            <td>Xử lý</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['index'] ?></td>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['password'] ?></td>
                <td><?php echo $user['created_at'] ?></td>
                <td><?php echo $user['updated_at'] ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $user['id'] ?>" class="btn btn-success"><i data-lucide="pencil" class="fs-6"></i></a>
                    <a href="delete.php?id=<?php echo $user['id'] ?>" class="btn btn-danger"><i data-lucide="trash-2"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php include_once("../includes/footer.php") ?>