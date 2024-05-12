<!-- Đăng xuất -->
<?php
if (getSession('tokenLogin')) {
    $token = getSession('tokenLogin');
    delete('tokenlogin', "token = '$token'");
    removeSession('tokenLogin');
    header('Location: ?module=auth&action=login');
}
