<?php
session_start();
require_once '../core.php';

$login = $_POST['login'];
$password = ($_POST['password']);

$check_user = mysqli_query($link, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

if ($check_user) {
    if (mysqli_num_rows($check_user) > 0) {
        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "type" => $user['type'],
        ];

        if ($user['type'] == 1) {
            // Redirect to admin panel for admin user
            header('Location: ../product/admin_panel.php');
        } elseif ($user['type'] == 2) {
            // Redirect to user dashboard for regular user
            header('Location: ../index.php');
        } else {
            // Handle unknown user type
            $_SESSION['message'] = '<br/> Неизвестный тип пользователя';
            header('Location: auto.php');
        }
    } else {
        $_SESSION['message'] = '<br/> Неверный логин или пароль';
        header('Location: auto.php');
    }
} else {
    // Handle database query error
    $_SESSION['message'] = '<br/> Ошибка при выполнении запроса к базе данных';
    header('Location: auto.php');
}
