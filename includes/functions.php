<!-- Các hàm dùng chung của project -->
<?php
function layouts($layout, $data = [])
{
    require_once('templates/layout/' . $layout . '.php');
}






function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
        return true;
    else return false;
}

function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
        return true;
    else return false;
}

//ham Filter loc du lieu
function filter()
{
    $filterArr = [];
    if (isGet()) {
        //xử lý dữ liệu trước khi được hiển thị ra
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                $filterArr = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }

    if (isPost()) {
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $filterArr = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }
    return $filterArr;
}

//kiểm tra email
function isEmail($email)
{
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}
// hàm kiểm tra kiểu số nguyên INT
function isInteger($number)
{
    $checkInt = filter_var(
        $number,
        FILTER_VALIDATE_INT
    );
    return $checkInt;
}
// hàm kiểm tra kiểu số thực
function isFloat($number)
{
    $checkFloat = filter_var(
        $number,
        FILTER_VALIDATE_FLOAT
    );
    return $checkFloat;
}
// hàm kiểm tra kiểu số đt
function isPhoneNumber($number)
{
    return $number[0] == '0' and strlen($number) == 10;
}

//Thông báo lỗi
function getSmg($smg, $type)
{
    echo '<div class="alert alert-' . $type . '">';
    echo $smg;
    echo '</div>';
}

//check login
function isLogin()
{
    $checkLogin = false;
    if (!empty(getSession('tokenLogin'))) {
        $param = [
            ':token' => getSession('tokenLogin')
        ];
        $tokenQuery = oneRow('SELECT user_id FROM tokenlogin WHERE token = :token', $param);
        if (!empty($tokenQuery)) {
            $checkLogin = true;
        } else {
            removeSession('tokenLogin');
        }
    }
    return  $checkLogin;
}
