<?php
$info = [
    'title' => 'DashBoard'
];
layouts('header', $info);
//check login

if (isLogin() == false) {
    header('Location: ?module=auth&action=login');
}
?>

<body>
    <h1>dashboard</h1>
    <?php
    layouts('footer', $info);
