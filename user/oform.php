<?php
session_start();
require "../core.php";

// Запрос для выбора товаров из корзины пользователя
$sql = "SELECT b.*, p.name as product_name, p.price as product_price
        FROM busket b
        JOIN products p ON b.id_products = p.id
        WHERE b.id_users = " . (is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user']);
$product_query = mysqli_query($link, $sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    // Получение идентификатора пользователя из сессии
    $user_id = $_SESSION['user']['id'];

    // Подготовка запроса для вставки данных в таблицу oform
    // Подготовка запроса для вставки данных в таблицу oform
    $insert_query = "INSERT INTO oform (id_users, id_products, address, phone, total_price, status_id) 
VALUES ('$user_id', 
        (SELECT SUBSTRING_INDEX(GROUP_CONCAT(id_products), ',', 1) FROM busket WHERE id_users = '$user_id'), 
        '$address', 
        '$phone', 
        (SELECT SUM(price) FROM busket WHERE id_users = '$user_id'),
        1)"; // Указываем значение 1 для столбца status_id


    // Выполнение запроса
    if (mysqli_query($link, $insert_query)) {
        // Успешно добавлено

        // Удаление товаров из корзины пользователя
        $delete_query = "DELETE FROM busket WHERE id_users = '$user_id'";
        mysqli_query($link, $delete_query);

        // Перенаправление на страницу busket с сообщением об успешном оформлении заказа
        header("Location: busket.php?success=Заказ успешно оформлен.");
        exit(); // Для предотвращения дальнейшего выполнения скрипта
    } else {
        // Ошибка при выполнении запроса
        echo "Ошибка: " . $insert_query . "<br>" . mysqli_error($link);
    }
}
?>

<head>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Egoiste - Кофе</title>
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
                                <li><a href="#"><i class="fa fa-phone"></i> +7 999 999 99 99</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> cofe_egoiste@gmail.com</a></li>
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
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
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
                                <li><a href="../vacan.php">Вакансии</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container1">
            <div class="main1">
                <section class="cart-items1">
                    <?php
                    while ($row = mysqli_fetch_assoc($product_query)) {
                    ?>
                        <div class="cart-item1">
                            <!-- Замените "product1.jpg" и "Product 1" на соответствующие столбцы из вашей таблицы products -->
                            <img src="../assets/img/<?= $row['img'] ?>" alt="<?= $row['product_name'] ?>">
                            <div class="item-details">
                                <h2><?= $row['product_name'] ?></h2>
                                <p>Цена: <?= $row['product_price'] ?> руб</p> <?= $row['quantity'] ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </section>
            </div>
            <div class="form-container">
                <h2>Заполните информацию для оформления заказа</h2>
                <form action="oform.php" method="post" id="order-form">
                    <div class="form-group">
                        <label for="address">Адрес получения заказа</label>
                        <!-- Заменяем textarea на input type="text" -->
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Номер телефона</label>
                        <!-- Добавляем placeholder для подсказки пользователю -->
                        <input type="text" id="phone" name="phone" required placeholder="+7 (999) 999-99-99">
                    </div>
                    <?php
                    // Запрос для подсчета общей стоимости корзины
                    $total_query = mysqli_query($link, "SELECT SUM(price) as total FROM busket WHERE id_users = " . (is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user']));
                    $total = mysqli_fetch_assoc($total_query)['total'];
                    ?>
                    <p>Общая стоимость: <?= $total ?> руб</p>
                    <button type="submit">Оформить заказ</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; Авласенок А.В. © 2024 || Эгоист</p>
        </div>
    </footer>
</body>
<script>
    document.getElementById('phone').addEventListener('input', function(e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
        e.target.value = !x[2] ? x[1] : '+7 (' + x[2] + (x[3] ? ') ' + x[3] : '') + (x[4] ? '-' + x[4] : '') + (x[
            5] ? '-' + x[5] : '');
    });
</script>

</html>
