<?php
session_start();
include '../core.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $modelsId = $_GET['id'];
    $sql = "DELETE FROM `models` WHERE `id` = $modelsId";
    if ($link->query($sql) === TRUE) {
        $_SESSION['success_message_model'] = "Вид товара успешно удален.";
    } else {
        $_SESSION['error_message_model'] =  "Ошибка при удалении вида товара: " . $link->error;
    }
    header("Location: admin_panel.php"); // Переадресация обратно на страницу admin_panel.php
    exit();
} else {
    $_SESSION['error_message1'] = "Неверный запрос.";
    header("Location: admin_panel.php");
    exit();
}
