<!-- Hàm liên quan đến session hay cookies -->
<?php
function setSession($key, $value)
{
    return $_SESSION[$key] = $value;
}
// ham doc session
function getSession($key = '')
{
    if (empty($key)) {
        return $_SESSION;
    } else if (isset($_SESSION[$key]))
        return $_SESSION[$key];
}

//ham xoa session
function removeSession($key)
{
    if (empty($key)) {
        session_destroy();
        return true;
    } else if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
        return true;
    }
}
//hàm gán flash data
function setFlashData($key, $value)
{
    $key = '_flash' . $key;
    return setSession($key, $value);
}
// hàm đọc flash data
function getFlashData($key)
{
    $key = '_flash' . $key;
    $data = getSession($key);
    removeSession($key);
    return $data;
}
