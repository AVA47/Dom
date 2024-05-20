<?php
session_start();
require "../core.php";

// Обработчик удаления товара
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Запрос на удаление товара из корзины
    $delete_query = "DELETE FROM busket WHERE id = $delete_id";
    mysqli_query($link, $delete_query);
    // Перенаправление обратно на эту страницу после удаления товара
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Запрос для выбора товаров из корзины пользователя
$sql = "SELECT b.*, p.name as product_name, p.price as product_price
        FROM busket b
        JOIN products p ON b.id_products = p.id
        WHERE b.id_users = " . (is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user']);
$product_query = mysqli_query($link, $sql);
?>

<head>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Домашний уголок - Корзина</title>
        <link href="main.css" rel="stylesheet">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/prettyPhoto.css" rel="stylesheet">
        <link href="../css/price-range.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <link href="../css/responsive.css" rel="stylesheet">
        <link rel="shortcut icon" href="../images/favicon.ico">
    </head>

<body>
    <header id="header">
        <div class="header_top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +7 (123) 456-7890</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> home_corner@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="top__header__right">
                        <?php
                        if ($_SESSION['user']) {
                            if ($_SESSION['user']['type'] == 2) {
                                // Если тип пользователя - обычный пользователь, показываем "Выйти"
                                echo  "<div class='editor'> 
							<a href='../function/logout.php'><input type='submit' value='Выйти' style='
								border: 2px solid #fe980f;
								padding: 3px 19px;
								border-radius: 5px;
								background-color: white;
								cursor: pointer;
								margin-left: 444px;
								margin-top: 3px;
								color: #600c00;
								transition: 0.5s;
							'></a> 
							</div>";
                            }
                        } else {
                            // Если никто не вошел, показываем "Войти"
                            echo "<div class='editor'> 
						<a href='function/auto.php'><input type='submit' value='Войти' style='
							border: 2px solid #fe980f;
							padding: 3px 19px;
							border-radius: 5px;
							background-color: white;
							cursor: pointer;
							margin-left: 444px;
							margin-top: 3px;
							color: #600c00;
							transition: 0.5s;
						'></a>  
						</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <img src="../images/home/logo.png" style="text-align: center" />
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Навигатор</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="../index.php" class="active">Главная</a></li>
                                <li><a href="../about.php">О нас</a></li>
                                <li><a href="../index.php#tovar">Товары</a></li>
                                <li><a href="../contact.php">Контакты</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="main">
            <?php
            // Проверяем наличие параметра 'success' в URL
            if (isset($_GET['success'])) {
                // Выводим сообщение об успешном оформлении заказа
                echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success']) . '</div>';
            }
            ?>
            <section class="cart-items">
                <?php
                if (mysqli_num_rows($product_query) > 0) {
                    // Если есть товары в корзине, выводим их
                    while ($row = mysqli_fetch_assoc($product_query)) {
                ?>
                <div class="cart-item">
                    <!-- Замените "product1.jpg" и "Product 1" на соответствующие столбцы из вашей таблицы products -->
                    <img src="../assets/img/<?= $row['img'] ?>" alt="<?= $row['product_name'] ?>">
                    <div class="item-details">
                        <h2><?= $row['product_name'] ?></h2>
                        <p>Цена: <?= $row['product_price'] ?> руб</p>
                        <!-- Вы можете добавить вывод количества товара, если это необходимо -->
                        <!-- <p>Количество: <?= $row['quantity'] ?></p> -->
                        <!-- Кнопка удаления товара -->
                        <a href="?delete_id=<?= $row['id'] ?>" class="btn btn-danger">Удалить</a>
                    </div>
                </div>
                <?php
                    }
                } else {
                    // Если корзина пуста, выводим сообщение
                    echo '<h2>Пока что тут пусто... Наберите товаров и возвращайтесь</h2>';
                }
                ?>
            </section>
            <?php
            // Проверяем, был ли выполнен вход на сайт и был ли оформлен заказ
            if ($_SESSION['user'] && mysqli_num_rows($product_query) > 0) {
                // Выводим текст-ссылку на файл status.php
                echo '<p><a href="status.php">Посмотреть статус заказа</a></p>';
            }
            ?>
            <?php
            if (mysqli_num_rows($product_query) > 0) {
                // Если есть товары в корзине, выводим блок с итоговой суммой и кнопкой оформления заказа
            ?>
            <section class="cart-summary">
                <h2>Итоговая сумма</h2>
                <?php
                    // Запрос для подсчета общей стоимости корзины
                    $total_query = mysqli_query($link, "SELECT SUM(price) as total FROM busket WHERE id_users = " . (is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user']));
                    $total = mysqli_fetch_assoc($total_query)['total'];
                    ?>
                <p>Общая стоимость: <?= $total ?> руб</p>
                <button onclick="window.location.href='oform.php'">Оформить заказ</button>
            </section>
            <?php
            }
            ?>
        </div>
    </main>
    <footer>
        <p>Домашний уголок © 2024</p>
    </footer>
</body>

</html>