<?php
session_start();
require "core.php";

// Проверяем, авторизован ли пользователь и имеет ли он тип 2
if ($_SESSION['user'] && $_SESSION['user']['type'] == 2) {

    // Получаем данные из формы
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Подготавливаем SQL-запрос для вставки данных
    $sql = "INSERT INTO `message` (`name`, `email`, `message`) VALUES ('$name', '$email', '$message')";

    // Выполняем SQL-запрос
    if ($link->query($sql) === TRUE) {
        echo "Сообщение успешно отправлено";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $link->error;
    }

    // Закрываем соединение с базой данных
    $link->close();
} else {
    // Если пользователь не авторизован или не имеет тип 2
    echo "Права есть только у обычного пользователя, ВЫ - администратор";
}
