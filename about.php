<?
session_start();
require "core.php";
$sql = "SELECT * FROM products";
$product_query = mysqli_query($link, $sql);
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Домашний уголок</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
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
							<a href='product/admin_panel.php'><input type='submit' value='Редактор' style='
								border: 2px solid #fe980f;
								padding: 3px 19px;
								border-radius: 5px;
								background-color: white;
								cursor: pointer;
								margin-left: 344px;
								margin-top: 3px;
								color: #600c00;
								transition: 0.5s;
							'></a>
							<a href='function/logout.php'><input type='submit' value='Выйти' style='
								border: 2px solid #fe980f;
								padding: 3px 19px;
								border-radius: 5px;
								background-color: white;
								cursor: pointer;
								margin-left: 10px;
								margin-top: 3px;
								color: #600c00;
								transition: 0.5s;
							'></a> 
							</div>";
                            } elseif ($_SESSION['user']['type'] == 2) {
                                // Если тип пользователя - обычный пользователь, показываем "Выйти"
                                echo  "<div class='editor'> 
								<a href='user/busket.php'><input type='submit' value='Корзина' style='
								border: 2px solid #fe980f;
								padding: 3px 19px;
								border-radius: 5px;
								background-color: white;
								cursor: pointer;
								margin-left: 344px;
								margin-top: 3px;
								color: #600c00;
								transition: 0.5s;
							'></a>
							<a href='function/logout.php'><input type='submit' value='Выйти' style='
								border: 2px solid #fe980f;
								padding: 3px 19px;
								border-radius: 5px;
								background-color: white;
								cursor: pointer;
								margin-left: 10px;
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
                            <img src="images/home/logo.png" style="text-align: center" />
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
                                <li><a href="index.php">Главная</a></li>
                                <li><a href="#">О нас</a></li>
                                <li><a href="index.php#tovar">Товары</a></li>
                                <li><a href="contact.php">Контакты</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-33">
                    <div class="left-sidebar">
                        <div class="block1">
                            <div class="block1_img">
                                <img src="images/home/block1.jpg" alt="">
                            </div>
                            <div class="block1_info">
                                <div>
                                    <h1><b><span>ДОМАШНИЙ</span> УГОЛОК</b></h1>
                                    <p>Уникальная компания, специализирующаяся на продаже мебельных изделий. Наша миссия
                                        заключается в том, чтобы помочь нашим клиентам создать уют и комфорт в своих
                                        домах, предоставляя им доступ к качественной и стильной мебели. Мы стремимся
                                        удовлетворить потребности каждого клиента, предлагая широкий ассортимент товаров
                                        и высокий уровень обслуживания.</p>
                                    <br>
                                    <div class="block1_info_b">
                                        <p>
                                            <b><span>Домашний</span> уголок</b> - это не просто магазин мебели. Это
                                            место, где каждый клиент может найти идеальное решение для своего дома,
                                            отражающее его индивидуальный стиль и предпочтения. Мы стремимся сделать
                                            процесс выбора мебели легким и приятным, предлагая широкий выбор товаров и
                                            профессиональную консультацию нашего персонала.
                                        </p>
                                    </div>
                                    <br>
                                    <p><b>МЫ</b> гордимся своим вкладом в общество и прилагаем усилия для поддержания
                                        принципов устойчивого развития. Мы работаем над улучшением качества жизни в
                                        наших регионах, активно поддерживая социальные и экологические инициативы.</p>
                                </div>
                            </div>
                        </div>
                        <h2>Наш коллектив</h2>
                        <div class="block1">
                            <div class="slider-container">
                                <div class="slider">
                                    <div class="slide" data-name="Иван" data-position="Бариста">
                                        <img src="images/people/1.jpg" alt="Бариста Иван">
                                        <div class="info">
                                            <h3>Иван</h3>
                                            <p>Менеджер по продажам</p>
                                        </div>
                                    </div>
                                    <div class="slide" data-name="Анна" data-position="Сомелье кофе">
                                        <img src="images/people/2.jpg" alt="Сомелье кофе Анна">
                                        <div class="info">
                                            <h3>Анна</h3>
                                            <p>Дизайнер интерьера</p>
                                        </div>
                                    </div>
                                    <div class="slide" data-name="Дмитрий" data-position="Мастер по обжарке">
                                        <img src="images/people/3.jpg" alt="Мастер по обжарке Дмитрий">
                                        <div class="info">
                                            <h3>Дмитрий</h3>
                                            <p>Менеджер склада</p>
                                        </div>
                                    </div>
                                    <div class="slide" data-name="Екатерина" data-position="Кофейный архитектор">
                                        <img src="images/people/4.jpg" alt="Кофейный архитектор Екатерина">
                                        <div class="info">
                                            <h3>Петр</h3>
                                            <p>Мастер по сборке мебели</p>
                                        </div>
                                    </div>
                                    <div class="slide" data-name="Петр" data-position="Бармен-кофейщик">
                                        <img src="images/people/5.jpg" alt="Бармен-кофейщик Петр">
                                        <div class="info">
                                            <h3>Екатерина</h3>
                                            <p>Администратор магазина</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            $(document).ready(function() {
                                $('.slider').slick({
                                    slidesToShow: 5,
                                    slidesToScroll: 1,
                                    prevArrow: $('.prev'),
                                    nextArrow: $('.next'),
                                });
                            });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <br>
    <section id="our-values">
        <div class="container">
            <div class="section-background"></div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title text-center">
                        <h2>Наши Ценности</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="value-item">
                        <h3>Качество</h3>
                        <p>Мы стремимся к высокому качеству каждой единицы мебели — от выбора материалов до
                            окончательной сборки, чтобы обеспечить долговечность и удовлетворение потребностей наших
                            клиентов.</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="value-item">
                        <h3>Гостеприимство</h3>
                        <p>Мы создаем уютное пространство, где каждый клиент чувствует себя желанным и может получить
                            профессиональную консультацию и помощь в выборе мебели, соответствующей его потребностям и
                            предпочтениям.</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="value-item">
                        <h3>Инновации</h3>
                        <p>Мы постоянно следим за новейшими тенденциями и инновациями в мебельной индустрии, чтобы
                            предлагать нашим клиентам современные и функциональные решения для их дома или офиса.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
    <? include 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function() {
        // Инициализация слайдера
        $('.slider').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
        });

        // Инициализация эффекта приближения
        $('.slide img').each(function() {
            $(this).zoom();
        });

        // Обновление эффекта приближения при наведении
        $('.slide').hover(
            function() {
                $(this).find('img').trigger('zoom.destroy');
                $(this).find('img').zoom({
                    url: $(this).find('img').attr('src')
                });
            },
            function() {
                $(this).find('img').trigger('zoom.destroy');
                $(this).find('img').zoom();
            }
        );
    });
    </script>

</body>

</html>