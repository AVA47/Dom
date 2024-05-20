<?php
session_start();
include '../core.php';

function addColorToDatabase($color)
{
    global $link;

    $sql = "INSERT INTO `colors` (`color`) VALUES (?)";

    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $color);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['add_color'])) {
    $color = $_POST['color'];

    if (addColorToDatabase($color)) {
        $_SESSION['success_message_color'] = "Цвет успешно добавлен в базу данных.";
    } else {
        $_SESSION['error_message_color'] = "Ошибка при добавлении цвета: " . $link->error;
    }
}

header("Location: admin_panel.php");
exit();
