<?php
$id = $_GET['id'];
if ($id) {
    $userQuery = getRow("select * from nhanvien where MANV=$id");
    if (!empty($userQuery)) {
        $tokenStatus = delete('tokenlogin', "MANV=$id");
        if ($tokenStatus) {
            delete('nhanvien', "MANV=$id");
        }
    }
}
header('Location: ?module=nhanvien&action=list');
