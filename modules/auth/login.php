<!-- Đăng nhập tài khoản -->
<?php
$info = [
    'title' => 'Đăng nhập'
];
layouts('header', $info);


//check login
if (isLogin()) {
    header('Location: ?module=home&action=dashboard');
}


if (isPost()) {
    if ((!empty($_POST['email'])) && (!empty($_POST['password']))) {
        $param[':email'] = $_POST['email'];
        $userRequest = oneRow('select id, password from users where email = :email', $param);
        if (!empty($userRequest)) {
            if ($userRequest['password'] == $_POST['password']) {

                $userID = $userRequest['id'];
                $token = sha1(uniqid() . time());

                $dataInsert = [
                    'user_id' => $userID,
                    'token' => $token,
                    'create_at' => date('d-m-y H:i:s')
                ];
                $insertStatus = insert('tokenlogin', $dataInsert);
                if ($insertStatus) {
                    setSession('tokenLogin', $token);
                    header('Location: ?module=home&action=dashboard');
                }
            }
        }
    }
    setFlashData('msg', 'Mật khẩu hoặc tài khoản không chính xác.');
    setFlashData('msg_type', 'danger');
    // header('Location: ?module=auth&action=login');
}
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');

?>
<div class="row login">
    <div class="col-4 m-auto">
        <form action="" method="post">
            <h2 class="text-center text-uppercase">đăng nhập quản lý user</h2>
            <?php getSmg($msg, $msg_type); ?>
            <label for="email" class="mt-1">Địa chỉ email</label>
            <input type="email" class="form-control" placeholder="Abc@gmail.com" id="email" name="email">
            <label for="password" class="mt-1">Mật khẩu</label>
            <input type="password" class="form-control" id="password" placeholder="Mật khẩu" name="password">
            <button class="btn btn-primary mt-3 w-100">Đăng nhập</button>
            <hr>
            <div class="d-flex flex-column align-items-center">
                <a href="?module=auth&action=forgot" class="link">Quên mật khẩu</a>
                <a href="?module=auth&action=register" class="link mt-1">Đăng ký tài khoản</a>
            </div>
        </form>
    </div>
</div>



<?php

layouts('footer', $info);
