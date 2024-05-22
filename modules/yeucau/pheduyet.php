<?php
$id = $_GET['id'];
if ($id) {
    $tbQuery = getRow("select * from yeucau where MAYC=$id");
    $data['TRANGTHAI'] = 1;
    if (!empty($tbQuery)) {
        update('yeucau', $data, "MAYC = $id");
    }
}
header('Location: ?module=yeucau&action=yeucauNS');
