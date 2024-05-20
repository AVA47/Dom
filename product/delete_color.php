<?php
session_start();
include '../core.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $colorsId = $_GET['id'];
    $sql = "DELETE FROM `colors` WHERE `id` = $colorsId";
    if ($link->query($sql) === TRUE) {
        $_SESSION['success_message_color'] = "Цвет успешно удален.";
    } else {
        $_SESSION['error_message_color'] =  "Ошибка при удалении цвета: " . $link->error;
    }
    header("Location: admin_panel.php"); // Переадресация обратно на страницу admin_panel.php
    exit();
} else {
    $_SESSION['error_message1'] = "Неверный запрос.";
    header("Location: admin_panel.php");
    exit();
}
