<?php
$id = $_GET['id'];
if ($id) {
    $lhQuery = getRow("select * from lichhop where MALICH=$id");
    if (!empty($lhQuery)) {
        delete('lichhop', "MALICH=$id");
    }
}
header('Location: ?module=lichhop&action=lichhop');
