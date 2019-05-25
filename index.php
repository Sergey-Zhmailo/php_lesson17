<?php
session_start();
// DB
$connection = mysqli_connect('127.0.0.1', 'root', '', 'game_cities');
// GET CITIES
if (empty($_SESSION['cities'])) {
    $sql = "SELECT * FROM cities";
    $query = mysqli_query($connection, $sql);
    while ($res[] = mysqli_fetch_assoc($query)) {
        $_SESSION['cities'] = $res;
    }
}
class Ref {
    public $session;
    public $connection;
    function __construct($session){
        $this->session = $session;
    }
    public function checkCity($input_city){
        if (!empty($input_city)) {
            unset($_SESSION['error']);
            foreach ($this->session as $city=>$name) {
                if ($input_city == mb_strtolower($name['city_name'])) {
                    // получили совпадение
                    unset($_SESSION['error']);
                    return true;
                } else {
                    $_SESSION['error'] = 'Такого города нет';
                    unset($_SESSION['last_char']);
                }
            }
        } else {
            $_SESSION['error'] = 'Город не указан';
        }
    }
    public function last_char($city) {
        $_SESSION['last_char'] = mb_substr($city, mb_strlen($city, 'utf8') - 1, 1, 'utf8');
        unset($_POST['user_city']);
    }
    public function deleteCity($input_city) {
        foreach ($this->session as $city=>$name) {
            if ($input_city == mb_strtolower($name['city_name'])) {
                unset($_SESSION['cities'][$city]);
            }
        }
    }
    // Проверка на первую букву введенного игроком города
    public function checkCity_firstChar($input_city) {
        if ($_SESSION['last_char'] == mb_substr(mb_strtolower($input_city), 0, 1, 'utf8')) {
            return true;
        } else {
            $_SESSION['error'] = 'Вы должны ввести город на букву ' . $_SESSION['last_char'];
        }
    }
}
class Bot {
    public $session;
    function __construct($session){
        $this->session = $session;
    }
    public function find_city($last_char) {
        foreach ($this->session as $city=>$name) {
            if ($last_char == mb_substr(mb_strtolower($name['city_name']), 0, 1, 'utf8')) {
                // получаем новый город из сессии
                return $_SESSION['last_city'] = $name['city_name'];
            } else {
                // город по этой букве не найден
                unset($_SESSION['last_city']);
            }
        }
        if ($_SESSION['last_city']) {
            return true;
        } else {
            $_SESSION['error'] = 'Робот проиграл';
            $_SESSION['last_city'] = 'У меня нет ответа';
            $_SESSION['game_end'] = '1';
            return false;
        }
    }
}
$ref = new Ref($_SESSION['cities']);
$bot = new Bot($_SESSION['cities']);
// Логика игры
if (!empty($_POST['user_city'])) {
    // первый ход
    if (empty($_SESSION['last_char'])) {
        // Проверям наличие города в сессии
        if ($ref->checkCity(mb_strtolower(trim($_POST['user_city'])))) {
            // Удаляем город из сесиии
            $ref->deleteCity(mb_strtolower(trim($_POST['user_city'])));
            // Получаем последнюю букву
            $ref->last_char(mb_strtolower(trim($_POST['user_city'])));
        }
        if ($_SESSION['last_char']) {
            // Передаем посл. букву боту и он ищет город из сессии
            if ($bot->find_city($_SESSION['last_char'])) {
                $ref->last_char(mb_strtolower($_SESSION['last_city']));
                $ref->deleteCity(mb_strtolower($_SESSION['last_city']));
            }
        }
    } else {
        // Следующий ход
        // Проверяем на первую букву игрока
        if ($ref->checkCity_firstChar(mb_strtolower(trim($_POST['user_city'])))) {
            if ($ref->checkCity(mb_strtolower(trim($_POST['user_city'])))) {
                $ref->deleteCity(mb_strtolower(trim($_POST['user_city'])));
                $ref->last_char(mb_strtolower(trim($_POST['user_city'])));
            }
            if ($_SESSION['last_char']) {
                if ($bot->find_city($_SESSION['last_char'])) {
                    $ref->last_char(mb_strtolower($_SESSION['last_city']));
                    $ref->deleteCity(mb_strtolower($_SESSION['last_city']));
                }
            }
        }

    }
} else {
    $_SESSION['error'] = 'Город не указан';
}


// header
require_once 'header.php';

?>
<!--main content-->
<div class="main">
    <div class="container">
        <h4 class="center-align">Игра города</h4>
<?php
if ($_GET['page'] == 'game') {
    // Разметка для игры
    ?>
    <div class="row center-align">
        <form method="post">
            <input type="text" name="user_city">
            <br>
            <br>
            <input type="submit" value="Ввод" class="btn waves-effect waves-light light-blue darken-4">
        </form>
        <span class="error"><?php echo $_SESSION['error'] ? $_SESSION['error'] : '' ?></span>
    </div>
    <div class="row center-align">
        <p><strong>Ответ Робота: </strong><?php echo $_SESSION['last_city'] ? $_SESSION['last_city'] : '' ?></p>
    </div>
    <div class="row center-align">
        <?php echo $_SESSION['game_end'] ? '<a href=" /index.php" class="btn waves-effect waves-light light-blue darken-4">START NEW GAME</a>' : ''; ?>
    </div>
    <?php
} else {
    // Главное меню
    unset($_SESSION['last_city']);
    unset($_SESSION['last_char']);
    unset($_SESSION['cities']);
    unset($_SESSION['game_end']);
    ?>
    <div class="row center-align">
        <a href=" /index.php?page=game" class="btn waves-effect waves-light light-blue darken-4">GAME START</a>
    </div>
    <?php
}
?>
        <div class="row center-align">
            <?php
            if ($_SESSION['cities']) { ?>
                <p>Подсказка - Города в базе (<?php echo count($_SESSION['cities']) ?>) :</p>
            <?php
                foreach ($_SESSION['cities'] as $city=>$name) {
                    echo $name['city_name'] . ', ';
                }
            }
            ?>
        </div>
    </div>
</div>
<?php

    // footer
    require_once 'footer.php';
?>
