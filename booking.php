<?php
session_start();
date_default_timezone_set('Europe/Moscow');
if( (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 14400)) || (!isset($_SESSION['id'])) ){
    $_SESSION = [];
    header('Location: index.php');
}else{
    $_SESSION['start'] = time();
}
$con = mysqli_connect("localhost", "root", "","cafe");
mysqli_set_charset($con, "utf8");
require_once('helpers.php');

$link_css = ["https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css", "css/booking.css"];
$errors = [
    [
        'name_error' => 'Выберете время',
        'status' => false
    ],
    [
        'name_error' => 'Начало брони не должно быть раньше текущей',
        'status' => false
    ],
    [
        'name_error' => 'Конец брони не должно быть раньше начала брони',
        'status' => false
    ],
    [
        'name_error' => 'Время брони дожно быть больше 20 минут',
        'status' => false
    ],
    [
        'name_error' => 'Время брони дожно быть меньше 3 часов',
        'status' => false
    ],
    [
        'name_error' => 'У вас уже есть активная бронь',
        'status' => false
    ]
];

$sql=("SELECT Active FROM Booking WHERE User_Id = ? && Active = 1");
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$active_booking = mysqli_fetch_all($result, MYSQLI_ASSOC);

if(sizeof($active_booking)){
    $errors[5]['status'] = TRUE;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[5]['status'] == FALSE) {
    if($_POST['date_from'] == NULL || $_POST['date_do'] == NULL){
        $errors[0]['status'] = TRUE;
        $main_content = include_template('booking_date.php', ['errors' => $errors, 'dateFrom' => $_POST['date_from'], 'dateDo' => $_POST['date_do']]);
    }else if(date('d.m.Y H:i', strtotime($_POST['date_from'])) < date('d.m.Y H:i', time())){
        $errors[1]['status'] = TRUE;
        $main_content = include_template('booking_date.php', ['errors' => $errors, 'dateFrom' => $_POST['date_from'], 'dateDo' => $_POST['date_do']]);
    }else if(date('d.m.Y H:i', strtotime($_POST['date_from'])) > date('d.m.Y H:i', strtotime($_POST['date_do']))){
        $errors[2]['status'] = TRUE;
        $main_content = include_template('booking_date.php', ['errors' => $errors, 'dateFrom' => $_POST['date_from'], 'dateDo' => $_POST['date_do']]);
    }else if((strtotime($_POST['date_do']) - strtotime($_POST['date_from']))/60 < 20){
        $errors[3]['status'] = TRUE;        
        $main_content = include_template('booking_date.php', ['errors' => $errors, 'dateFrom' => $_POST['date_from'], 'dateDo' => $_POST['date_do']]);
    }else if((strtotime($_POST['date_do']) - strtotime($_POST['date_from']))/60 > 180){
        $errors[4]['status'] = TRUE;        
        $main_content = include_template('booking_date.php', ['errors' => $errors, 'dateFrom' => $_POST['date_from'], 'dateDo' => $_POST['date_do']]);
    }else{
        $date_from = date('Y-m-d H:i:s', strtotime($_POST['date_from']));
        $date_do = date('Y-m-d H:i:s', strtotime($_POST['date_do'])); 
        //print((strtotime($_POST['date_do']) - strtotime($_POST['date_from']))/60 < 20);

        $sql = ("SELECT * FROM Computer");
        $result = mysqli_query($con, $sql);
        $all_computer = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $sql=("SELECT DISTINCT Computer_Id FROM Booking WHERE ? BETWEEN Date_start AND Date_end OR ? BETWEEN Date_start AND Date_end OR Date_start BETWEEN ? AND ? OR Date_end BETWEEN ? AND ?");
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssss', $date_from, $date_do, $date_from, $date_do, $date_from, $date_do);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $busy_computer = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $busy = [];
        foreach($busy_computer as $item){
            array_push($busy, $item['Computer_Id']);
        }
        
        $formula = ceil((strtotime($_POST['date_do']) - strtotime($_POST['date_from']))/3600);
        $main_content = include_template('booking_place.php', ['errors' => $errors, 'dateFrom' => $_POST['date_from'], 'dateDo' => $_POST['date_do'], 'busy' => $busy, 'all_computer' => $all_computer, 'formula' => $formula]);
        
        if($_POST['computer'] != NULL){
            $price = $formula * $all_computer[$_POST['computer']-1]['Rate'];
            $sql=("INSERT INTO Booking (Date_start, Date_end, Price, Computer_Id, User_Id) VALUES (?, ?, ?, ?, ?)");
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 'ssiii', $date_from, $date_do, $price, $_POST['computer'], $_SESSION['id']);
            mysqli_stmt_execute($stmt);
            header('Location: profil.php');
        }
    }
}else{
    $main_content = include_template('booking_date.php', ['errors' => $errors]);
}

if(isset($_SESSION['id'])){
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css, 'start' => $_SESSION['id'], 'role' => $_SESSION['role']]);
}else{
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css]);
}
print($layout_content);