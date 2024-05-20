<?
session_start();
require "core.php";
$sql = "SELECT p.id, p.name, p.price, p.img, m.model, c.color 
        FROM products p 
        JOIN models m ON p.model_id = m.id 
        JOIN colors c ON p.color_id = c.id";
$product_query = mysqli_query($link, $sql);
?>

<? include 'header.php' ?>
<br>
<section id="slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><b><span>ДОМАШНИЙ</span> УГОЛОК</b></h1>
                                <h2>Мы - уют вашего дома</h2>
                                <style>
                                .text-justify {
                                    text-align: justify;
                                }
                                </style>
                                <p class="text-justify">Добро пожаловать в <b>«Домашний уголок»</b> – ваш идеальный
                                    партнер в создании уюта и
                                    комфорта в вашем доме! Мы - компания, которая заботится о вашем уюте и стиле,
                                    предлагая широкий ассортимент мебельных товаров <i>высокого качества.</i></p>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/barista2.jpg" class="girl img-responsive" alt="" />
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><b><span>ДОМАШНИЙ</span> УГОЛОК</b></h1>
                                <br>
                                <br>
                                <p class="text-justify">В <b>«Домашнем уголке»</b> мы стремимся удовлетворить
                                    разнообразные потребности наших
                                    клиентов, предлагая широкий выбор мебели для гостиной и спальни. Наша продукция
                                    отличается не только высоким качеством материалов и
                                    прочностью, но и стильным дизайном, который поможет воплотить в жизнь ваши самые
                                    смелые идеи о <i>создании уютного и стильного интерьера.</i></p>
                            </div>
                            <div class="col-sm-6">
                                <img src="images/home/barista3.jpg" class="girl img-responsive" alt="" />
                            </div>
                        </div>
                    </div>
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar" style="margin-bottom: 30px;">
                    <div class="panel-group category-products2" id="accordian">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">Модели</h2>
                            </div>
                            <div class="panel-body">
                                <?php
                                $models_query = mysqli_query($link, "SELECT * FROM models");
                                while ($model = mysqli_fetch_assoc($models_query)) :
                                ?>
                                <label>
                                    <input type="checkbox" name="model[]" value="<?= $model['model'] ?>">
                                    <?= $model['model'] ?>
                                </label><br>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <!-- Блок цветов -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">Цвета</h2>
                            </div>
                            <div class="panel-body">
                                <?php
                                $colors_query = mysqli_query($link, "SELECT * FROM colors");
                                while ($color = mysqli_fetch_assoc($colors_query)) :
                                ?>
                                <label>
                                    <input type="checkbox" name="color[]" value="<?= $color['color'] ?>">
                                    <?= $color['color'] ?>
                                </label><br>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <style>
                        #slider-range {
                            width: 100%;
                            margin: 10px auto;
                        }

                        #amount {
                            border: none;
                            font-family: 'Montserrat', sans-serif;
                            font-style: normal;
                            font-weight: 400;
                            font-size: 16px;
                            line-height: 19px;
                            color: #5B5B5B;
                            width: 100%;
                            text-align: center;
                            margin-bottom: 10px;
                        }

                        .ui-slider .ui-slider-handle {
                            cursor: pointer;
                            border: 2px solid #fe980f;
                            background-color: #fe980f;
                        }

                        .ui-slider .ui-slider-range {
                            background-color: #fe980f;
                        }

                        .ui-slider .ui-slider-handle:hover {
                            border-color: #1C1C1C;
                            background-color: #1C1C1C;
                        }

                        .ui-slider .ui-slider-range:hover {
                            background-color: #1C1C1C;
                        }
                        </style>
                        <button onclick="applyFilters()" class="btn btn-primary">Применить фильтр</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="left-sidebar">
                </div>
                <div class="features_items" id="tovar">
                    <?php while ($product = mysqli_fetch_assoc($product_query)) : ?>
                    <div class="col-sm-4">
                        <br>
                        <div class="single-products">
                            <div class="product-image-wrapper">
                                <div class="productinfo text-center">
                                    <img src="assets/img/<?= $product['img'] ?>" alt="" />
                                    <h1><?= $product['name'] ?></h1>
                                    <h2><?= $product['price'] ?> руб</h2>
                                    <a href="product/tovar.php?id=<?= $product['id'] ?>"
                                        class="btn btn-default add-to-cart">Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile ?>

                    <?php
                    // Закрыть соединение с базой данных
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<? include 'footer.php' ?>
</body>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
$(function() {
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 100000,
        values: [0, 100000],
        slide: function(event, ui) {
            $("#amount").val(ui.values[0] + " - " + ui.values[1] + " руб");
        }
    });
    $("#amount").val($("#slider-range").slider("values", 0) +
        " - " + $("#slider-range").slider("values", 1) + " руб");
});

// Функция для анимации фильтрации товаров
function applyFilters() {
    // Собираем выбранные модели
    var models = [];
    $("input[name='model[]']:checked").each(function() {
        models.push($(this).val());
    });

    // Собираем выбранные цвета
    var colors = [];
    $("input[name='color[]']:checked").each(function() {
        colors.push($(this).val());
    });

    // Анимация плавного скрытия товаров
    $("#tovar").fadeOut("slow", function() {
        // Отправляем данные на сервер для обработки
        $.ajax({
            type: "GET",
            url: "product/filtered_products.php",
            data: {
                model: models,
                color: colors
            },
            success: function(response) {
                // Заменяем содержимое блока #tovar на полученные товары
                $("#tovar").html(response);
                // Плавно показываем товары после замены
                $("#tovar").fadeIn("slow");
            }
        });
    });
}
</script>

</html>