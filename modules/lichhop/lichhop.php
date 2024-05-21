<?php
$info = [
    'title' => 'Phòng họp'
];
//check login
if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}


layouts('header', $info);

if (isPost()) {
    $isError = false;
    if (empty($_POST['meeting-date'])) {
        $isError = true;
    }
    if (empty($_POST['meeting-time'])) {
        $isError = true;
    }
    if (empty($_POST['meeting-room'])) {
        $isError = true;
    }
    if (empty($_POST['meeting-content'])) {
        $isError = true;
    }
    if ($isError) {
        setFlashData('smg', 'Vui lòng nhập đầy đủ thông tin !!');
        setFlashData('smg_type', 'danger');
    } else {
        $param[':NGAYHOP'] = $_POST['meeting-date'];
        $phQuery = oneRow('select * from lichhop where NGAYHOP = :NGAYHOP', $param);
        if ($phQuery['BUOIHOP'] == $_POST['meeting-time'] &&  $phQuery['PHONGHOP'] == $_POST['meeting-room']) {
            setFlashData('smg', 'Phòng họp đã được đặt lịch, vui lòng chọn khung giờ hoặc phòng họp khác !');
            setFlashData('smg_type', 'danger');
        } else {
            $data = [
                'NGAYHOP' => $_POST['meeting-date'],
                'BUOIHOP' => $_POST['meeting-time'],
                'PHONGHOP' => $_POST['meeting-room'],
                'PHONGBAN' => $_POST['meeting-content'],
                'CREATE_AT' => date("Y-m-d H:i:s")
            ];
            $insertStatus = insert('lichhop', $data);
            if ($insertStatus) {
                setFlashData('smg', 'Thêm thành công !!');
                setFlashData('smg_type', 'success');
            } else {
                setFlashData('smg', 'Hệ thống lỗi !!');
                setFlashData('smg_type', 'danger');
            }
        }
    }
}

$smg = getFlashData('smg');
$smg_data = getFlashData('smg_type');




$listPH = getRow('select * from lichhop order by CREATE_AT desc');
?>


<div class="my-content">
    <div class="my-body fixed-top p-3">
        <div class="container">
            <div class="">
                <form action="" class="col-12" method="post">
                    <h3>Đăng ký lịch họp</h3>
                    <div class="row mt-4 lichhop-form">
                        <div class="col-2">
                            <label for="meeting-date" class="h6">Ngày họp:</label>
                            <br>
                            <input type="date" id="meeting-date" name="meeting-date" class="mt-1">
                            <br>
                        </div>
                        <div class="col-2">
                            <label for="meeting-time" class="h6">Buổi họp:</label>
                            <select class="form-control mt-1" id="meeting-time" name="meeting-time">
                                <option value="">Chọn buổi họp</option>
                                <option value="Sáng">Sáng</option>
                                <option value="Chiều">Chiều</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <label for="meeting-room" class="h6">Phòng họp:</label>
                            <select class="form-control mt-1" id="meeting-room" name="meeting-room">
                                <option value="">Chọn phòng họp</option>
                                <option value="PH1">Phòng PH1</option>
                                <option value="PH2">Phòng PH2</option>
                                <option value="PH3">Phòng PH3</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <label for="meeting-content" class="h6">Phòng ban đăng ký:</label>
                            <input type="text" name="meeting-content" id="meeting-content" class="form-control mt-1">
                        </div>
                        <div class="col-4"><?php echo getSmg($smg, $smg_data); ?></div>
                    </div>
                    <button type="submit" class="my-btn btn btn-warning w-25 m-auto mt-4 col-2">Đăng ký</button>
                    <a class="btn m-auto w-25 btn-dark col-2 mt-4" href="?module=lichhop&action=lichhop">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Hủy
                    </a>
                </form>
            </div>

            <div class="my-table-lh overflow-scroll mt-4">
                <table class="table">
                    <thead>
                        <tr class="table-dark my-header-table">
                            <th>Ngày họp</th>
                            <th>Buổi họp</th>
                            <th>Phòng họp</th>
                            <th>Phòng ban đăng ký</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($listPH)) :
                            foreach ($listPH  as $PH) :
                        ?>
                                <tr class="my-tr">
                                    <td><?php echo $PH['NGAYHOP'] ?></td>
                                    <td><?php echo $PH['BUOIHOP'] ?></td>
                                    <td><?php echo $PH['PHONGHOP'] ?></td>
                                    <td><?php echo $PH['PHONGBAN'] ?></td>
                                    <td><a href="?module=lichhop&action=delete&id=<?php echo $PH['MALICH']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><i class="fa-solid fa-trash-can" style="color: #000000;"></i></a></td>
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
