<?php
session_start();
date_default_timezone_set('Europe/Moscow');
if( (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 1440)) || (!isset($_SESSION['id'])) ){
    $_SESSION = [];
    header('Location: index.php');
}else{
    $_SESSION['start'] = time();
}
$error = TRUE;
$con = mysqli_connect("localhost", "root", "","cafe");
mysqli_set_charset($con, "utf8");
require_once('helpers.php');

$id = 1;
$sql = "SELECT * FROM Booking WHERE User_Id = ? ORDER BY Active DESC";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$booking_user = mysqli_fetch_all($result, MYSQLI_ASSOC);
$link_css = ["css/story_booking.css", "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"];

$main_content = include_template('story_booking.php', ['booking_user' => $booking_user, 'id' => $id]);
if(isset($_SESSION['id'])){
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css, 'start' => $_SESSION['id'], 'role' => $_SESSION['role']]);
}else{
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css]);
}

print($layout_content);
