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
    <title>Регистрация</title>
</head>

<body>
    <main>
        <form action="signup.php" method="post">
            <div class="auto">
                <div class="auto-block1">
                    <div class="auto-block__h">
                        <h3>Регистрация</h3>
                    </div>
                    <div class="auto-block__input-login">
                        <input type="text" id="login" name="login" placeholder="Логин" required>
                    </div>
                    <div class="auto-block__input-password">
                        <input type="password" id="password" name="password" placeholder="Пароль" required>
                    </div>
                    <div class="auto-block__input-password">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Повторите пароль" required>
                    </div>
                    <div class="auto-block__input-password">
                        <label for="user_type">Тип пользователя:</label>
                        <select id="user_type" name="user_type" required>
                            <option value="1">Админ</option>
                            <option value="2">Обычный пользователь</option>
                        </select>
                    </div>
                    <div class="auto-block__button-enter">
                        <input type="submit" value="Зарегистрироваться">
                    </div>
                    <br>
                    <div class="text">
                        <p>Уже есть аккаунт? &mdash; <a href="auto.php" class="forget" style="text-decoration: none; color: #fe980f;">Войдите</a></p>
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