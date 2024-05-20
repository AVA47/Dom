<?php
session_start();
require_once '../core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = ($_POST['password']);
    $confirm_password = ($_POST['confirm_password']);
    $user_type = $_POST['user_type'];

    if ($password === $confirm_password) {
        $insert_user_query = "INSERT INTO `users` (`login`, `type`, `password`) VALUES ('$login', '$user_type', '$password')";
        $result = mysqli_query($link, $insert_user_query);

        if ($result) {
            $_SESSION['message'] = 'Пользователь успешно зарегистрирован';
            header('Location: auto.php');
        } else {
            $_SESSION['message'] = 'Ошибка при регистрации пользователя';
            header('Location: reg.php');
        }
    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: reg.php');
    }
} else {
    // Если запрос не является POST, перенаправляем на страницу регистрации
    header('Location: reg.php');
}
