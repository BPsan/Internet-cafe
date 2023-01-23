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

$post_id = $_GET['post'] ?? NULL;
if($post_id == NULL){
    header('Location: index.php');
}


$sql = "SELECT * FROM Post WHERE Id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $post_id);
mysqli_stmt_execute($stmt);
$res_post = mysqli_stmt_get_result($stmt) ->fetch_row();

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

    $file_name = $_FILES['file']['name'];
    if($file_name != NULL){
        $file_path = __DIR__ . '\img/';
        $file_url = '' . $file_name;
    }else{
        $file_url = $res_post[4];
    }

    if ($errors[0]['status'] == false && $errors[1]['status'] == false) {
        if(isset($file_name)){
            $file_post = move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $file_name);
        }
        $sql=("UPDATE Post SET Title = ?, Body = ?, Img = ? WHERE Id = ?");
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'sssi', $title, $body, $file_url, $post_id);
        $res = mysqli_stmt_execute($stmt);
        // if($res) {
        //     echo 'Прокатило;';
        // } else {
        //     printf("Сообщение ошибки: %s\n", mysqli_error($con));
        // }
        header('Location: index.php');
    }
}
$main_content = include_template('postEditor.php', ['res_post' => $res_post, 'post_id' => $post_id]);
if(isset($_SESSION['id'])){
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css, 'start' => $_SESSION['id'], 'role' => $_SESSION['role']]);
}else{
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css]);
}
print($layout_content);