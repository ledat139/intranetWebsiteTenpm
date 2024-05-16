<!-- Thêm nhân viên -->
<?php
$info = [
    'title' => 'Thêm nhân viên'
];
layouts('header', $info);


if (isPost()) {
    $isError = false;
    if (empty($_POST['fullName'])) {
        $isError = true;
    }
    if (empty($_POST['phoneNumber'])) {
        $isError = true;
    }
    if (empty($_POST['address'])) {
        $isError = true;
    }
    if (empty($_POST['birthDay'])) {
        $isError = true;
    }
    if (empty($_POST['dept'])) {
        $isError = true;
    }
    if (empty($_POST['email'])) {
        $isError = true;
    }
    if (empty($_POST['passWord'])) {
        $isError = true;
    }
    if (empty($_POST['sex'])) {
        $isError = true;
    }
    $emailList = getRow('select EMAIL from nhanvien');
    foreach ($emailList as $key => $value) {
        if (in_array($_POST['email'], $value)) $errorEmail = 'Email đã tồn tại';
    }
    if ($errorEmail) {
        setFlashData('smg', 'Email đã tồn tại');
        setFlashData('smg_type', 'danger');
    } else
    if ($isError) {
        setFlashData('smg', 'Vui lòng nhập đầy đủ thông tin !!');
        setFlashData('smg_type', 'danger');
    } else {
        if ($_POST['sex'] == 'Nam') $bool = 1;
        else $bool = 0;
        $data = [
            'HOTEN' => $_POST['fullName'],
            'DIACHI' => $_POST['address'],
            'GIOITINH' => $bool,
            'NGAYSINH' => $_POST['birthDay'],
            'EMAIL' => $_POST['email'],
            'PASSWORD' => $_POST['passWord'],
            'PHONGBAN' => $_POST['dept'],
            'SDT' => $_POST['phoneNumber']
        ];
        $insertStatus = insert('NHANVIEN', $data);
        if ($insertStatus) {
            setFlashData('smg', 'Thêm thành công !!');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Hệ thống lỗi !!');
            setFlashData('smg_type', 'danger');
        }
    }
}

$smg = getFlashData('smg');
$smg_data = getFlashData('smg_type');
?>

<div class="my-content">
    <div class="my-add-form fixed-top">
        <form action="" method="post" class="mt-5 col-11 m-auto">
            <h2 class="text-uppercase">Thông tin nhân viên</h2>
            <div class="row mt-4">
                <div class="col">
                    <label for="fullName" class="mt-1 h6">Họ tên</label>
                    <input type="fullName" class="form-control" placeholder="Họ tên" id="fullName" name="fullName">
                    <label for="phoneNumber" class="mt-3 h6">Số điện thoại</label>
                    <input type="text" class="form-control" placeholder="Số điện thoại" id="phoneNumber" name="phoneNumber">
                    <label for="sex" class="mt-3 h6">Giới tính</label>
                    <select id="sex" name="sex" class="form-control">
                        <option value="">Vui lòng chọn</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                    <label for="address" class="mt-3 h6">Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="Thành phố hoặc tỉnh" id="address" name="address">
                </div>

                <div class="col">
                    <label for="birthDay" class="mt-1 h6">Ngày sinh</label>
                    <br>
                    <input type="date" id="birthDay" name="birthDay">
                    <br>
                    <label for="dept" class="mt-3 h6">Phòng ban</label>
                    <input type="text" class="form-control" placeholder="Tên phòng ban" id="dept" name="dept">
                    <label for="email" class="mt-3 h6">Địa chỉ email</label>
                    <input type="email" class="form-control" placeholder="Abc@gmail.com" id="email" name="email">
                    <label for="password" class="mt-3 h6">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" placeholder="Mật khẩu" name="passWord">

                </div>

            </div>
            <div class="mt-4 mb-3">
                <button class="btn text-white" type="submit" style="background-color: rgb(8, 49, 198);">
                    <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
                    Thêm nhân viên
                </button>
                <a class="btn btn-dark" href="?module=nhanvien&action=list">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Thoát
                </a>
            </div>
            <?php getSmg($smg, $smg_data); ?>
        </form>
    </div>
</div>


<?php
layouts('footer', $info);
