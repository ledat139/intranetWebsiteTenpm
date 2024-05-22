<?php
$info = [
    'title' => 'Phòng họp'
];
//check login
if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}
$thisID = getSession('id');

layouts('header', $info);

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




$listYC = getRow("select * from yeucau WHERE CHUYENYC = 0 order by CREATE_AT desc");
?>


<div class="my-content">
    <div class="my-body fixed-top p-3">
        <div class="container">
            <h3>Xử lý yêu cầu</h3>


            <div class="my-table-lh overflow-scroll mt-4">
                <table class="table">
                    <thead>
                        <tr class="table-dark my-header-table">
                            <th>Chủ đề</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                            <th>Chuyển yêu cầu cho phòng nhân sự</th>
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
                                    <td><a href="?module=yeucau&action=chuyenyc&id=<?php echo $YC['MAYC'] ?>" class="btn btn-warning">Chuyển yêu cầu <i class="fa-solid fa-arrow-right mx-1" style="color: #000;"></i></a></td>
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
