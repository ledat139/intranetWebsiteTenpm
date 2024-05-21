<?php
$id = $_GET['id'];
if ($id) {
    $tbQuery = getRow("select * from yeucau where MAYC=$id");
    if (!empty($tbQuery)) {
        delete('yeucau', "MAYC=$id");
    }
}
header('Location: ?module=yeucau&action=yeucauNV');
