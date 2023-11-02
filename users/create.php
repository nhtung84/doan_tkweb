<?php

include_once "../db.php";
include_once "../functions.php";
if (isset($_POST['add'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    createUser($username, $email,  $password);
}

include_once("../includes/header.php") ?>
<h1 class="mt-5 fs-3 text-uppercase text-primary">Thêm Người dùng</h1>
<form action="" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="usename">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>

    <input type="submit" class="btn btn-primary" name="add" value="Thêm">
</form>