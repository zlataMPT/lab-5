<?php

include 'header.php';
require_once('/php/bd.php');

?>
<?php
if (isset($_SESSION['login_user'])) {

    $user_check = $_SESSION['login_user'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
    $rows = mysqli_fetch_array($query);
    $surname = $rows['surname'];
    $names = $rows['name'];
    $otchestvo = $rows['otchestvo'];
    $status = $rows['admin'];
    $number = $rows['number'];
    $email = $rows['email'];
    $date_birth = $rows['date_birth'];

    if ($status == 1) {
        $admin = 'Администратор';
    } else {
        $admin = 'Покупатель';
    }
} else {
    header('Location index.php');
}

?>
<section class="account">
    <div class="account-head">
        <h1>Личный кабинет</h1>
    </div>
    <div class="account-content">
        <div class="account-conent-main">
            <div class="account-content-bl">
                <div class="account-content-bl-img">
                    <img src="img/1.png" alt="">
                </div>
            </div>
            <div class="account-content-bl">
                <h3><?= $surname; ?> <?= $names; ?> <?= $otchestvo; ?> - <span><?= $admin; ?></h3>
                <div class="account-content-bl-cont">
                    <div class="acc-con-bl-co">
                        <div class="account-content-bl-cont-b">
                            <span>Страна:</span> <br>
                            <span>Город:</span><br>
                            <span>Возраст:</span><br>
                            <span>Дата рождения:</span><br>
                            <span>Телефон:</span><br>
                            <span>Почта:</span><br>
                            <span>Пароль:</span>
                        </div>
                        <div class="account-content-bl-cont-b">
                            <p>Россия</p>
                            <p>Москва</p>
                            <p>18 лет</p>
                            <p><?= $date_birth; ?></p>
                            <p><?= $number; ?></p>
                            <p><?= $email; ?></p>
                            <p>*************</p>
                        </div>
                    </div>
                    <br>
                    <!-- <a href="#">Редактировать профиль</a> -->
                </div>
            </div>
        </div>
        <div class="account-conent-main">
            <div class="bl-acc-con">
                <h2>Мой баланс</h2>
                <span>Баланс на 09.08.2023</span>
                <p>7 321 231р</p>
                <button>Пополнить</button> <br>
                <!-- <a href="">История платежей</a> -->
            </div>
        </div>
    </div>
</section>