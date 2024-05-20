<?php
session_start();
include "../core.php";
$id = $_GET['id'];
$sql = "SELECT p.id, p.name, p.price, p.img, m.model, c.color 
        FROM products p 
        JOIN models m ON p.model_id = m.id 
        JOIN colors c ON p.color_id = c.id";
// Запрос для получения информации о товаре
$product_query = mysqli_query($link, "SELECT * FROM `products` WHERE `id` = '$id'");
$product = mysqli_fetch_assoc($product_query);

// Получаем информацию о цвете товара
$color_query = mysqli_query($link, "SELECT color FROM `colors` WHERE `id` = '{$product['color_id']}'");
$color = mysqli_fetch_assoc($color_query);

// Получаем информацию о модели товара
$model_query = mysqli_query($link, "SELECT model FROM `models` WHERE `id` = '{$product['model_id']}'");
$model = mysqli_fetch_assoc($model_query);

$message = ''; // Инициализация переменной для сообщения

if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user'])) {
        // Если пользователь не авторизован, присваиваем сообщение об ошибке
        $message = "<p style='color:red;'>Вы не авторизированы, вы не можете добавить товар в корзину.</p>";
    } else {
        $id_product = $_POST['id'];
        $img_path = $_POST['img']; // Получите путь к изображению из формы

        // Проверяем, является ли $_SESSION['user_id'] массивом, и извлекаем нужное значение
        $id_user = is_array($_SESSION['user']) ? $_SESSION['user']['id'] : $_SESSION['user'];

        $product_query = mysqli_query($link, "SELECT * FROM `products` WHERE `id` = '$id_product'");
        $product = mysqli_fetch_assoc($product_query);

        $name = $product['name'];
        $price = $product['price'];
        $insert_query = mysqli_query($link, "INSERT INTO `busket` (`id_products`, `id_users`, `name`, `price`, `img`) VALUES ('$id_product', '$id_user', '$name', '$price', '$img_path')");

        if ($insert_query) {
            $message = "<p style='color:green;'>Товар успешно добавлен в корзину!</p>";
        } else {
            $message = "<p style='color:red;'>Ошибка при добавлении товара в корзину: " . mysqli_error($link) . "</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/price-range.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/favicon.ico">
    <title>Домашний уголок</title>
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
                            // Если вошел пользователь (любого типа), показываем "Выход"
                            if ($_SESSION['user']['type'] == 1) {
                                // Если тип пользователя - admin, показываем "Редактор"
                                echo  "<div class='editor'> 
							<a href='admin_panel.php'><input type='submit' value='Редактор' style='
								border: 2px solid #fe980f;
								padding: 3px 19px;
								border-radius: 5px;
								background-color: white;
								cursor: pointer;
								margin-left: 344px;
								margin-top: 3px;
								color: #600c00;
							'></a>
							<a href='../function/logout.php'><input type='submit' value='Выйти' style='
								border: 2px solid #fe980f;
								padding: 3px 19px;
								border-radius: 5px;
								background-color: white;
								cursor: pointer;
								margin-left: 10px;
								margin-top: 3px;
								color: #600c00;
							'></a> 
							</div>";
                            } elseif ($_SESSION['user']['type'] == 2) {
                                // Если тип пользователя - обычный пользователь, показываем "Выйти"
                                echo  "<div class='editor'> 
								<a href='../user/busket.php'><input type='submit' value='Корзина' style='
								border: 2px solid #fe980f;
								padding: 3px 19px;
								border-radius: 5px;
								background-color: white;
								cursor: pointer;
								margin-left: 344px;
								margin-top: 3px;
								color: #600c00;
							'></a>
							<a href='../function/logout.php'><input type='submit' value='Выйти' style='
								border: 2px solid #fe980f;
								padding: 3px 19px;
								border-radius: 5px;
								background-color: white;
								cursor: pointer;
								margin-left: 10px;
								margin-top: 3px;
								color: #600c00;
							'></a>  
							</div>";
                            }
                        } else {
                            // Если никто не вошел, показываем "Войти"
                            echo "<div class='editor'> 
						<a href='../function/auto.php'><input type='submit' value='Войти' style='
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
    <br>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-33">
                    <div class="left-sidebar">
                        <h2>Информация</h2>
                        <div class="information">
                            <div class="panel-group category-products" id="accordian">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title1">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                                                <span class="badge pull-right"></span>
                                                <?= $product['descriptions'] ?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="left-sidebar">
                                    <div class="panel-group category-products1" id="accordian">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                                                        <span class="badge pull-right"></span>
                                                        <b>Размеры:</b> <?= $product['razmer'] ?>
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title"><a href="#"><b>Материал:</b>
                                                        <?= $product['material'] ?></a></h4>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title"><a href="#"><b>Цвет:</b>
                                                        <?= $color['color'] ?></a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="slider">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="item active">
                                        <div class="col-sm-6">
                                            <h3><?= $product['name'] ?></h3>
                                            <h2><?= $product['price'] ?> руб</h2>
                                            <form method="post" action="">
                                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                                <!-- Добавьте скрытое поле для изображения -->
                                                <input type="hidden" name="img" value="<?= $product['img'] ?>">
                                                <button type="submit" class="btn btn-default add-to-cart"
                                                    name="add_to_cart">В корзину</button>
                                            </form>
                                            <div><?= $message ?></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <img src="../assets/img/<?= $product['img'] ?>" class="girl img-responsive"
                                                alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    </section>
</body>

</html>