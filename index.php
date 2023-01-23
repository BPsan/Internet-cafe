<?php
session_start();
date_default_timezone_set('Europe/Moscow');
if( (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 1440)) || (!isset($_SESSION['id'])) ){
    $_SESSION = [];
}else{
    $_SESSION['start'] = time();
}
;

require_once('helpers.php');

$con = mysqli_connect("localhost", "root", "","cafe");
mysqli_set_charset($con, "utf8");

$sql = "SELECT * FROM Post";
$result_posts = mysqli_query($con,$sql);
$post_rows = mysqli_fetch_all($result_posts, MYSQLI_ASSOC);
$link_css = ["css/main.css"];

$main_content = include_template('main.php', ['posts' => $post_rows, 'role' => $_SESSION['role']]);
if(isset($_SESSION['id'])){
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css, 'start' => $_SESSION['id'], 'role' => $_SESSION['role']]);
}else{
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css]);
}
print($layout_content);