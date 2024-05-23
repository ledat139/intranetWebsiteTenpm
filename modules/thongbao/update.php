<?php
$info = [
    'title' => 'Thông báo'
];
//check login
if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}

$param[':MATB'] = $_GET['id'];
$oldData = oneRow('select * from thongbao where MATB = :MATB', $param);
if (empty($oldData)) {
    header('Location: ?module=thongbao&action=list');
}
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
            'CHUDETB' => $_POST['title'],
            'NOIDUNGTB' => $_POST['content'],
            'CREATE_AT' => date("Y-m-d")
        ];
        $oldData['CHUDETB'] = $_POST['title'];
        $oldData['NOIDUNGTB'] = $_POST['content'];
        $oldData['CREATE_AT'] = date("Y-m-d");
        $MATB = $_GET['id'];
        $updateStatus = update('thongbao', $data, "MATB = $MATB");

        if ($updateStatus) {
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




$listTB = getRow('select * from thongbao');
?>


<div class="my-content">
    <div class="my-tb-body1 fixed-top p-3">
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

    <div class="my-tb-body2 fixed-top p-3">
        <div class="overflow-auto my-tb-content">
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($listTB as $tb) : ?>
                    <div class="card " style="width: 15rem;">
                        <h5 class="card-header text-bg-dark"> <?php echo $tb['CHUDETB'] ?> </h5>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo date("d-m-Y H:i", strtotime($tb['CREATE_AT'])) ?></h6>
                            <p class="card-text"> <?php echo $tb['NOIDUNGTB'] ?></p>
                            <a href="?module=thongbao&action=update&id=<?php echo $tb['MATB']; ?>" class="btn btn-dark"><i class="fa-solid fa-pen-to-square" style="color: #FFF;"></i></a>
                            <a href="?module=thongbao&action=delete&id=<?php echo $tb['MATB']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><i class="fa-solid fa-trash-can" style="color: #000000;"></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <div class="my-addtb-form fixed-top">
        <form action="" method="post" class="mt-3 col-11 mt-4 m-auto">
            <h4 class="text-uppercase">Cập nhật thông báo</h4>
            <div class="col">
                <label for="title" class="mt-4 h6">Chủ đề thông báo:</label>
                <input type="title" class="form-control" placeholder="Chủ đề thông báo" id="title" name="title" value="<?php echo $oldData['CHUDETB'] ?>">
                <label for="content" class="mt-4 h6">Nội dung:</label>
                <textarea class="form-control" id="content" name="content" rows="3"><?php echo $oldData['NOIDUNGTB'] ?></textarea>
            </div>
            <div class="mt-4 mb-3">
                <button class="btn text-white" type="submit" style="background-color: rgb(8, 49, 198);">
                    <i class="fa-solid fa-user-plus" style="color: #ffffff;"></i>
                    Cập nhật thông báo
                </button>
                <a class="btn btn-dark" href="?module=thongbao&action=list">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Hủy
                </a>
            </div>
            <?php echo getSmg($smg, $smg_data); ?>
        </form>
    </div>

    <div class="fixed-top my-footer-tb d-flex justify-content-center align-items-center">
        <i class="fa-regular fa-copyright" style="color: #000;"></i>
        <p class="copy-right">Copyright 2024 by Tenpm</p>
    </div>
</div>
</body>
<?php
layouts('footer', $info);
