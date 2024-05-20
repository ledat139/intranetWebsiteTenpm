<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['title']) ? $data['title'] : 'Quản lý người dùng' ?></title>
    <link rel="stylesheet" href="templates/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js">
    <link rel="stylesheet" href="templates/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="my-body">
    <div class="d-flex flex-column flex-shrink-0 p-3 fixed-top my-sidebar" style="width: 280px; height:96vh ">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto my-logo text-decoration-none">
            <i class="fa-solid fa-building" style="color: #2d4d86;"></i>
            <span class="fs-4">TENPM COMPANY</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="?module=home&action=dashboard" class="nav-link text-dark">
                    <i class="fa-solid fa-house" style="color: #000000;"></i>
                    Trang chủ
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-dark">
                    <i class="fa-solid fa-bell" style="color: #000000;"></i>
                    Thông báo
                </a>
            </li>
            <li>
                <a href="?module=nhanvien&action=list" class="nav-link text-dark">
                    <i class="fa-solid fa-user-tie" style="color: #000000;"></i>
                    Nhân viên
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-dark">
                    <i class="fa-solid fa-hand" style="color: #000000;"></i>
                    Yêu cầu
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-dark">
                    <i class="fa-solid fa-building" style="color: #000000;"></i>
                    Phòng họp
                </a>
            </li>
        </ul>
        <hr>
        <a href=" ?module=auth&action=logout" class="btn btn-dark me-2 ">Đăng xuất <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i></a>
    </div>