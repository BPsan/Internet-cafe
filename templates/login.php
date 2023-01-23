        <div class="form-cent">
            <form class="login100-form" action="SingIn.php" method="post" autocomplete="off">
                <h1>Логин</h1>
                <div class="inf1">
                    <input type="text" name="email" id="email" class="log-inp <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errors[0]['error_status'] === TRUE || $errors[1]['error_status'] === TRUE)):?>error-input<?php endif ?>" placeholder="Почта">
                </div>
                <div class="inf2">
                    <input type="password" name="password" id="password" class="pass-inp <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errors[0]['error_status'] === TRUE || $errors[1]['error_status'] === TRUE)):?>error-input<?php endif;?>" placeholder="Пароль" >
                </div>
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[0]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[0]['error_name']?></p> <?php endif;?>
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $errors[1]['error_status'] === TRUE): ?> <p class="error_mes"><?=$errors[1]['error_name']?></p> <?php endif;?>
                <div class="div-button">
                    <button class="btn btn-dark button-bord">Войти</button>
                </div>
            </form>
        </div>