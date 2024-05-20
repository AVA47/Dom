<?php
include '../core.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $productId = $_GET['id'];
    $sql = "DELETE FROM `products` WHERE `id` = $productId";
    if ($link->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Товар успешно удален.";
        // Перенаправление на страницу admin_panel.php
        header("Location: admin_panel.php");
        exit; // Важно завершить выполнение скрипта после перенаправления
    } else {
        $_SESSION['error_message'] =  "Ошибка при удалении товара: " . $link->error;
    }
} else {
    $_SESSION['error_message'] = "Неверный запрос.";
    // Перенаправление на страницу admin_panel.php
    header("Location: admin_panel.php");
    exit; // Важно завершить выполнение скрипта после перенаправления
}
