<?php
session_start();
require "../core.php";

// Получаем выбранные модели и цвета из запроса
$selected_models = isset($_GET['model']) ? $_GET['model'] : array();
$selected_colors = isset($_GET['color']) ? $_GET['color'] : array();

// Строим условие WHERE для запроса
$where_conditions = array();
if (!empty($selected_models)) {
    $where_conditions[] = "m.model IN ('" . implode("','", $selected_models) . "')";
}
if (!empty($selected_colors)) {
    $where_conditions[] = "c.color IN ('" . implode("','", $selected_colors) . "')";
}
$where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";

// Запрос для выборки товаров с учетом фильтрации
$sql = "SELECT p.id, p.name, p.price, p.img 
        FROM products p 
        JOIN models m ON p.model_id = m.id 
        JOIN colors c ON p.color_id = c.id 
        $where_clause";

$product_query = mysqli_query($link, $sql);

// Если нет результатов, выводим текст "По выбранным характеристикам товаров не нашлось"
if (mysqli_num_rows($product_query) == 0) {
    echo "<p>По выбранным характеристикам товаров не нашлось</p>";
} else {
    // Выводим товары, соответствующие фильтру
    while ($product = mysqli_fetch_assoc($product_query)) {
        echo "<div class='col-sm-4'>
                <br>
                <div class='single-products'>
                    <div class='product-image-wrapper'>
                        <div class='productinfo text-center'>
                            <img src='assets/img/{$product['img']}' alt='' />
                            <h1>{$product['name']}</h1>
                            <h2>{$product['price']} руб</h2>
                            <a href='product/tovar.php?id={$product['id']}' class='btn btn-default add-to-cart'>Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>";
    }
}

// Закрыть соединение с базой данных
mysqli_close($link);
