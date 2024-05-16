<?php
$info = [
    'title' => 'Nhân viên'
];
if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}
layouts('header', $info);
//check login

$listEmp = getRow('select * from nhanvien');
?>


<div class="my-content">
    <div class="my-body fixed-top container ">
        <a href="?module=nhanvien&action=add" class="btn btn-success mt-5">
            <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
            Thêm nhân viên
        </a>
        <div class="my-table overflow-scroll mt-3">
            <table class="table">
                <thead>
                    <tr class="table-primary my-header-table">
                        <th>Mã nhân viên</th>
                        <th>Họ tên</th>
                        <th>Địa chỉ</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>SĐT</th>
                        <th>Phòng ban</th>
                        <th>Email</th>
                        <th>Password</th>
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
                                <th><?php echo $emp['MANV'] ?></th>
                                <th><?php echo $emp['HOTEN'] ?></th>
                                <th><?php echo $emp['DIACHI'] ?></th>
                                <th><?php if ($emp['GIOITINH'] == 1) echo 'Nam';
                                    else echo 'Nữ'; ?></th>
                                <th><?php echo date("d-m-Y", strtotime($emp['NGAYSINH'])) ?></th>
                                <th><?php echo $emp['SDT'] ?></th>
                                <th><?php echo $emp['PHONGBAN'] ?></th>
                                <th><?php echo $emp['EMAIL'] ?></th>
                                <th><?php echo $emp['PASSWORD'] ?></th>
                                <th><a href="?module=nhanvien&action=update&id=<?php echo $emp['MANV']; ?> " class="btn btn-warning"><i class="fa-solid fa-pen-to-square" style="color: #000000;"></i></a></th>
                                <th><a href="" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><i class="fa-solid fa-trash-can" style="color: #000000;"></i></a></th>
                            </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
<?php
layouts('footer', $info);
