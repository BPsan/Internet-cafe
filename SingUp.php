<?php
require_once('helpers.php');
$role = 1;
$link_css = ["css/reg.css", "css/login.css", "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"];
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
        'error_name' => "Пустое поле пароля",
        'error_status' => FALSE
    ]
];
$con = mysqli_connect("localhost", "root", "","Cafe");
mysqli_set_charset($con, "utf8");
$sql="SELECT Email, Telephone FROM user";
$result = mysqli_query($con,$sql);
$user_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);  

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
            if($email == $item['Email']){
                $errors[2]['error_status'] = TRUE;
            }
            if($phone == $item['Telephone']){
                $errors[4]['error_status'] = TRUE;
            }
        }
    }
    if($phone == NULL || !preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10}$/", $phone)){
        $errors[3]['error_status'] = TRUE;
    }

    $password = $_POST['password'];
    if($password == NULL){
        $errors[5]['error_status'] = TRUE;
    }

    if($errors[0]['error_status'] === FALSE && $errors[1]['error_status'] === FALSE && $errors[2]['error_status'] === FALSE && $errors[3]['error_status'] === FALSE && $errors[4]['error_status'] === FALSE && $errors[5]['error_status'] === FALSE){
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql=("INSERT INTO user (Name, Email, Telephone, Password, Role_id) VALUES (?, ?, ?, ?, ?)");
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $user_name, $email, $phone, $passwordHash, $role);
        mysqli_stmt_execute($stmt);
        header('Location: index.php');
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $main_content = include_template('registration.php', ['errors' => $errors, 'user_name' => $user_name, 'email' => $email, 'phone' => $phone]);
}else{
    $main_content = include_template('registration.php', ['errors' => $errors]);
}
if(isset($_SESSION['id'])){
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css, 'start' => $_SESSION['id'], 'role' => $_SESSION['role']]);
}else{
    $layout_content = include_template('layout.php', ['content' => $main_content,  'link_css' => $link_css]);
}
print($layout_content);