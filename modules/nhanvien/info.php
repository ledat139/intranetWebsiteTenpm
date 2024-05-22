<!-- Sửa nhân viên -->
<?php
$info = [
    'title' => 'Cập nhật thông tin nhân viên'
];
layouts('headerEmp', $info);
$thisID = getSession('id');

$userQuery = getRow("select * from nhanvien where MANV = $thisID");
if ($userQuery['0']['PHONGBAN'] == 'Nhân sự') {
    layouts('headerNS', $info);
} else {
    layouts('headerEmp', $info);
}
$param[':MANV'] = $thisID;
$oldData = oneRow('select * from nhanvien where MANV = :MANV', $param);
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
    if ($_POST['email'] != $oldData['EMAIL']) {
        $TEMP = $oldData['EMAIL'];
        $emailList = getRow("select EMAIL from nhanvien where EMAIL <> '$TEMP'");
        print_r($emailList);
        foreach ($emailList as $key => $value) {
            if (in_array($_POST['email'], $value)) $errorEmail = 'Email đã tồn tại';
        }
    }
    if ($errorEmail) {
        setFlashData('smg', 'Email đã tồn tại');
        setFlashData('smg_type', 'danger');
    } else
    if ($isError) {
        setFlashData('smg', 'Vui lòng nhập đầy đủ thông tin !!');
        setFlashData('smg_type', 'danger');
    } else {
        $target_dir = "templates/upload/";
        $target_file = $target_dir . basename($_FILES["image-upload"]["name"]);
        move_uploaded_file($_FILES["image-upload"]["tmp_name"], $target_file);

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
            'SDT' => $_POST['phoneNumber'],
            'FILEPATH' => $target_file
        ];
        $id = $thisID;
        $updateStatus = update('NHANVIEN', $data, "MANV = '$id'");
        if ($updateStatus) {
            $oldData['HOTEN'] = $_POST['fullName'];
            $oldData['DIACHI'] = $_POST['address'];
            $oldData['GIOITINH'] = $bool;
            $oldData['NGAYSINH'] = $_POST['birthDay'];
            $oldData['EMAIL'] = $_POST['email'];
            $oldData['PASSWORD'] = $_POST['passWord'];
            $oldData['PHONGBAN'] = $_POST['dept'];
            $oldData['SDT'] = $_POST['phoneNumber'];
            $oldData['FILEPATH'] = $target_file;
            setFlashData('smg', 'Cập nhật thành công !!');
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
    <div class="my-add-form fixed-top p-3">
        <form action="" method="post" class=" col-11 m-auto" enctype="multipart/form-data">
            <h2 class="text-uppercase">Thông tin nhân viên</h2>
            <p class="text-danger">*Được phép cập nhật ảnh, số điện thoại, địa chỉ, ngày sinh</p>
            <div class="row mt-4">
                <div class="col">
                    <label for="fullName" class="mt-4 h6">Họ tên</label>
                    <input type="fullName" class="form-control ban" placeholder="Họ tên" id="fullName" name="fullName" value="<?php echo $oldData['HOTEN']; ?>">
                    <label for="phoneNumber" class="mt-3 h6">Số điện thoại</label>
                    <input type="text" class="form-control" placeholder="Số điện thoại" id="phoneNumber" name="phoneNumber" value="<?php echo $oldData['SDT']; ?>">
                    <label for="sex" class="mt-3 h6">Giới tính</label>
                    <select id="sex" name="sex" class="form-control ban">
                        <?php if ($oldData['GIOITINH'] == 1)
                            echo '<option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>';
                        else echo '<option value="Nữ">Nữ</option>
                        <option value="Nam">Nam</option>'
                        ?>
                    </select>
                    <label for="address" class="mt-3 h6">Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="Thành phố hoặc tỉnh" id="address" name="address" value="<?php echo $oldData['DIACHI']; ?>">
                    <label for="birthDay" class="mt-3 h6">Ngày sinh</label>
                    <br>
                    <input type="date" id="birthDay" name="birthDay" value="<?php echo $oldData['NGAYSINH']; ?>">
                    <br>
                </div>


                <div class="col">
                    <div class="img-profile"><img src="<?php echo $oldData['FILEPATH'] ?>" alt="" class="profile"></div>
                    <label for="image" class="mt-3 h6">Chọn ảnh:</label>
                    <input type="file" class="form-control-file" id="image" name="image-upload" required>
                    <label for="dept" class="mt-3 h6">Phòng ban</label>
                    <input type="text" class="form-control ban" placeholder="Tên phòng ban" id="dept" name="dept" value="<?php echo $oldData['PHONGBAN']; ?>">
                    <label for="email" class="mt-3 h6">Địa chỉ email</label>
                    <input type="email" class="form-control ban" placeholder="Abc@gmail.com" id="email" name="email" value="<?php echo $oldData['EMAIL']; ?>">
                    <label for="password" class="mt-3 h6">Mật khẩu</label>
                    <input type="password" class="form-control ban" id="password" placeholder="Mật khẩu" name="passWord" value="<?php echo $oldData['PASSWORD']; ?>">

                </div>

            </div>
            <div class="mt-4 mb-3">
                <button class="btn text-white" type="submit" style="background-color: rgb(8, 49, 198);">
                    <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
                    Cập nhật thông tin
                </button>
                <a class="btn btn-dark" href="?module=nhanvien&action=info">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Thoát
                </a>
            </div>
            <div><?php getSmg($smg, $smg_data); ?></div>
        </form>
    </div>
</div>
<?php
layouts('footer', $info);
