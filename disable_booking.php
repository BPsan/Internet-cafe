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

$booking_id = $_GET['id'] ?? NULL;
if($booking_id == NULL){
    header('Location: index.php');
}
require_once('helpers.php');

$link_css = ["css/confirm.css", "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_GET['choice'] == "yes"){
        $sql = ("UPDATE Booking SET Active = 0 WHERE Id = ?;");
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $booking_id);
        mysqli_stmt_execute($stmt);
        header('Location: Story.php');
    }else if($_GET['choice'] == "no"){
        header('Location: Story.php');
    }
}

$main_content = include_template('booking_confirm.php', ['booking_id' => $booking_id]);
if(isset($_SESSION['id'])){
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css, 'start' => $_SESSION['id'], 'role' => $_SESSION['role']]);
}else{
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css]);
}
print($layout_content);