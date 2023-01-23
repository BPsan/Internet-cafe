<?php
session_start();
date_default_timezone_set('Europe/Moscow');
$con = mysqli_connect("localhost", "root", "","cafe");
mysqli_set_charset($con, "utf8");
require_once('helpers.php');

$link_css = ["css/login.css", "css/reg.css", "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"];

$errors = [
    [
        'error_name' => "Неверная почта или пароль",
        'error_status' => TRUE
    ],
    [
        'error_name' => "Необходимо ввести все данные",
        'error_status' => FALSE
    ]
];
$sql_users = ("SELECT * FROM User");
$all_users = mysqli_query($con, $sql_users);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($email == NULL || $password == NULL){
        $errors[0]['error_status'] = FALSE;
        $errors[1]['error_status'] = TRUE;
    }else{
        foreach ($all_users as $key => $item) {
            if ($email == $item['Email'] && (password_verify($password, $item['Password']))) {
                $errors[0]['error_status'] = FALSE;
                $_SESSION['id'] = $item['Id'];
                $_SESSION['name'] = $item['Name'];
                $_SESSION['phone'] = $item['Telephone'];
                $_SESSION['password'] = $password;
                $_SESSION['email'] = $item['Email'];
                $_SESSION['start'] = time();
                $_SESSION['role'] = $item['Role_id'];
                break;
            }
        }
    }
    if ($errors[0]['error_status'] == FALSE && $errors[1]['error_status'] == FALSE) {
        header('Location: index.php');
    }
}

$main_content = include_template('login.php', ['errors' => $errors]);
$layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css]);
print($layout_content);