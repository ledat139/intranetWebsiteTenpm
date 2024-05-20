<?php
$info = [
    'title' => 'DashBoard'
];
if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}
layouts('header', $info);
//check login
$listEmp = getRow('select * from nhanvien');
?>
<div class="my-content">
    <div class="my-body fixed-top container">

    </div>
</div>
</body>
<?php
layouts('footer', $info);
