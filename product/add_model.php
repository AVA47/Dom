<?php
session_start();
include '../core.php';

function addModelToDatabase($model)
{
    global $link;

    $sql = "INSERT INTO `models` (`model`) VALUES (?)";

    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $model);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['add_model'])) {
    $model = $_POST['model'];

    if (addModelToDatabase($model)) {
        $_SESSION['success_message_model'] = "Вид товара успешно добавлен в базу данных.";
    } else {
        $_SESSION['error_message_model'] = "Ошибка при добавлении вида товара: " . $link->error;
    }
}

header("Location: admin_panel.php");
exit();
