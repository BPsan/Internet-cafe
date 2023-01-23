<?php
session_start();
date_default_timezone_set('Europe/Moscow');
if( (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 1440)) || (!isset($_SESSION['id'])) ){
    $_SESSION = [];
    header('Location: index.php');
}else{
    $_SESSION['start'] = time();
}
$con = mysqli_connect("localhost", "root", "","cafe");
mysqli_set_charset($con, "utf8");
require_once('helpers.php');

$link_css = ["css/post.css"];
$errors = [
    [
        'name_error' => 'Пустой заголовок',
        'status' => false
    ],
    [
        'name_error' => 'Пустое содержание',
        'status' => false
    ]
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    if ($title == null) {
        $errors[0]['status'] = true;
    }
    $body = $_POST['body'];
    if ($body == null) {
        $errors[1]['status'] = true;
    }

    $date = date('d.m.Y',time());

    $file_name = $_FILES['file']['name'];
    $file_path = __DIR__ . '\img/';
    $file_url = '' . $file_name;

    if ($errors[0]['status'] == false && $errors[1]['status'] == false) {
        $file_post = move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $file_name);
        $sql = "INSERT INTO Post (Title, Body, Date, Img, User_Id) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $title, $body, $date, $file_url, $_SESSION['id']);
        mysqli_stmt_execute($stmt);
        header('Location: index.php');
    }
}
$main_content = include_template('postnew.php', ['errors' => $errors]);
if(isset($_SESSION['id'])){
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css, 'start' => $_SESSION['id'], 'role' => $_SESSION['role']]);
}else{
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css]);
}
print($layout_content);