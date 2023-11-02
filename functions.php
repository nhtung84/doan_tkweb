<?php
include "./db.php";


// 1) crud for users
function showAllUsers()
{
    global $conn;
    $query = "select * from `users`";
    $result = mysqli_query($conn, $query);

    $users = [];
    $rowNum = 1;
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $users[] = array(
                "index" => $rowNum++,
                "id" => $row['id'],
                "username" => $row['username'],
                "email" => $row['email'],
                "password" => $row['password'],
                "created_at" => $row['created_at'],
                "updated_at" => $row['updated_at']
            );
        }
    }
    return $users;
}
function showUser($id)
{
    global $conn;
    $query = "SELECT * FROM users WHERE id='$id'";

    $result = mysqli_query($conn, $query);
    $row = $result->fetch_assoc();
    // Nếu không tìm thấy dữ liệu -> thông báo lỗi
    if (empty($row)) {
        echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
        header("Location:index.php");
    }
    return $row;
}
function updateUser($id, $data)
{
}
function createUser($username, $email, $password)
{
    global $conn;
    $queryInsert = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($conn, $queryInsert)) {
        mysqli_close($conn);
        header('location:index.php');
    } else {
        echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
    }
}
function deleteUser($id)
{
    global $conn;
    $queryDelete = "DELETE FROM users WHERE id='$id';";

    // 3. Thực thi câu lệnh DELETE
    $result = mysqli_query($conn, $queryDelete);

    // 4. Đóng kết nối
    mysqli_close($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
}

function createCategory($name, $description)
{
    global $conn;
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

function validateCreateUser()
{
    $errors = [];
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
}
