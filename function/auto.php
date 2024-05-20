<?php
session_start();
if ($_SESSION['user']) {
    header('Location: ../product/admin_panel.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../product/style_admin.css">
    <title>Авторизация</title>
</head>

<body>
    <main>
        <form action="signin.php" method="post">
            <div class="auto">
                <div class="auto-block">
                    <div class="auto-block__h">
                        <h3>Авторизация</h3>
                    </div>
                    <div class="auto-block__input-login">
                        <input type="text" id="login" name="login" placeholder="Логин">
                    </div>
                    <div class="auto-block__input-password">
                        <input type="password" id="password" name="password" placeholder="Пароль">
                    </div>
                    <div class="auto-block__button-enter">
                        <input type="submit" value="Войти">
                    </div>
                    <div class="text">
                        <br>
                        <p>У вас нет аккаунта? &mdash; <a href="reg.php" class="forget" style="text-decoration: none; color: #fe980f;">Зарегистрируйтесь</a></p>
                        <?php
                        if ($_SESSION['message']) {
                            echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
                        }
                        unset($_SESSION['message']);
                        ?>
                    </div>
                    <div class="auto-block__button-cancel">
                        <a href="../index.php">Назад</a>
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>

</html>