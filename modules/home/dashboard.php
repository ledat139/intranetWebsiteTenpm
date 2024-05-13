<?php
$info = [
    'title' => 'DashBoard'
];
if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}
layouts('header', $info);
//check login


?>


<div class="my-content">

</div>

</body>
<?php
layouts('footer', $info);
