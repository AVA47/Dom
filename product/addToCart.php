<?php
session_start();
include "../core.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получите идентификатор товара из POST-запроса
    $productId = mysqli_real_escape_string($link, $_POST['id']);

    // Получите данные о товаре из базы данных
    $product_query = mysqli_query($link, "SELECT * FROM `products` WHERE `id` = '$productId'");
    $product = mysqli_fetch_assoc($product_query);

    if ($product) {
        // Добавьте товар в корзину (таблицу `busket`)
        $name = mysqli_real_escape_string($link, $product['name']);
        $price = mysqli_real_escape_string($link, $product['price']);

        $insert_query = "INSERT INTO `busket` (`name`, `price`) VALUES ('$name', '$price')";
        if (mysqli_query($link, $insert_query)) {
            // Верните какой-то ответ об успешном добавлении, если необходимо
            echo 'Товар успешно добавлен в корзину';
        } else {
            // Обработка ошибки добавления товара в корзину
            echo 'Ошибка при добавлении товара в корзину';
        }
    } else {
        // Обработка случая, когда товар с указанным идентификатором не найден
        echo 'Товар не найден';
    }
}
