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

$link_css = ["css/user.css", "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"];

$main_content = include_template('user.php', ['sessia' => $_SESSION]);
if(isset($_SESSION['id'])){
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css, 'start' => $_SESSION['id'], 'role' => $_SESSION['role']]);
}else{
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css]);
}
print($layout_content);