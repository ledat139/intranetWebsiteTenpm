<?php
$info = [
    'title' => 'Phòng họp'
];
//check login
if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}
$thisID = getSession('id');

layouts('headerEmp', $info);

if (isPost()) {
    $isError = false;
    if (empty($_POST['title'])) {
        $isError = true;
    }
    if (empty($_POST['content'])) {
        $isError = true;
    }

    if ($isError) {
        setFlashData('smg', 'Vui lòng nhập đầy đủ thông tin !!');
        setFlashData('smg_type', 'danger');
    } else {
        $data = [
            'CHUDEYC' => $_POST['title'],
            'NOIDUNGYC' => $_POST['content'],
            'TRANGTHAI' => 'false',
            'CHUYENYC' => 'false',
            'MANV' => $thisID,
            'CREATE_AT' => date("Y-m-d H:i:s")
        ];
        $insertStatus = insert('yeucau', $data);
        if ($insertStatus) {
            setFlashData('smg', 'Gửi yêu cầu thành công !!');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Hệ thống lỗi !!');
            setFlashData('smg_type', 'danger');
        }
    }
}

$smg = getFlashData('smg');
$smg_data = getFlashData('smg_type');




$listYC = getRow("select * from yeucau WHERE MANV = $thisID order by CREATE_AT desc");
?>


<div class="my-content">
    <div class="my-body fixed-top p-3">
        <div class="container">
            <div class="">
                <form action="" class="col-12" method="post">
                    <h3>Gửi yêu cầu</h3>
                    <div class="row mt-4">
                        <div class="col-4">
                            <label for="title" class="h6">Tiêu đề yêu cầu:</label>
                            <input type="title" class="form-control" placeholder="Yêu cầu xin nghỉ phép" id="title" name="title">
                        </div>
                        <div class="col-6">
                            <label for="content" class="h6">Nội dung:</label>
                            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                        </div>

                        <div class="col-4"><?php echo getSmg($smg, $smg_data); ?></div>
                    </div>
                    <button type="submit" class="my-btn btn btn-warning w-25 m-auto  col-2">Gửi yêu cầu</button>
                    <a class="btn m-auto w-25 btn-dark col-2" href="?module=yeucau&action=yeucauNV">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Hủy
                    </a>
                </form>
            </div>

            <div class="my-table-lh overflow-scroll mt-4">
                <table class="table">
                    <thead>
                        <tr class="table-dark my-header-table">
                            <th>Chủ đề</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($listYC)) :
                            foreach ($listYC  as $YC) :
                        ?>
                                <tr class="my-tr">
                                    <td><?php echo $YC['CHUDEYC'] ?></td>
                                    <td><?php echo $YC['NOIDUNGYC'] ?></td>
                                    <td><?php if ($YC['TRANGTHAI'] == 0)
                                            echo '<span class="btn-danger btn">Chưa phê duyệt</span>';
                                        else echo '<span class="btn-success btn">Đã phê duyệt</span>' ?></td>
                                    <td><a href="?module=yeucau&action=deleteNV&id=<?php echo $YC['MAYC']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><i class="fa-solid fa-trash-can" style="color: #000000;"></i></a></td>
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
</div>

<div class="fixed-top my-footer-tb d-flex justify-content-center align-items-center">
    <i class="fa-regular fa-copyright" style="color: #000;"></i>
    <p class="copy-right">Copyright 2024 by Tenpm</p>
</div>
</div>
</body>
<?php
layouts('footer', $info);
