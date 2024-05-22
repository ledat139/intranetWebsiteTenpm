<?php
$info = [
    'title' => 'Thông báo'
];
//check login
if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$thisId = getSession('id');
$userQuery = getRow("select * from nhanvien where MANV = $thisId");
if ($userQuery['0']['PHONGBAN'] == 'Nhân sự') {
    layouts('headerNS', $info);
} else {
    layouts('headerEmp', $info);
}

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
            'CHUDETB' => $_POST['title'],
            'NOIDUNGTB' => $_POST['content'],
            'CREATE_AT' => date("Y-m-d H:i:s")
        ];
        $insertStatus = insert('thongbao', $data);
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

$listTB = getRow('select * from thongbao order by CREATE_AT desc');








?>


<div class="my-content">
    <div class="my-tb-body1nv fixed-top p-3">
        <div class=" mt-1">
            <h3 class="mt-1">Thông báo</h3>
        </div>
        <div class="col-12 mt-4">
            <?php
            $currentDate = date("m-d");
            $nvList = getRow('select * from nhanvien');
            foreach ($nvList as $nv) {
                $userBirthday = $nv['NGAYSINH'];
                $userBirthdayObj = new DateTime($userBirthday);
                $currentDate = new DateTime();
                if ($userBirthdayObj->format("m-d") == $currentDate->format("m-d")) : ?>
                    <div class="d-flex mt-3">
                        <img src="templates/img/birthday.png" alt="" style="width:24px; height:24px">
                        <p class="mx-2 fw-semibold">Hôm nay là sinh nhật của </p>
                        <p class="text-danger fw-semibold"><?php echo $nv['HOTEN'] ?></p>
                        <p class="mx-2 fw-semibold">,nhân viên phòng</p>
                        <p class="text-danger fw-semibold"><?php echo $nv['PHONGBAN'] ?></p>
                        <div class="img-table1" style="margin-left: auto"><img src="<?php echo $nv['FILEPATH'] ?>" alt="" class="profile-table1"></div>
                    </div>
            <?php endif;
            }
            ?>
        </div>


    </div>

    <div class="my-tb-body2nv fixed-top p-3">
        <div class="overflow-auto my-tb-content">
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($listTB as $tb) : ?>
                    <div class="card " style="width: 15rem;">
                        <h5 class="card-header text-bg-dark"> <?php echo $tb['CHUDETB'] ?> </h5>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo date("d-m-Y H:i", strtotime($tb['CREATE_AT'])) ?></h6>
                            <p class="card-text"> <?php echo $tb['NOIDUNGTB'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
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
