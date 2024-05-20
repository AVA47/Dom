<?php
session_start();

include '../core.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $razmer = $_POST['razmer'];
    $material = $_POST['material'];
    $color = $_POST['color'];
    $model = $_POST['model'];
    $descriptions = $_POST['descriptions'];

    // Проверяем, загружено ли изображение
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img_name = $_FILES['img']['name'];
        $img_tmp_name = $_FILES['img']['tmp_name'];
        $img_path = '../assets/img/' . $img_name;

        // Перемещаем изображение в указанную директорию
        if (move_uploaded_file($img_tmp_name, $img_path)) {
            // Добавляем данные в таблицу products
            $sql = "INSERT INTO products (name, price, razmer, material, color_id, model_id, img, descriptions) VALUES ('$name', '$price', '$razmer', '$material', (SELECT id FROM colors WHERE color='$color'), (SELECT id FROM models WHERE model='$model'), '$img_name', '$descriptions')";

            if ($link->query($sql) === TRUE) {
                $_SESSION['success_message'] = "Товар успешно добавлен!";
            } else {
                $_SESSION['error_message'] = "Ошибка: " . $sql . "<br>" . $link->error;
            }
        } else {
            $_SESSION['error_message'] = "Ошибка при загрузке изображения.";
        }
    } else {
        $_SESSION['error_message'] = "Изображение не было загружено или произошла ошибка при загрузке.";
    }
}

// Перенаправляем пользователя обратно на страницу с формой
header("Location: admin_panel.php");
exit();
