<?php
$id = $_GET['id'];
if ($id) {
    $tbQuery = getRow("select * from thongbao where MATB=$id");
    if (!empty($tbQuery)) {
        delete('thongbao', "MATB=$id");
    }
}
header('Location: ?module=thongbao&action=list');
