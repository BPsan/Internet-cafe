<?php
session_start();
date_default_timezone_set('Europe/Moscow');
if( (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 1440)) || (!isset($_SESSION['id'])) ){
    $_SESSION = [];
    header('Location: index.php');
}else{
    $_SESSION['start'] = time();
}
date_default_timezone_set('Europe/Moscow');

require_once('helpers.php');
$role = 1;
$link_css = ["css/edit.css", "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"];
$errors = [
    [
        'error_name' => "Пустое поле имени",
        'error_status' => FALSE
    ],
    [
        'error_name' => "Почта введена некорректно",
        'error_status' => FALSE
    ],
    [
        'error_name' => "Аккаунт с такой почтой уже существует",
        'error_status' => FALSE
    ],
    [
        'error_name' => "Телефон введен некорректно",
        'error_status' => FALSE
    ],
    [
        'error_name' => "Аккаунт с таким номером уже существует",
        'error_status' => FALSE
    ],
    [
        'error_name' => "Старый пароль введён неверно",
        'error_status' => FALSE
    ],
    [
        'error_name' => "Пустое поле нового пароля",
        'error_status' => FALSE
    ]
];
$con = mysqli_connect("localhost", "root", "","Cafe");
mysqli_set_charset($con, "utf8");
$sql="SELECT Email, Telephone FROM user";
$result_user = mysqli_query($con,$sql);
$user_rows = mysqli_fetch_all($result_user, MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $user_name = $_POST['user_name'];
    if($user_name == NULL){
        $errors[0]['error_status'] = TRUE;
    }

    $phone = $_POST['phone'];
    $email = $_POST['email'];
    
    if($email == NULL || (!filter_var($email,FILTER_VALIDATE_EMAIL))){
        $errors[1]['error_status'] = TRUE;
    }else{
        foreach($user_rows as $key => $item){
            if($email == $item['Email'] && $email != $_SESSION['email']){
                
                $errors[2]['error_status'] = TRUE;
            }
            if($phone == $item['Telephone'] && $phone != $_SESSION['phone']){
                $errors[4]['error_status'] = TRUE;
            }
        }
    }
    if($phone == NULL || !preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10}$/", $phone)){
        $errors[3]['error_status'] = TRUE;
    }

    $password_old = $_POST['password_old'];
    $password_new = $_POST['password_new'];

    if($password_old != NULL && $password_old != $_SESSION['password']){
        $errors[5]['error_status'] = TRUE;
    }
    if($password_new == NULL && $password_old != NULL && $password_old == $_SESSION['password']){
        $errors[6]['error_status'] = TRUE;
    }
    if($password_new == NULL && $password_old == NULL){
        $password_new = $_SESSION['password'];
    }

    if($errors[0]['error_status'] === FALSE && $errors[1]['error_status'] === FALSE && $errors[2]['error_status'] === FALSE && $errors[3]['error_status'] === FALSE && $errors[4]['error_status'] === FALSE && $errors[5]['error_status'] === FALSE && $errors[6]['error_status'] === FALSE){
        $passwordHash = password_hash($password_new, PASSWORD_DEFAULT);
        $sql=("UPDATE user SET Name = ?, Email  = ?, Telephone  = ?, Password = ?, Role_id = ? WHERE Id = ?");
        $_SESSION['name'] = $user_name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['password'] = $password_new;
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssii', $user_name, $email, $phone, $passwordHash, $role, $_SESSION['id']);
        $res = mysqli_stmt_execute($stmt);
        header('Location: profil.php');
    }
}

$main_content = include_template('edit_user.php', ['errors' => $errors, 'user_name' => $_SESSION['name'], 'email' => $_SESSION['email'], 'phone' => $_SESSION['phone']]);
if(isset($_SESSION['id'])){
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css, 'start' => $_SESSION['id'], 'role' => $_SESSION['role']]);
}else{
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css]);
}
print($layout_content);