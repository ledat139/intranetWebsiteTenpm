<?php
$info = [
    'title' => 'Nhân viên'
];
//check login
if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}


layouts('header', $info);

$listEmp = getRow('select * from nhanvien');
?>


<div class="my-content">
    <div class="my-body fixed-top p-3">
        <div class="d-flex justify-content-between align-items-center mt-1">
            <h3 class="mt-1">Quản lý nhân viên</h3>
            <a href="?module=nhanvien&action=add" class="btn btn-success my-btn1">
                <i class="fa-solid fa-user-plus"></i>
                Thêm nhân viên
            </a>
        </div>
        <div class="my-table overflow-scroll mt-3">
            <table class="table">
                <thead>
                    <tr class="table-dark my-header-table">
                        <th>Mã nhân viên</th>
                        <th>Họ tên</th>
                        <th>Địa chỉ</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>SĐT</th>
                        <th>Phòng ban</th>
                        <th>Email</th>
                        <th>Mật khẩu</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($listEmp)) :
                        foreach ($listEmp as $emp) :
                    ?>
                            <tr>
                                <td><?php echo $emp['MANV'] ?></td>
                                <td><?php echo $emp['HOTEN'] ?></td>
                                <td><?php echo $emp['DIACHI'] ?></td>
                                <td><?php if ($emp['GIOITINH'] == 1) echo 'Nam';
                                    else echo 'Nữ'; ?></td>
                                <td><?php echo date("d-m-Y", strtotime($emp['NGAYSINH'])) ?></td>
                                <td><?php echo $emp['SDT'] ?></td>
                                <td><?php echo $emp['PHONGBAN'] ?></td>
                                <td><?php echo $emp['EMAIL'] ?></td>
                                <td><?php echo $emp['PASSWORD'] ?></td>
                                <td><a href="?module=nhanvien&action=update&id=<?php echo $emp['MANV']; ?> " class="btn btn-warning"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></a></td>
                                <td><a href="?module=nhanvien&action=delete&id=<?php echo $emp['MANV']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><i class="fa-solid fa-trash-can" style="color: #000000;"></i></a></td>
                            </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="fixed-top my-button-add d-flex justify-content-center align-items-center">
        <i class="fa-regular fa-copyright" style="color: #000;"></i>
        <p class="copy-right">Copyright 2024 by Tenpm</p>
    </div>
</div>

</body>
<?php
layouts('footer', $info);
