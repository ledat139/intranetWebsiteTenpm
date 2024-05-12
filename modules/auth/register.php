<!-- Đăng ký tài khoản -->
<?php
$info = [
    'title' => 'Đăng ký'
];
layouts('header', $info);

 
if (isPost()) {
    $error = [];

    //fullName: bắt buộc phải nhập, trên 5 kí tự
    if (empty($_POST['fullName'])) {
        $error['fullName']['required'] = 'Bắt buộc phải nhập họ tên';
    } else if (strlen($_POST['fullName']) < 5) {
        $error['fullName']['min'] = 'Họ tên phải trên 5 kí tự';
    }


    // Email: bắt buộc nhập, đúng định dạng, kiểm tra email đã tồn tại
    if (empty($_POST['email']))
        $error['email']['required'] = 'Bắt buộc phải nhập email';
    else {
        $emailList = getRow('select email from users');
        foreach ($emailList as $key => $value) {
            if (in_array($_POST['email'], $value)) $error['email']['unique'] = 'Email đã tồn tại';
        }
    }


    //validate sdt
    if (empty($_POST['phoneNumber']))
        $error['phoneNumber']['required'] = 'Bắt buộc phải nhập email';
    else
        if (!isPhoneNumber($_POST['phoneNumber'])) $error['phoneNumber']['valid'] = 'Số điện thoại không đúng định dạng';


    //validate password: bắt buộc phải nhập, lớn hơn 8 ký tự
    if (empty($_POST['passWord']))
        $error['passWord']['required'] = 'Bắt buộc phải nhập mật khẩu';
    else if (strlen($_POST['passWord']) < 8) {
        $error['passWord']['min'] = 'Mật khẩu phải từ 8 kí tự trở lên';
    }


    //validate confirmPassWord: bắt buộc phải nhập, giống passWord
    if (empty($_POST['confirmPassWord']))
        $error['confirmPassWord']['required'] = 'Bắt buộc phải nhập mật khẩu';
    else if ($_POST['passWord'] != $_POST['confirmPassWord']) {
        $error['confirmPassWord']['match'] = 'Mật khẩu nhập lại không trùng khớp';
    }
    if (empty($error)) {
        setFlashData('smg', 'Đăng kí thành công !!');
        setFlashData('smg_type', 'success');
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra dữ liệu !!');
        setFlashData('smg_type', 'danger');
    }
}

$smg = getFlashData('smg');
$smg_data = getFlashData('smg_type');
?>


<div class="row login">
    <div class="col-4 m-auto">
        <form action="" method="post">
            <?php getSmg($smg, $smg_data); ?>
            <h2 class="text-center text-uppercase">Đăng ký tài khoản</h2>
            <label for="fullName" class="mt-1">Họ tên</label>
            <input type="fullName" class="form-control" placeholder="Họ tên" id="fullName" name="fullName">
            <label for="email" class="mt-1">Địa chỉ email</label>
            <input type="email" class="form-control" placeholder="Abc@gmail.com" id="email" name="email">
            <label for="phoneNumber" class="mt-1">Số điện thoại</label>
            <input type="text" class="form-control" placeholder="Số điện thoại" id="phoneNumber" name="phoneNumber">
            <label for="password" class="mt-1">Mật khẩu</label>
            <input type="password" class="form-control" id="password" placeholder="Mật khẩu" name="passWord">
            <label for="confirmPassword" class="mt-1">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" id="confirmPassword" placeholder="Nhập lại mật khẩu" name="confirmPassWord">
            <button class="btn btn-primary mt-3 w-100">Đăng ký</button>
            <hr>
            <div class="d-flex flex-column align-items-center">
                <a href="?module=auth&action=login" class="link mt-1">Đăng nhập</a>
            </div>
        </form>
    </div>
</div>



<?php
layouts('footer', $info);
