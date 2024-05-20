<?php
session_start();
include 'header_admin.php';
if (!$_SESSION['user']) {
    header('Location: ../function/auto.php');
}

include '../core.php';

// Проверка на существование POST-запроса
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];

    // Проверка на существование заказа
    $check_order_query = "SELECT * FROM oform WHERE id = $order_id";
    $check_order_result = $link->query($check_order_query);

    if ($check_order_result->num_rows == 1) {
        // Запрос на изменение статуса заказа
        $update_status_query = "UPDATE oform SET status_id = $new_status WHERE id = $order_id";
        if ($link->query($update_status_query)) {
            echo "<div class='alert alert-success'>Статус заказа успешно изменен.</div>";
        } else {
            echo "<div class='alert alert-danger'>Ошибка при изменении статуса заказа: " . $link->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Заказ с указанным ID не найден.</div>";
    }
}
?>
<main class="main">
    <div class="container">
        <div class="menus">
            <div class="main-admin-block__a">
                <a href="admin_panel.php#add_Tovar">Добавить товар</a>
                <a href="admin_panel.php#add_Color">Добавить цвет</a>
                <a href="admin_panel.php#add_Model">Добавить вид товара</a>
                <a href="admin_panel.php#massage">Список сообщений</a>
                <a href="admin_panel.php#oform">Оформленные заказы</a>
            </div>
        </div>
    </div>
    <form action="add_product.php" method="post" enctype="multipart/form-data" novalidate>
        <div class="main-admin-block-inputs" id="add_Tovar">
            <div class="main-admin-block-inputs-block">
                <div class="main-admin-block__p_h">
                    <p>Добавление товара</p>
                </div>
            </div>

            <div class="main-admin-block-right">
                <div class="main-admin-block__input-name">
                    <input type="text" name="name" required placeholder="Название">
                </div>
                <div class="main-admin-block-right-cost">
                    <input type="text" name="price" required placeholder="Цена" id="cost">
                </div>
                <div class="main-admin-block__input-razmer">
                    <input type="text" name="razmer" required placeholder="Размеры">
                </div>
                <div class="main-admin-block__input-material">
                    <input type="text" name="material" required placeholder="Материал">
                </div>
                <div class="main-admin-block__input-color">
                    <select name="color" required>
                        <option value="" disabled selected>Выберите цвет</option>
                        <?php
                        include '../core.php';
                        $sql = "SELECT `color` FROM `colors`";
                        $result = $link->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $color = $row['color'];
                                echo "<option value='$color'>$color</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="main-admin-block__input-model">
                    <select name="model" required>
                        <option value="" disabled selected>Выберите вид товара</option>
                        <?php
                        include '../core.php';
                        $sql = "SELECT `model` FROM `models`";
                        $result = $link->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $model = $row['model'];
                                echo "<option value='$model'>$model</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="main-admin-block-right__textarea">
                    <textarea name="descriptions" required id="descriptions" placeholder="Описание"
                        name="descriptions"></textarea>
                </div>
                <div class="main-admin-block-right-img__p">
                    <p>Изображения</p>
                </div>
                <div class="main-admin-block-right-img__input">
                    <input type="file" name="img" required id="img__file">
                </div>
                <div class="main-admin-block-right-addTovar">
                    <input type="submit" name="add_product" value="Добавить товар">
                </div>
            </div>
            <div class="message">
                <?php
                if (isset($_SESSION['success_message'])) {
                    echo '<p class="good">' . $_SESSION['success_message'] . '</p>';
                    unset($_SESSION['success_message']); // Очищаем сессию после вывода сообщения
                }
                if (isset($_SESSION['error_message'])) {
                    echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
                    unset($_SESSION['error_message']); // Очищаем сессию после вывода сообщения
                }
                ?>
            </div>
        </div>
    </form>

    <br>
    <br>
    <br>
    <div class="main-admin-block-inputs">
        <div class="main-admin-block-inputs-block">
            <div class="main-admin-block__p_h">
                <p>Список товаров</p>
            </div>
        </div>

        <div class="main-admin-block-right">
            <table>
                <thead>
                    <tr>
                        <th style="color: black;">Название товара</th>
                        <th style="color: black;">Изменить</th>
                        <th style="color: black;">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../core.php';
                    $sql = "SELECT `id`, `name` FROM `products`";
                    $result = $link->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $productId = $row['id'];
                            $productName = $row['name'];
                            echo "<tr>";
                            // Скрытый ID товара
                            echo "<td hidden>$productId</td>";
                            echo "<td>$productName</td>";
                            echo "<td><a href='update_product_form.php?id=$productId'>Изменить</a></td>";
                            echo "<td><a href='delete_product.php?id=$productId'>Удалить</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <br>
    <br>
    <form action="add_color.php" method="post">
        <div class="main-admin-block-inputs" id="add_Color">
            <div class="main-admin-block-inputs-block">
                <div class="main-admin-block__p_h">
                    <p>Добавление цвета</p>
                </div>
            </div>

            <div class="main-admin-block-right">
                <div class="main-admin-block__input-color">
                    <input type="text" name="color" required placeholder="Цвет">
                </div>
                <div class="main-admin-block-right-addTovar">
                    <input type="submit" name="add_color" value="Добавить цвет">
                </div>
            </div>
            <div class="message">
                <?php
                if (isset($_SESSION['success_message_color'])) {
                    echo '<p class="good">' . $_SESSION['success_message_color'] . '</p>';
                    unset($_SESSION['success_message_color']); // Очищаем сессию после вывода сообщения
                }
                if (isset($_SESSION['error_message_color'])) {
                    echo '<p class="error">' . $_SESSION['error_message_color'] . '</p>';
                    unset($_SESSION['error_message_color']); // Очищаем сессию после вывода сообщения
                }
                ?>
            </div>
        </div>
    </form>
    <div class="main-admin-block-inputs">
        <div class="main-admin-block-inputs-block">
            <div class="main-admin-block__p_h">
                <p>Список цветов</p>
            </div>
        </div>

        <div class="main-admin-block-right">
            <table>
                <thead>
                    <tr>
                        <th style="color: black;">Название цвета</th>
                        <th style="color: black;">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../core.php';
                    $sql = "SELECT `id`, `color` FROM `colors`";
                    $result = $link->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $colorId = $row['id'];
                            $colorName = $row['color'];
                            // Определение цвета для кружка
                            $colorStyle = "style='background-color: $colorName; width: 20px; height: 20px; border-radius: 50%; display: inline-block; margin-right: 10px'";
                            echo "<tr>";
                            // Скрытый ID цвета
                            echo "<td hidden>$colorId</td>";
                            // Вывод кружка перед названием цвета
                            echo "<td><span $colorStyle></span>$colorName</td>";
                            // Удалить ссылку
                            echo "<td><a href='delete_color.php?id=$colorId'>Удалить</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <br>
    <br>
    <br>
    <form action="add_model.php" method="post">
        <div class="main-admin-block-inputs" id="add_Model">
            <div class="main-admin-block-inputs-block">
                <div class="main-admin-block__p_h">
                    <p>Добавление вида товара</p>
                </div>
            </div>

            <div class="main-admin-block-right">
                <div class="main-admin-block__input-model">
                    <input type="text" name="model" required placeholder="Вид товара">
                </div>
                <div class="main-admin-block-right-addTovar">
                    <input type="submit" name="add_model" value="Добавить вид товара">
                </div>
            </div>
            <div class="message">
                <?php
                if (isset($_SESSION['success_message_model'])) {
                    echo '<p class="good">' . $_SESSION['success_message_model'] . '</p>';
                    unset($_SESSION['success_message_model']); // Очищаем сессию после вывода сообщения
                }
                if (isset($_SESSION['error_message_model'])) {
                    echo '<p class="error">' . $_SESSION['error_message_model'] . '</p>';
                    unset($_SESSION['error_message_model']); // Очищаем сессию после вывода сообщения
                }
                ?>
            </div>
        </div>
    </form>
    <div class="main-admin-block-inputs">
        <div class="main-admin-block-inputs-block">
            <div class="main-admin-block__p_h">
                <p>Виды товаров</p>
            </div>
        </div>

        <div class="main-admin-block-right">
            <table>
                <thead>
                    <tr>
                        <th style="color: black;">Вид товара</th>
                        <th style="color: black;">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../core.php';
                    $sql = "SELECT `id`, `model` FROM `models`";
                    $result = $link->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $modelId = $row['id'];
                            $modelName = $row['model'];
                            echo "<tr>";
                            // Скрытый ID модели
                            echo "<td hidden>$modelId</td>";
                            echo "<td>$modelName</td>";
                            // Удалить ссылку
                            echo "<td><a href='delete_model.php?id=$modelId'>Удалить</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <br>
    <div class="main-admin-block-inputs" id="massage">
        <div class="main-admin-block-inputs-block">
            <div class="main-admin-block__p_h">
                <p>Таблица сообщений</p>
            </div>
        </div>

        <div class="main-admin-block-right">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th style="color: black;">Имя</th>
                            <th style="color: black;">Почта</th>
                            <th style="color: black;">Сообщение</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../core.php';
                        $sql = "SELECT `name`, `email`, `message` FROM `message`";
                        $result = $link->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $messageName = $row['name'];
                                $messageEmail = $row['email'];
                                $messageMessage = $row['message'];
                                echo "<tr>";
                                echo "<td>$messageName</td>";
                                echo "<td>$messageEmail</td>";
                                echo "<td>$messageMessage</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="main-admin-block-inputs" id="oform">
        <div class="main-admin-block-inputs-block">
            <div class="main-admin-block__p_h">
                <p>Таблица оформленных заказов</p>
            </div>
        </div>

        <div class="main-admin-block-right">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th style="color: black;">Название товара</th>
                            <th style="color: black;">Логин пользователя</th>
                            <th style="color: black;">Адрес</th>
                            <th style="color: black;">Телефон</th>
                            <th style="color: black;">Общая стоимость</th>
                            <th style="color: black;">Статус заказа</th>
                            <th style="color: black;">Изменить статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT oform.*, products.name as product_name, users.login as user_login, statuses.status as order_status 
                FROM oform 
                JOIN products ON oform.id_products = products.id 
                JOIN users ON oform.id_users = users.id 
                JOIN statuses ON oform.status_id = statuses.id";
                        $result = $link->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $product_name = $row['product_name'];
                                $user_login = $row['user_login'];
                                $address = $row['address'];
                                $phone = $row['phone'];
                                $total_price = $row['total_price'];
                                $order_status = $row['order_status'];
                                echo "<tr>";
                                echo "<td>$product_name</td>";
                                echo "<td>$user_login</td>";
                                echo "<td>$address</td>";
                                echo "<td>$phone</td>";
                                echo "<td>$total_price</td>";
                                echo "<td>$order_status</td>";
                                echo "<td><form action='admin_panel.php' method='post'>
                          <input type='hidden' name='order_id' value='" . $row['id'] . "'>
                          <select name='new_status'>
                              <option value='1'>В обработке</option>
                              <option value='2'>Заказ отправлен</option>
                          </select>
                          <div class='main-admin-block-right-addTovar'>
                    <input type='submit' name='add_product' value='Изменить'>
                </div>
                      </form></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
</main>
<script>
const btnUp = {
    el: document.querySelector('.btn-up'),
    show() {
        this.el.classList.remove('btn-up_hide');
    },
    hide() {
        this.el.classList.add('btn-up_hide');
    },
    addEventListener() {
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY || document.documentElement.scrollTop;
            scrollY > 400 ? this.show() : this.hide();
        });
        document.querySelector('.btn-up').onclick = () => {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
        }
    }
}
btnUp.addEventListener();
</script>
</body>

</html>