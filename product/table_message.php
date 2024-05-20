<?php
session_start();
include 'header_admin.php';
?>
<main class="main">
    <div class="container">
        <div class="menus">
            <div class="main-admin-block__a">
                <a href="admin_panel.php#add_Tovar">Добавить товар</a>
                <a href="admin_panel.php#delete_Tovar">Удалить товар</a>
                <a href="admin_panel.php#update_Tovar">Обновить товар</a>
            </div>
        </div>
    </div>
    <div class="main-admin-block-inputs">
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