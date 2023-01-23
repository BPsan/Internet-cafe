<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internet Cafe</title>
    <?php if(isset($link_css)):?>
        <?php foreach($link_css as $item):?>
            <link rel="stylesheet" href="<?=$item?>">
        <?php endforeach?>
    <?php endif?>
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
  <header>
        <nav>
            <a href="index.php"><img src="img/logo.png" width="100%" alt="Логотип"></a>
            <ul class="ul-nav">
                <li class="pop-user">
                    <div class="div-pop">
                        <?php if(isset($start)):?>
                            <a class="a-pop" href="profil.php">Личный кабинет</a>
                            <?php if($role == 1):?>
                                <a class="a-pop" href="booking.php">Забронировать место</a>
                            <?php else:?>
                                <a class="a-pop" href="PostCreate.php">Выложить пост</a>
                            <?php endif?>
                            <a class="a-pop" href="logout.php">Выйти</a>
                        <?php else:?>
                            <a class="a-pop" href="../SingIn.php">Вход</a>
                            <a class="a-pop" href="../SingUp.php">Зарегистрироватся</a>
                        <?php endif?>
                    </div>
                </li>
                <li><input type="button" class="pop-inp"/></li>
            </ul>
        </nav>
    </header>
    <main>
        <?=$content?>
    </main>
    <footer>
        <div class="contact">
            <h2>© 2022 Интернет-кафе InPlace</h2>
        </div>
        <div class="contact">
            <h2>Связатся с нами</h2>
            <ul class="ul_contack">
                <li><a href="mailto:InPlace.gmail.com">InPlace.gmail.com</a></li>
                <li><a href="tel:+79996232534">+7 (999)-623-2534</a></li>
                <li><a href="#">Наш телеграм</a></li>
            </ul>
        </div>
    </footer>
    <script src="js/main.js"></script>
</body>
</html>