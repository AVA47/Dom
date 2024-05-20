<?php
session_start();

include '../core.php';

function updateProduct($link, $productId, $name, $price, $razmer, $material, $img, $descriptions)
{
    $sql = "UPDATE `products` SET `name` = ?, `price` = ?, `razmer` = ?, `material` = ?, ";
    // Если изображение было загружено, добавляем его в запрос
    if (!empty($img)) {
        $sql .= "`img` = ?, ";
    }
    $sql .= "`descriptions` = ? WHERE `id` = ?";

    $stmt = $link->prepare($sql);
    // Если изображение было загружено, привязываем его к параметрам
    if (!empty($img)) {
        $stmt->bind_param("ssssssi", $name, $price, $razmer, $material, $img, $descriptions, $productId);
    } else {
        $stmt->bind_param("sssssi", $name, $price, $razmer, $material, $descriptions, $productId);
    }

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Товар с ID $productId успешно обновлен.";
    } else {
        $_SESSION['error_message'] = "Ошибка при обновлении товара: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateProduct'])) {
    $productId = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $razmer = $_POST['razmer'];
    $material = $_POST['material'];
    $descriptions = $_POST['descriptions'];

    // Проверяем, загружено ли новое изображение
    if (!empty($_FILES['img']['name'])) {
        $img_name = $_FILES['img']['name'];
        $img_tmp = $_FILES['img']['tmp_name'];
        $img_path = '' . $img_name;

        if (move_uploaded_file($img_tmp, $img_path)) {
            // Если изображение было загружено, обновляем его
            updateProduct($link, $productId, $name, $price, $razmer, $material, $img_path, $descriptions);
        } else {
            $_SESSION['error_message'] = "Ошибка при перемещении изображения товара.";
        }
    } else {
        // Если изображение не было изменено, обновляем без изменения изображения
        updateProduct($link, $productId, $name, $price, $razmer, $material, null, $descriptions);
    }

    header("Location: admin_panel.php");
    exit();
} else {
    header("Location: admin_panel.php");
    exit();
}