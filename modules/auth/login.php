<!-- Đăng nhập tài khoản -->
<?php
$info = [
    'title' => 'Đăng nhập'
];
layouts('header-login', $info);

date_default_timezone_set("Asia/Ho_Chi_Minh");
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
                    'create_at' => date('y-m-d H:i:s')
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


<div class="col-3 m-auto my-login fixed-top mt-5">
    <form action="" method="post">
        <h2 class="text-center text-uppercase">đăng nhập</h2>
        <label for="email">Địa chỉ email</label>
        <input type="email" class="form-control" placeholder="Abc@gmail.com" id="email" name="email">
        <label for="password" class="mt-1">Mật khẩu</label>
        <input type="password" class="form-control" id="password" placeholder="Mật khẩu" name="password">
        <hr>
        <button class="btn  mt-3 w-100 mb-3 btn-dark">Đăng nhập</button>
        <?php getSmg($msg, $msg_type); ?>
    </form>
</div>
<div class="bg-login">
</div>


<?php

layouts('footer', $info);
